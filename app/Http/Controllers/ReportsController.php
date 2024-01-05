<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReqWede;
use App\Models\GrabWede;
use App\Models\ProcessLog;
use App\Models\PendingLog;
use App\Models\Closing;
use App\Models\Agent;

class ReportsController extends Controller
{
    //
    
    public function historycs() {
        $closing = Closing::where('status', 'closed')->get();


        return view('reports.historycs', [
            'title' => 'History Closing CS',
            'data' => $closing
        ]);
    }

    public function hariancs(Request $request) {

    $reqid = explode("-", $request->route('reqid'));
    $firstreqwedeid = intval($reqid[0]);
    $endreqwedeid = intval($reqid[1]);

        $agent = auth()->user()->agent;
        $agentObject = json_decode($agent, true);

        $agentName = null;
            foreach ($agentObject as $key => $value) {
                // Remove the quotes around the key
                $key = trim($key, "'");
                if ($value === 'on') {
                    $agentName = $key;
                    break;
                }
            };

        $reqdata = ReqWede::where('agent',$agentName)
                ->where('id', '>=', $firstreqwedeid)
                ->where('id', '<=', $endreqwedeid)
                ->get();
        

        $req = ReqWede::where('agent',$agentName)
                ->where('id', '>=', $firstreqwedeid)
                ->where('id', '<=', $endreqwedeid)
                ->selectRaw('status, COUNT(*) as jumlah, SUM(jumlahwd) as total')
                ->groupBy('status')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item['status'] => ['jumlah' => $item['jumlah'], 'total' => $item['total']]];
                });
        
        
        $successJumlah = $req['success']['jumlah'] ?? 0;
        $successTotal = $req['success']['total'] ?? 0;

        $pendingJumlah = $req['pending']['jumlah'] ?? 0;
        $pendingTotal = $req['pending']['total'] ?? 0;

        $rejectJumlah = $req['reject']['jumlah'] ?? 0;
        $rejectTotal = $req['reject']['total'] ?? 0;

        return view('reports.hariancs', [
            'title' => 'Harian CS',
            'data' => $reqdata,
            'jumlahsuccess' => $successJumlah,
            'totalsuccess' => $successTotal,
            'jumlahpending' => $pendingJumlah,
            'totalpending' => $pendingTotal,
            'jumlahreject' => $rejectJumlah,
            'totalreject' => $rejectTotal,
            // 'agents' => $agents
            
        ]);
    }

    public function statuswd() {

        $activeclosing = Closing::where('status', 'Active')->first();
        $firstrecord = $activeclosing->firstreqwedeid;

        // dd(auth()->user());
        $datareqpersonal = ReqWede::where('createdby',auth()->user()->username)
                        ->where('status','success')
                        ->orderBy('updated_at','desc')
                        ->get(); 
        
        
        $agent = auth()->user()->agent;
        $agentObject = json_decode($agent, true);

        $agentName = null;
            foreach ($agentObject as $key => $value) {
                // Remove the quotes around the key
                $key = trim($key, "'");
                if ($value === 'on') {
                    $agentName = $key;
                    break;
                }
            }


        $datareqagent = ReqWede::where('agent',$agentName)
                        ->where('status','success')
                        ->where('id', '>=', $firstrecord)
                        ->orderBy('updated_at','desc')
                        ->get();
        $datareqsum = ReqWede::where('agent',$agentName)
                        ->whereIn('status', ['success', 'pending', 'open', 'process'])
                        ->where('id', '>=', $firstrecord)
                        ->orderBy('updated_at','desc')
                        ->get();

        return view('reports.statuswd', [
            'data' => $datareqagent,
            'datareqagent' => $datareqagent,
            'totalperagent' => $datareqagent->sum('jumlahwd'),
            'totalallperagent' => $datareqsum->sum('jumlahwd'),
            'datareqpersonal' => $datareqpersonal,
            'totalpersonal' => $datareqpersonal->sum('jumlahwd'),
        ]);
    }

    public function detailwd($uuid) {

        return ReqWede::where('uuid',$uuid)->get();
    }

    public function listwdopen() {

        return view('reports.listwd-open', [
            'title' => 'List WD Open (new Request WD)',
            'data' => ReqWede::where('status','open')
                        ->orderBy('updated_at','desc')
                        ->get()
        ]);
    }

    public function notif() {
        $count = ReqWede::where('status', 'open')->count();
        return $count;
    }

    public function notifgrab() {
        $count = ReqWede::where('status', 'process')->count();
        return $count;
    }

    public function listwdprocess() {

        return view('reports.listwd-process', [
            'title' => 'List WD Process (yang sudah di grab)',
            // 'data' => ReqWede::where('status','process')
            //             ->orderBy('updated_at','desc')
            //             ->get()
            'data' => GrabWede::all()
        ]);
    }

    public function listwdpending() {

        return view('reports.listwd-pending', [
            'title' => 'List WD Pending',
            // 'data' => ReqWede::where('status','pending')
            //             ->orderBy('updated_at','desc')
            //             ->get()
            'data' => PendingLog::where('status','pending')
                        ->orderBy('updated_at','desc')
                        ->get()
        ]);
    }

    public function listwdpersonal() {
        
        $latestactive = Closing::where('status', 'Active')->latest()->first();
        // $data = ProcessLog::where('id', '>=', $latestactive->firstidtransaksiwd)->get();
        // $transactions = ProcessLog::where('id', '>=', $latestactive->firstidtransaksiwd)->get();
        $req = ReqWede::where('id', '>=', $latestactive->firstreqwedeid)->where('updatedby', auth()->user()->username)->get();
        $reqsuccess = ReqWede::where('id', '>=', $latestactive->firstreqwedeid)
                            ->where('updatedby', auth()->user()->username)
                            ->where('status','success')
                            ->get();

        $totalReqPerAgent = $req->groupBy('agent')->map(function($group){
            return $group->groupBy('status')->map(function($statusGroup){
                return $statusGroup->sum('jumlahwd');
            });
        });

        $agents = Agent::all()->map(function ($agent) use ($totalReqPerAgent) {
            $agent->totalTransaksiByStatus = $totalReqPerAgent->get($agent->kodeagent, collect())->toArray();
            $agent->totalTransaksiAllStatus = array_sum($agent->totalTransaksiByStatus);

            return $agent;
        });

        

        return view('reports.listwd-personal', [
            
            'title' => 'List WD Personal All',
            'data' => ReqWede::where('id', '>=', $latestactive->firstreqwedeid)
                        ->where('updatedby', auth()->user()->username)
                        ->get(),
            'totaldata' => $reqsuccess->sum('jumlahwd'),
            'jumlahdata' => $reqsuccess->count(),
            'agents' => $agents

        ]);

    }


    public function listwdpersonalsuccess() {
        
        $latestactive = Closing::where('status', 'Active')->latest()->first();
        // $data = ProcessLog::where('id', '>=', $latestactive->firstidtransaksiwd)->get();
        // $transactions = ProcessLog::where('id', '>=', $latestactive->firstidtransaksiwd)->get();
        $req = ReqWede::where('id', '>=', $latestactive->firstreqwedeid)->where('updatedby', auth()->user()->username)->get();
        $reqsuccess = ReqWede::where('id', '>=', $latestactive->firstreqwedeid)
                            ->where('updatedby', auth()->user()->username)
                            ->where('status','success')
                            ->get();

        $totalReqPerAgent = $req->groupBy('agent')->map(function($group){
            return $group->groupBy('status')->map(function($statusGroup){
                return $statusGroup->sum('jumlahwd');
            });
        });

        $agents = Agent::all()->map(function ($agent) use ($totalReqPerAgent) {
            $agent->totalTransaksiByStatus = $totalReqPerAgent->get($agent->kodeagent, collect())->toArray();
            $agent->totalTransaksiAllStatus = array_sum($agent->totalTransaksiByStatus);

            return $agent;
        });

        

        return view('reports.listwd-personal', [
            
            'title' => 'List WD Personal All',
            'data' => ReqWede::where('id', '>=', $latestactive->firstreqwedeid)
                        ->where('updatedby', auth()->user()->username)
                        ->where('status','success')
                        ->get(),
            'totaldata' => $reqsuccess->sum('jumlahwd'),
            'jumlahdata' => $reqsuccess->count(),
            'agents' => $agents

        ]);

    }

    public function listwdsuccessall() {

        $latestactive = Closing::where('status', 'Active')->latest()->first();
        $req = ReqWede::where('id', '>=', $latestactive->firstreqwedeid)->where('status','success')->get();        

        $totalReqPerAgent = $req->groupBy('agent')->map(function($group){
            return $group->groupBy('status')->map(function($statusGroup){
                return [
                    'total' => $statusGroup->sum('jumlahwd'),
                    'jumlah' => $statusGroup->count(),
                ];
            });
        });

        $agents = Agent::all()->map(function ($agent) use ($totalReqPerAgent) {
            $agent->totalTransaksiByStatus = $totalReqPerAgent->get($agent->kodeagent, collect())->toArray();
            $agent->totalTransaksiAllStatus = array_sum($agent->totalTransaksiByStatus);
            return $agent;
        });

        return view('reports.listwd-success', [
            
            'title' => 'List WD Success All',
            // 'data' => ReqWede::where('status','success')
            //             ->orderBy('updated_at','desc')
            //             ->get()
            'data' => ReqWede::where('id', '>=', $latestactive->firstreqwedeid)
                                ->where('status','success')
                                ->orderBy('updated_at','desc')
                                ->get(),
            'totaldata' => $req->sum('jumlahwd'),
            'jumlahdata' => $req->count(),
            'agents' => $agents

        ]);

    }

    public function listwdclosing(Request $request) {

        $selectedclosing = Closing::where('id', $request->id)->first();
        $latestreq = ReqWede::latest()->first();

        if (!$selectedclosing || !$selectedclosing->endreqwedeid || is_null($selectedclosing->endreqwedeid)){
            $selectedclosing->endreqwedeid = $latestreq->id;
        }

        $req = ReqWede::where('id', '>=', $selectedclosing->firstreqwedeid)
                        ->where('id', '<=', $selectedclosing->endreqwedeid)
                        ->where('status','success')
                        ->get();

        $totalReqPerAgent = $req->groupBy('agent')->map(function($group){
            return $group->groupBy('status')->map(function($statusGroup){
                return $statusGroup->sum('jumlahwd');
            });
        });

        $agents = Agent::all()->map(function ($agent) use ($totalReqPerAgent) {
            $agent->totalTransaksiByStatus = $totalReqPerAgent->get($agent->kodeagent, collect())->toArray();
            $agent->totalTransaksiAllStatus = array_sum($agent->totalTransaksiByStatus);

            return $agent;
        });

        return view('reports.listwd-closing', [
            
            'title' => 'List WD Closing',
            // 'data' => ReqWede::where('status','success')
            //             ->orderBy('updated_at','desc')
            //             ->get()
            'data' => ReqWede::where('id', '>=', $selectedclosing->firstreqwedeid)
                        ->where('id', '<=', $selectedclosing->endreqwedeid)
                        ->where('status','success')
                        ->get(),
            'totaldata' => $req->sum('jumlahwd'),
            'jumlahdata' => $req->count(),
            'agents' => $agents

        ]);

    }


    public function listwdall() {

        $latestactive = Closing::where('status', 'Active')->latest()->first();
        $req = ReqWede::where('id', '>=', $latestactive->firstreqwedeid)->get();  
        $reqsuccess = ReqWede::where('id', '>=', $latestactive->firstreqwedeid)->where('status','success')->get();        

        $totalReqPerAgent = $req->groupBy('agent')->map(function($group){
            return $group->groupBy('status')->map(function($statusGroup){
                return $statusGroup->sum('jumlahwd');
            });
        });

        $agents = Agent::all()->map(function ($agent) use ($totalReqPerAgent) {
            $agent->totalTransaksiByStatus = $totalReqPerAgent->get($agent->kodeagent, collect())->toArray();
            $agent->totalTransaksiAllStatus = array_sum($agent->totalTransaksiByStatus);

            return $agent;
        });

        return view('reports.listwd-all', [
            
            'title' => 'List WD All',
            // 'data' => ReqWede::where('status','success')
            //             ->orderBy('updated_at','desc')
            //             ->get()
            'data' => ReqWede::where('id', '>=', $latestactive->firstreqwedeid)
                            ->orderBy('updated_at','desc')
                            ->get(),
            'totaldata' => $reqsuccess->sum('jumlahwd'),
            'jumlahdata' => $reqsuccess->count(),
            'agents' => $agents

        ]);

    }


    public function listwdreject() {

        return view('reports.listwd-reject', [
            'title' => 'List WD Reject',
            'data' => ReqWede::where('status','reject')
                        ->orderBy('updated_at','desc')
                        ->get()
        ]);
    }


    

    public function rekapwdsuccess() {

        return view('reports.rekapwd-success', [
            'name' => 'Adams'
        ]);
    }

    public function rekapwdpending() {

        return view('reports.rekapwd-pending', [
            'name' => 'Adams'
        ]);
    }

    public function rekapwdreject() {

        return view('reports.rekapwd-reject', [
            'name' => 'Adams'
        ]);
    }

    public function rekapwdopen() {

        return view('reports.rekapwd-open', [
            'name' => 'Adams'
        ]);
    }

    public function rekapwdprocess() {

        return view('reports.rekapwd-process', [
            'name' => 'Adams'
        ]);
    }
}
