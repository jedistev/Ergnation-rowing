<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class AthleteResults extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getProofUrlAttribute()
    {
        return Storage::disk('s3')->url($this->proof_photo);
    }

    // league
    public function league()
    {
        return $this->belongsTo(League::class, 'league_id')->withDefault();
    }
}
