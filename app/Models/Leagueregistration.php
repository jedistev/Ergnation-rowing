<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leagueregistration extends Model
{
    use HasFactory;
     protected $fillable = [
        'league_id',
        'user_id',
        
    ];
}
