<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    // app/Models/Club.php
    protected $fillable = [
        'name',
        'stadium',
        'city',
        'email',
        'description',
        'logo'
    ];

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
