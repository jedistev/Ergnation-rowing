<?php

namespace App;

use App\Models\League;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Mpociot\Teamwork\Traits\UserHasTeams;


class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles;
    use UserHasTeams;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'firstname','surname','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function get_roles(){
        $roles = [];
        foreach ($this->getRoleNames() as $key => $role) {
            $roles[$key] = $role;
        }

        return $roles;
    }

    // leagues for users who created
    public function leagues()
    {
        return $this->hasMany(League::class, 'user_id');
    }

    // athlete leagues from pivot table
    public function athleteLeagues()
    {
        return $this->belongsToMany(League::class, 'athlete_league', 'league_id');
    }
}
