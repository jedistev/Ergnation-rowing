<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mpociot\Teamwork\TeamworkTeam;

class TeamUserListController extends Controller
{
    public function index()
    {
    	$teamlistfliter = User::join('teams', 'teams.id', '=', 'users.current_team_id')
              		->get(['users.name as username', 'teams.name as team', 'users.firstname as first_name', 'users.surname as surname']);
        return view('teamlistfliter', compact('teamlistfliter'));
    }



}
