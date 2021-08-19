<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeagueStoreRequest;
use App\User;
use Arr;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function index()
    {
        return  view('league.index');
    }

    public function create()
    {
        $athletes = User::role('Athlete')->get();
        return  view('league.create', compact('athletes'));
    }

    public function store(LeagueStoreRequest $request)
    {
        $league = auth()->user()->leagues()->create(Arr::except($request->validated(), 'athletes'));

        // store athletes
        $league->athletes()->attach($request->athletes);

        return redirect()->route('league.index')->with('success', 'New league created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
