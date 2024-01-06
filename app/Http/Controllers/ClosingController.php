<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // $last_success = ProcessLog::latest()->first();
        $lastrequest = ReqWede::latest()->first();

        if ($lastrequest) {
        $last_closing->update([
            // if ( !$last_success) {
            //     $last_success->lastidtransaksiwd = 0,
            //     $last_success->firstidtransaksiwd = 1
            // }
            // 'endidtransaksiwd' => 0,
            'status' => 'Closed',
            'closingby' => auth()->user()->username,
            'endreqwedeid' => $lastrequest->id
        ]);
        }

        $lastclosing = Closing::latest()->first();

        Closing::create([
            'tgltransaksiwd' => now(),
            // 'lastidtransaksiwd'=> $lastclosing->endidtransaksiwd,
            // 'firstidtransaksiwd'=> $lastclosing->endidtransaksiwd + 1,
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
                'endreqwedeid' => null
            ]);
            
        }
        
        return redirect('/settings/closing');

    }

    // public function history() {
    //     $latestactive = Closing::where('status', 'Active')->latest()->first();

    //     return ProcessLog::where('id', '>=', $latestactive->firstidtransaksiwd)->get();

    // }
}
