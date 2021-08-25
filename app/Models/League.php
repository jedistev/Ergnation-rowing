<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class League extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const TYPE_OPEN = 'Open';
    public const TYPE_PRIVATE = 'Private';

    public const TYPE_LIGHT_WEIGHT = 'Light Weight';
    public const TYPE_HEAVY_WEIGHT = 'Heavy Weight';

    public const MACHINE_ROWING = 'Rowing';
    public const MACHINE_BIKE = 'Bike';
    public const MACHINE_SKIING = 'Skiing';

    public const AGE_GROUP = [
        '0-12',
        '13-18',
        '19-29',
        '30-39',
        '40-49',
        '50-59',
        '60-69',
        '60-69',
        '70-89',
        '90+',
    ];

    public function getLogoUrlAttribute()
    {
        return Storage::disk('s3')->url($this->logo);
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

    // results
    public function results()
    {
        return $this->hasMany(AthleteResults::class, 'league_id');
    }

}
