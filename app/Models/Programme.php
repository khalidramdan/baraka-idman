<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'programme_type',
    ];

    /**
     * Get the places for the programme.
     */
    public function places()
    {
        return $this->hasMany(Place::class);
    }
}