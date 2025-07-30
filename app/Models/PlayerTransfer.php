<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'from_club_id',
        'to_club_id',
        'transfer_fee',
        'transfer_date',
        'contract_duration',
        'status',
        'notes',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function fromClub()
    {
        return $this->belongsTo(Club::class, 'from_club_id');
    }

    public function toClub()
    {
        return $this->belongsTo(Club::class, 'to_club_id');
    }
}
