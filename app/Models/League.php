<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;
    protected $guarded = [];

    // who created user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // league athletes
    public function athletes()
    {
        return $this->belongsToMany(User::class, 'athlete_league', 'league_id');
    }

}
