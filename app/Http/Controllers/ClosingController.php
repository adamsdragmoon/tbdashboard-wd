<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Closing;
use App\Models\ProcessLog;
use App\Models\ReqWede;



class ClosingController extends Controller
{
    //
    public function index() {
        return view('settings.closing.daily', [
            'title' => 'Daily Closing Withdrawal Transactions',
            'data' => Closing::orderBy('id', 'desc')->get()
        ]);
    }


    public function closeShift() {
        $this->authorize('access-closeShift');

        $last_closing = Closing::latest()->first();
        $last_success = ProcessLog::latest()->first();
        $lastrequest = ReqWede::latest()->first();
        $nextIncrement = DB::select("SHOW TABLE STATUS LIKE 'process_logs'")[0]->Auto_increment;

        if (!$last_success) {
                $lastidtransaksiwd = 0;
                $firstidtransaksiwd = 1;
            } else {
                $lastidtransaksiwd = $last_success->lastidtransaksiwd;
                $firstidtransaksiwd = $last_success->lastidtransaksiwd + 1;
            };

        if ($lastrequest) {
        $last_closing->update([
            'lastidtransaksiwd' => $lastidtransaksiwd,
            'firstidtransaksiwd'=> $firstidtransaksiwd,
            'endidtransaksiwd' => $nextIncrement -1,
            'status' => 'Closed',
            'closingby' => auth()->user()->username,
            'endreqwedeid' => $lastrequest->id,
            'closed_at' => now(),
        ]);
        }

        $lastclosing = Closing::latest()->first();

        if(is_null($lastclosing->endidtransaksiwd)) {
            $endidtransaksiwd = $nextIncrement - 1;
        } else {
            $endidtransaksiwd = $lastclosing->endidtransaksiwd;
        };

        Closing::create([
            'tgltransaksiwd' => now(),
            'opened_at' => now(),
            'lastidtransaksiwd'=> $endidtransaksiwd,
            'firstidtransaksiwd'=> $endidtransaksiwd + 1,
            'openby'=> auth()->user()->username,
            'lastreqwedeid' => $lastrequest->id,
            'firstreqwedeid' => $lastrequest->id + 1
        ]);

        return redirect('/settings/closing');

    }

    public function deleteShift() {
        $this->authorize('access-deleteShift');
        
        $total_closing = Closing::count();

        if($total_closing >1) {
            $last_closing = Closing::latest()->first();

            if ($last_closing) {
            $last_closing->delete();
            }

            $lastclosing = Closing::latest()->first();
            $lastclosing->update([
                'endidtransaksiwd' => null,
                'closingby' => null,
                'status' => 'Active',
                'endreqwedeid' => null,
                'closed_at' => null,
            ]);
            
        }
        
        return redirect('/settings/closing');

    }

    // public function history() {
    //     $latestactive = Closing::where('status', 'Active')->latest()->first();

    //     return ProcessLog::where('id', '>=', $latestactive->firstidtransaksiwd)->get();

    // }
}
