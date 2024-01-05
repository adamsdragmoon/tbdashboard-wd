<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grab;
use App\Models\ReqWede;
use App\Models\GrabWede;
use App\Models\Agent;
use App\Models\ProcessLog;
use App\Models\PendingLog;
use App\Models\Closing;


class TransactionsController extends Controller
{
    //
    public function input() {
        $activeclosing = Closing::where('status', 'Active')->first();
        $firstrecord = $activeclosing->firstreqwedeid;

        $agentCodes = json_decode(auth()->user()->agent, true);
        $firstAgentCode = array_keys($agentCodes)[0];
        $UserAgentCode = trim($firstAgentCode, "'");
        $useragen = Agent::where('kodeagent', $UserAgentCode)->first();

        // $agent = auth()->user()->agent;
        // $agentObject = json_decode($agent, true);

        // $agentName = null;
        //     foreach ($agentObject as $key => $value) {
        //         // Remove the quotes around the key
        //         $key = trim($key, "'");
        //         if ($value === 'on') {
        //             $agentName = $key;
        //             break;
        //         }
        //     }

        $datareqsum = ReqWede::where('agent',$UserAgentCode)
                        ->whereIn('status', ['success', 'pending', 'open', 'process'])
                        ->where('id', '>=', $firstrecord)
                        ->orderBy('updated_at','desc')
                        ->get();

        return view('transactions.inputreqwd', [
            'title' => 'Input Request Withdrawal',
            'agents' => $useragen,
            'provider' => $useragen->kodeprovider,
            'data' => ReqWede::where('createdby',auth()->user()->username)
                        ->whereIn('status', ['open', 'process'])
                        ->orderBy('created_at','desc')
                        ->get(),
            'totalreqall' => $datareqsum->sum('jumlahwd'),
            'test' =>  $firstrecord
            
        ]);

    }

    public function store(Request $request) {

        $agentCodes = json_decode(auth()->user()->agent, true);
        $firstAgentCode = array_keys($agentCodes)[0];
        $UserAgentCode = trim($firstAgentCode, "'");
       
       $validated = $request->validate([
            'tglwktrequest' => 'required',
            'agent' => ['required', 'in:' . $UserAgentCode],
            'memberid' => 'required',
            'saldomember' => 'required',
            'namarek' => 'required',
            'namabank'=> 'required',
            'norek' => 'required',
            'jumlahwd' => 'required',
            'kategorirek'=> 'required'

        ]);
        $validated['slug'] = $validated['memberid'].'-'.$validated['saldomember'].'-'.$validated['jumlahwd'] . '-' . $validated['tglwktrequest'];
        $validated['createdby'] = auth()->user()->username ?? 'null';

        $existingSlug = ReqWede::where('slug', $validated['slug'])->first();
        if($existingSlug) {
            session()->flash('error', 'Data sudah ada!');
            return redirect('/cs/input-reqwd');
        }
        // return ($validated);
        
        ReqWede::create($validated);
        $request->session()->flash('success', 'New WD Request has been added!');
        return redirect('/cs/input-reqwd');
        
        // return $request->all();
        // return json_encode($request->agents);
    }


    public function start() {

        return view('transactions.grabreqwd', [
            'title' => 'Grab Request Withdrawal',
            'grabbed_data' => GrabWede::where('processedby',auth()->user()->username ?? 'default')->get()
        ]);
    }

    public function grab(GrabWede $grab) {

        $count = GrabWede::where('processedby', auth()->user()->username ?? 'default')->count();
        if($count > 0) {
            session()->flash('errorGrab', 'Silahkan selesaikan terlebih dahulu transaksi yang sudah digrab sebelumnya!');
            return redirect()->back();
        };

        

        $req_data = ReqWede::select('uuid','tglwktrequest','memberid', 'saldomember', 'kategorirek', 'namarek', 'namabank', 'norek', 'jumlahwd', 'agent', 'createdby', 'created_at')
                    ->orderBy('created_at', 'asc')
                    // ->where('createdby',auth()->user()->username ?? 'default')
                    ->where('status','open')
                    ->take(5)->get();

       
        foreach ($req_data as $data) {
            $grabbed_data = new GrabWede;
            $grabbed_data['req_uuid'] = $data->uuid;
            $grabbed_data['tglwktrequest'] = $data->tglwktrequest;
            $grabbed_data['memberid'] = $data->memberid;
            $grabbed_data['saldomember'] = $data->saldomember;
            $grabbed_data['kategorirek'] = $data->kategorirek;
            $grabbed_data['namarek'] = $data->namarek;
            $grabbed_data['namabank'] = $data->namabank;
            $grabbed_data['norek'] = $data->norek;
            $grabbed_data['jumlahwd'] = $data->jumlahwd;
            $grabbed_data['agent'] = $data->agent;
            $grabbed_data['createdby'] = $data->createdby;
            $grabbed_data['processedby'] = auth()->user()->username ?? 'default';
            $grabbed_data['tglwktcreate'] = $data->created_at;
            $grabbed_data->save();
            ReqWede::where('uuid',$data->uuid ?? 'open')->update(['status' => 'process']);
        }

        // return GrabWede::where('processedby',auth()->user()->username ?? 'default')->get();
        return redirect('/fin/grab-reqwd');

    }

    public function list() {

        // return ReqWede::orderBy('created_at', 'asc')->take(2)->get();
        return GrabWede::where('processedby',auth()->user()->username ?? 'default')->get();

        

        // return view('transactions.openreqwd', [
        //     'name' => 'Adams',
        //     'link' => '/fin/show-reqwd',
        //     'title' => 'Show New Request Withdrawal (Status : Open)'
        // ]);
    }


    public function show($uuid) {

        $dataprocess = GrabWede::where('req_uuid',$uuid)->first();

        $namabank = strtolower(str_replace(' ', '', $dataprocess->namabank));
        $kodetransfer = '';

        // Check the value of $dataprocess->namabank
        if ($namabank === 'dana') {
            $kodetransfer = '3901';
        } elseif ($namabank === 'linkaja') {
            $kodetransfer = '09110';
        } elseif ($namabank === 'ovo') {
            $kodetransfer = '39358';
        } elseif ($namabank === 'gopay') {
            $kodetransfer = '70001';
        } else $kodetransfer = '';

        // Concatenate $kodetransfer and $dataprocess->norek
        $tujuantransfer = $kodetransfer . $dataprocess->norek;
        

        // return ReqWede::orderBy('created_at', 'asc')->take(2)->get();
        // return GrabWede::where('req_uuid',$uuid ?? 'default')->get();

        return view('transactions.processreqwd', [
            'title' => 'Process Request Withdrawal',
            'process_data' => $dataprocess,
            'tujuantransfer' => $tujuantransfer
        ]);
    }


    public function process($uuid) {

        $grabbed_data = GrabWede::where('req_uuid',$uuid)->first();

        $validated = request()->validate([
            'biayaproses' => 'required | integer',  
        ]);

        $validated['req_uuid'] = $grabbed_data->req_uuid; 
        $validated['memberid'] = $grabbed_data->memberid;
        $validated['saldomember'] = $grabbed_data->saldomember;
        $validated['tglwktrequest'] = $grabbed_data->tglwktrequest;
        $validated['namarek'] = $grabbed_data->namarek;
        $validated['namabank'] = $grabbed_data->namabank;
        $validated['norek'] = $grabbed_data->norek;
        $validated['jumlahwd'] = $grabbed_data->jumlahwd;
        $validated['agent'] = $grabbed_data->agent;
        $validated['dibuat_oleh'] = $grabbed_data->createdby;
        $validated['tglwktdibuat'] = $grabbed_data->created_at;
        $validated['diproses_oleh'] = $grabbed_data->processedby;
        $validated['tglwktdiproses'] = $grabbed_data->updated_at;
        $validated['status'] = 'success';
        $validated['biaya_proses'] = $validated['biayaproses'];

        ProcessLog::create($validated);
        GrabWede::where('req_uuid',$uuid)->delete();
        ReqWede::where('uuid',$uuid)->update([
            'status' => 'success',
            'updatedby' => auth()->user()->username
        ]);
        session()->flash('success', 'Transaksi berhasil diproses!');
        return redirect('/fin/grab-reqwd');
    }

    public function cancel($uuid) {
        GrabWede::where('req_uuid',$uuid)->delete();
        ReqWede::where('uuid',$uuid)->update([
            'status' => 'open',
            'updatedby' => auth()->user()->username
        ]);
        session()->flash('success', 'Transaksi berhasil dibatalkan!');
        return redirect('/fin/grab-reqwd');
    }

    public function pending($uuid) {
        $datagrab = GrabWede::where('req_uuid',$uuid)->first();
        $datareq = ReqWede::where('uuid',$uuid)->first();

        GrabWede::where('req_uuid',$uuid)->delete();
        ReqWede::where('uuid',$uuid)->update([
            'status' => 'pending',
            'updatedby' => auth()->user()->username
        ]);

        $updateprocess = New PendingLog;
        $updateprocess['req_uuid'] = $datareq->uuid;
        $updateprocess['status'] = 'pending';
        $updateprocess['memberid'] = $datareq->memberid;
        $updateprocess['saldomember'] = $datareq->saldomember;
        $updateprocess['tglwktrequest'] = $datareq->tglwktrequest;
        $updateprocess['namarek'] = $datareq->namarek;
        $updateprocess['namabank'] = $datareq->namabank;
        $updateprocess['norek'] = $datareq->norek;
        $updateprocess['jumlahwd'] = $datareq->jumlahwd;
        $updateprocess['agent'] = $datareq->agent;
        $updateprocess['dibuat_oleh'] = $datareq->createdby;
        $updateprocess['tglwktdibuat'] = $datareq->created_at;
        $updateprocess['diproses_oleh'] = auth()->user()->username ?? 'default';
        $updateprocess['tglwktdiproses'] = $datagrab->created_at;
        $updateprocess['biaya_proses'] = 0;
        $updateprocess['catatanproses'] ="";
        $updateprocess->save();

        session()->flash('success', 'Transaksi berhasil diupdate dengan status pending!');
        return redirect('/fin/grab-reqwd');
    }

    public function updatepending($uuid) {
        $dataprocess = PendingLog::where('req_uuid',$uuid)->first();

        PendingLog::where('req_uuid',$uuid)->delete();
        ReqWede::where('uuid',$uuid)->update([
            'status' => 'success',
            'updatedby' => auth()->user()->username    
        ]);

        $updateprocess = New ProcessLog;
        $updateprocess['req_uuid'] = $dataprocess->req_uuid;
        $updateprocess['status'] = 'success';
        $updateprocess['memberid'] = $dataprocess->memberid;
        $updateprocess['saldomember'] = $dataprocess->saldomember;
        $updateprocess['tglwktrequest'] = $dataprocess->tglwktrequest;
        $updateprocess['namarek'] = $dataprocess->namarek;
        $updateprocess['namabank'] = $dataprocess->namabank;
        $updateprocess['norek'] = $dataprocess->norek;
        $updateprocess['jumlahwd'] = $dataprocess->jumlahwd;
        $updateprocess['agent'] = $dataprocess->agent;
        $updateprocess['dibuat_oleh'] = $dataprocess->dibuat_oleh;
        $updateprocess['tglwktdibuat'] = $dataprocess->created_at;
        $updateprocess['diproses_oleh'] = auth()->user()->username ?? 'default';
        $updateprocess['tglwktdiproses'] = now();
        $updateprocess['biaya_proses'] = 0;
        $updateprocess->save();

        session()->flash('success', 'Transaksi berhasil diupdate!');
        return redirect('/reports/list-wd-pending');

    }

    public function rejectpending($uuid) {

        PendingLog::where('req_uuid',$uuid)->delete();
        ReqWede::where('uuid',$uuid)->update([
            'status' => 'reject',
            'updatedby' => auth()->user()->username
        ]);

        session()->flash('success', 'Transaksi berhasil direject!');
        return redirect('/fin/grab-reqwd');

    }

    public function reject($uuid) {
        $datagrab = GrabWede::where('req_uuid',$uuid)->first();
        $datareq = ReqWede::where('uuid',$uuid)->first();

        GrabWede::where('req_uuid',$uuid)->delete();
        ReqWede::where('uuid',$uuid)->update([
            'status' => 'reject',
            'updatedby' => auth()->user()->username
        ]);

        // $updateprocess = New ProcessLog;
        // $updateprocess['req_uuid'] = $datareq->uuid;
        // $updateprocess['status'] = 'reject';
        // $updateprocess['memberid'] = $datareq->memberid;
        // $updateprocess['saldomember'] = $datareq->saldomember;
        // $updateprocess['tglwktrequest'] = $datareq->tglwktrequest;
        // $updateprocess['namarek'] = $datareq->namarek;
        // $updateprocess['namabank'] = $datareq->namabank;
        // $updateprocess['norek'] = $datareq->norek;
        // $updateprocess['jumlahwd'] = $datareq->jumlahwd;
        // $updateprocess['agent'] = $datareq->agent;
        // $updateprocess['dibuat_oleh'] = $datareq->createdby;
        // $updateprocess['tglwktdibuat'] = $datareq->created_at;
        // $updateprocess['diproses_oleh'] = auth()->user()->username ?? 'default';
        // $updateprocess['tglwktdiproses'] = $datagrab->created_at;
        // $updateprocess['biaya_proses'] = 0;
        // $updateprocess->save();

        session()->flash('success', 'Transaksi berhasil ditolak!');
        return redirect('/fin/grab-reqwd');
    }

    
}
