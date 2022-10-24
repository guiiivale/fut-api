<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayersMatchCards extends Model
{
    use HasFactory;

    protected $table = 'players_match_cards';

    protected $fillable = [
        'player_id',
        'yellow_cards',
        'red_cards',
        'match_id'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function match()
    {
        return $this->belongsTo(Matches::class);
    }
}
