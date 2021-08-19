<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const TYPE_OPEN = 'Open';
    public const TYPE_PRIVATE = 'Private';

    public const TYPE_LIGHT_WEIGHT = 'Light Weight';
    public const TYPE_HEAVY_WEIGHT = 'Heavy Weight';

    public function getAllowJoinForHumanAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }


    // who created user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // league athletes
    public function athletes()
    {
        return $this->belongsToMany(User::class, 'athlete_league', 'league_id','athlete_id');
    }

}
