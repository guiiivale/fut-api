<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayersClassification extends Model
{
    use HasFactory;

    protected $table = 'players_classifications';

    protected $fillable = [
        'player_id',
        'points',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
