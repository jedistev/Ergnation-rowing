<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeagueStoreRequest;
use App\Http\Requests\LeagueUpdateRequest;
use App\Models\League;
use App\User;
use Arr;
use Illuminate\Http\Request;
use Storage;

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
        $path = $request->file('logo')->store('logos', 's3');

        $league = auth()->user()->leagues()->make(Arr::except(  $request->validated(), ['athletes', 'logo']));
        $league->logo = $path;
        $league->save();

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

    public function update(LeagueUpdateRequest $request, League $league)
    {
        $validate = Arr::except(  $request->validated(), ['athletes', 'logo']);
        if ($request->has('logo')){
            // delete old file
            Storage::disk('s3')->delete($league->logo);

            // upload new file
            $path = $request->file('logo')->store('logos', 's3');
            $validate['logo'] = $path;
        }

        $league->update($validate);
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
