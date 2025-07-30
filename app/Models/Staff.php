<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $fillable = [
        'club_id',
        'name',
        'position',
        'email',
        'phone',
        'photo',
        'bio',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
