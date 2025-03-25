<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillabe = ['title', 'year'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function director()
    {
        return $this->belongsTo(Artist::class);
    }

    public function hasDirected()
    {
        return $this->hasMany(Movie::class, 'director_id');
    }

    public function actors()
    {
        return $this->belongsToMany(Artist::class);
    }
}
