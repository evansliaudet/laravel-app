<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'year',
        'director_id',
        'country_id',
        'user_id',
    ];

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
        return $this->hasMany(Movie::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Artist::class, 'artist_movie')->withPivot(
            'role_name'
        );
    }

    public function cinemas()
    {
        return $this->belongsToMany(Cinema::class)
            ->withPivot('screening_time')
            ->withTimestamps();
    }
}
