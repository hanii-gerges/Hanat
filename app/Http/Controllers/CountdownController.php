<?php

namespace App\Http\Controllers;

use App\Models\Countdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'finishTime' => 'required|date'
        ]);

        $countdown = Countdown::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'finishTime' => $request->finishTime,
        ]);

        return response()->json(['status' => 'ok']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Countdown  $countdown
     * @return \Illuminate\Http\Response
     */
    public function show(Countdown $countdown)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Countdown  $countdown
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Countdown $countdown)
    {
        $request->validate([
            'title' => 'required',
            'finishTime' => 'required|date'
        ]);

        $countdown->update([
            'title' => $request->title,
            'finishTime' => $request->finishTime,
        ]);

        return response()->json(['status' => 'ok']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Countdown  $countdown
     * @return \Illuminate\Http\Response
     */
    public function destroy(Countdown $countdown)
    {
        $countdown->delete();
        return response()->json(['status' => 'ok']);

    }
}
