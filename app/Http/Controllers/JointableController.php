<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mpociot\Teamwork\TeamworkTeam;

class JointableController extends Controller
{
    public function index()
    {
    	$teamlist = User::join('teams', 'teams.id', '=', 'users.current_team_id')
              		->get(['users.name as username', 'teams.name as team', 'users.firstname as first_name', 'users.surname as surname']);

       	/*Above code will produce following query

        SELECT
        users.name as Username,
        users.firstname as first_name,
        users.surname as surname,
        teams.name as Team
        FROM ergnation.users
        INNER JOIN ergnation.teams ON users.current_team_id=teams.id;
        */

        return view('teamlist', compact('teamlist'));
    }
}
