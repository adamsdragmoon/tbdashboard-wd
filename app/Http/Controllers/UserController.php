<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;


class UserController extends Controller
{
    //
    public function show() {
        $this->authorize('access-user');
        return view('settings.users', [
            'name' => 'Adams',
            'link' => '/settings/users',
            'title' => 'Manage Users',
            'users' => User::all(),
            'dataagen' => Agent::all(),
        ]);
    }

    
    
    public function view(User $user){
        if(auth()->user()->username !== $user->username) {
            abort(403);
        }
        
        return view('settings.usershow', [
            'name' => 'Adams',
            'link' => '/settings/user',
            'title' => 'View Users',
            'user' => $user,   
        ]);

    }

    public function edit(User $user) {

        if(auth()->user()->username !== $user->username) {
            abort(403);
        }
        return view('settings.user', [
            'name' => 'Adams',
            'link' => '/settings/user',
            'title' => 'Edit Users',
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user) {
    // Ensure the logged in user is the same as the user being edited
    if (auth()->user()->username !== $user->username) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'password' => 'required | confirmed',
    ]);

    $user->password = bcrypt($request->password);
    $user->save();

    return redirect()->route('settings.user', $user);
    }


    public function delete(User $user) {
        
        
    $this->authorize('access-user');


        $user->delete();
        return redirect('/settings/users');
    }

   
    public function store(Request $request) {

        $this->authorize('access-user');
        
       
       $validated = $request->validate([
            'name' => 'required',
            'username' => 'required | unique:users',
            'password' => 'required',
            'role' => ['required '],
            'department' => 'required',
            'maxwd' => 'required',
            'agent'=> 'required',
        ]);
        
        $validated['password'] = bcrypt($validated['password']);
        $validated['is_active'] = ($request->is_active === 'on') ? 1 : 0;
        $validated['agent'] = json_encode($validated['agent']);
        // return ($validated);
        
        User::create($validated);
        $request->session()->flash('success', 'User has been added!');
        return redirect('/settings/users');
        
        // return $request->all();
        // return json_encode($request->agents);
    }

    public function resetlogin(User $user) {
        $this->authorize('access-user');
        
        $user->update([
            'isLogin' => 0
        ]);

        return redirect('/settings/users');

    }

    
}
