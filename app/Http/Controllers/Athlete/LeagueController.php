<?php

namespace App\Http\Controllers\Athlete;

use App\Http\Controllers\Controller;
use App\Models\League;

class LeagueController extends Controller
{
    public function myLeagues()
    {
        $leagues = auth()->user()->athleteLeagues;
        return view('athlete.leagues.my-leagues', compact('leagues'));
    }

    public function leave(League $league)
    {
        $league->whereHas('athletes', function ($q){
            $q->where('athlete_id', auth()->id());
        })->delete();

        session()->flash('success', 'You left league successfully.');
        return redirect()->back();
    }
}
