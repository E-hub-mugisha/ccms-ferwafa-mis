<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    protected $fillable = [
        'club_id',
        'first_name',
        'last_name',
        'birth_date',
        'position',
        'photo',
        'nationality'
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
