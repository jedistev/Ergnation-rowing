<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mpociot\Teamwork\TeamworkTeam;
use DB;

class TeamUserListController extends Controller
{
    public function index()
    {
    	$teamlistfliter = User::join('teams', 'teams.id', '=', 'users.current_team_id')
              		->get(['users.name as username', 'teams.name as team', 'users.firstname as first_name', 'users.surname as surname']);

      
        $teamnames = User::join('teams', 'teams.id', '=', 'users.current_team_id')
         ->select('users.current_team_id as team')
         ->groupBy('users.current_team_id')
         ->get();


        return view('teamlistfliter', compact('teamlistfliter','teamnames'));
    }
}
