<?php

namespace App\Http\Controllers\Athlete;

use App\Http\Controllers\Controller;

class LeagueController extends Controller
{
    public function myLeagues()
    {
        $leagues = auth()->user()->athleteLeagues;
        return view('athlete.leagues.my-leagues', compact('leagues'));
    }
}
