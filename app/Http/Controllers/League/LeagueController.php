<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeagueStoreRequest;
use App\Models\League;
use App\User;
use Arr;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function index()
    {
        $leagues = League::withCount('athletes')->get();
        return  view('league.index', compact('leagues'));
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

    public function edit(League $league)
    {
        $athletes = User::role('Athlete')->get();
        $leagueAthletes = $league->athletes()->pluck('athlete_id')->toArray();
        return  view('league.edit', compact('athletes', 'league', 'leagueAthletes'));
    }

    public function update(LeagueStoreRequest $request, League $league)
    {
        $league->update(Arr::except($request->validated(), 'athletes'));
        $league->athletes()->sync($request->athletes);
        return redirect()->route('league.index')->with('success', 'league updated!');
    }

    public function destroy(League $league)
    {
        $league->athletes()->detach();
        $league->delete();
        return redirect()->route('league.index')->with('success', 'league deleted!');
    }

    public function athletes(League $league)
    {
        $athletes = $league->athletes;
        return view('league.league-athletes', compact('athletes'));
    }
}
