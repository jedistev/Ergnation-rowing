<?php

namespace App\Http\Controllers\Athlete;

use App\Http\Controllers\Controller;
use App\Http\Requests\AthleteResultStoreRequest;
use App\Models\AthleteResults;
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

        $result = $league->results()->make(Arr::except(
            $request->validated() + ['type' => $league->machine_type, 'weight_class' => $league->category],
            ['proof_photo']));
        $result->proof_photo = $path;
        $result->athlete_id = auth()->id();
        $result->save();

        return redirect()->route('athlete.my-leagues')->with('success', 'Result uploaded!');
    }

    public function show(League $league)
    {
        $result = AthleteResults::where('league_id', $league->id)
            ->where('athlete_id', auth()->id())->first();

        return view('athlete.results.show', compact('result'));
    }
}
