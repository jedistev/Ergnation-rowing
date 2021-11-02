<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeagueStoreRequest;
use App\Http\Requests\LeagueUpdateRequest;
use App\Models\League;
use App\Models\Leagueregistration;
use App\User;
use Arr;
use Illuminate\Http\Request;
use Storage;
use Auth;
use DB;

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

    public function openleagues()
    {
        $leagues = League::withCount('athletes')->where('type','Open')->get();
        return  view('league.open-league', compact('leagues'));
    }

    public function myregisteredleagues()
    {
        $userid = Auth::user()->id;

        $leagues = DB::table('athlete_league')
    ->leftJoin('leagues', 'athlete_league.league_id', '=', 'leagues.id')->where('athlete_league.athlete_id', '=',$userid)->get();

        //$leagues = League::withCount('athletes')->where('type','Open')->get();
        return  view('league.my-registered-leagues', compact('leagues'));
    }

    public function joinLeague(Request $request)
    {
        $user_id = Auth::user()->id;
        $league_id = $request->leagueid;
        $league = League::where('id',$league_id)->first();

        $already = Leagueregistration::where('league_id',$league_id)->where('user_id',Auth::user()->id)->count();
        
        if($already == 0)
        {
            DB::table('athlete_league')->insert(
                ['athlete_id' => Auth::user()->id,'league_id'=> $league_id]
              );
        }

        return response()->json([
                'status'=> true,
                'data'=> "Your registration has been sent to organizer.Thanks for registration in league."
                ]);
    }


    public function LeaveLeague(Request $request)
    {
        $user_id = Auth::user()->id;
        $league_id = $request->leagueid;
        $league = League::where('id',$league_id)->first();

        $delete = DB::table('athlete_league')->where('league_id', $league_id)->where('athlete_id',$user_id)->delete();

        return response()->json([
                'status'=> true,
                'data'=> "Your registration has been canceled."
                ]);
    }

    /** Individual create league **/

    public function myleagues()
    {
        $userid = Auth::user()->id;
        $leagues = League::where('user_id',$userid)->withCount('athletes')->get();
        return  view('league.individual.index', compact('leagues'));
    }

    public function league_leaderboard($id)
    {
        $userid = Auth::user()->id;
        $athletes = DB::table('athlete_results')->where('league_id',$id)->orderBy('hours', 'ASC')->orderBy('minutes', 'ASC')->orderBy('seconds', 'ASC')->get();
        
        $league = League::where('id',$id)->first();

        $upload_count = DB::table('athlete_results')->where('league_id',$id)->where('athlete_id',$userid)->count();

        return  view('league.individual.leaderboard', compact('athletes','league','upload_count'));
    }


}
