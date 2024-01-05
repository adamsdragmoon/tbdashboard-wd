<?php

namespace App\Http\Controllers;

use App\Models\ReqWede;
use Illuminate\Http\Request;

class ReqWedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('cs.reqwd.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReqWede $reqWede)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReqWede $reqWede)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReqWede $reqWede)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReqWede $reqWede)
    {
        //
    }
}
