<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone', 'user_id'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class)
            ->withPivot('screening_time')
            ->withTimestamps();
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
