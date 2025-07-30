<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{

    protected $fillable = [
        'club_id',
        'license_type',
        'issue_date',
        'expiry_date',
        'remarks',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
