<?php

namespace App\Http\Controllers\Athlete;

use App\Http\Controllers\Controller;
use App\Http\Requests\AthleteResultStoreRequest;
use App\Models\League;
use Arr;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function create(League $league)
    {
        return view('athlete.results.create', compact('league'));
    }

    public function store(AthleteResultStoreRequest $request, League $league)
    {
        $path = $request->file('proof_photo')->store('proof_photo', 's3');

        $result = $league->results()->make(Arr::except($request->validated(), ['proof_photo']));
        $result->proof_photo = $path;
        $result->athlete_id = auth()->id();
        $result->save();

        return redirect()->route('athlete.my-leagues')->with('success', 'Result uploaded!');
    }

    public function show(League $league)
    {
        dd($league);
    }
}
