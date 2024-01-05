<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameProvider;
use App\Models\Agent;

class GameProviderController extends Controller
{
    //

    public function show() {
        return view('settings.providers', [
            'name' => 'Adams',
            'link' => '/settings/providers',
            'title' => 'Show and Manage Game Providers',
            'providers' => GameProvider::all()
        ]);
    }

    public function create(Request $request) {

        // return ($request);
        
        $validated = $request->validate([
            'kodeprovider' => ['required', 'unique:providers'],
            'namaprovider' => 'required',
        ]);
        
        GameProvider::create($validated);
        $request->session()->flash('success', 'New Game Provider has been added!');
        return redirect('/settings/providers');


    }



    public function find($kodeprovider) {
        return view('settings.provider', [
            'title' => 'Show Agents for Provider  : ' . $kodeprovider,
            'gp' => Agent::where('kodeprovider', $kodeprovider)->get(),
        ]);
    }
}
