<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    
    protected $fillable = ["firstname", "name", "birthdate", 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function hasDirected()
    {
        return $this->hasMany(Movie::class);
    }

    public function hasPlayed()
    {
        return $this->belongsToMany(Movie::class)->withPivot('role_name');
    }
}
