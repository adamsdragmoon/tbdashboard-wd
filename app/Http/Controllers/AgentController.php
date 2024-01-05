<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;

class AgentController extends Controller
{
    //
    
    public function show(Agent $agent) {
        return view('settings.agents', [
            'title' => 'Show and Manage Agents',
            'agents' => Agent::all(),
            'providers' => \App\Models\GameProvider::all()
        ]);
    }

    public function create(Request $request) {

        $validated = $request->validate([
            'kodeagent' => ['required', 'unique:agents'],
            'namaagent' => 'required',
            'kodeprovider' => 'required'
        ]);
        
        Agent::create($validated);
        $request->session()->flash('success', 'New Agents Provider has been added!');
        return redirect('/settings/agents');

        
    }
}
