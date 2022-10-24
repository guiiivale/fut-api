<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'team1_id',
        'team2_id',
        'team1_score',
        'team2_score',
        'date',
        'classification_id',
        'start_time',
        'end_time',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function playersCards()
    {
        return $this->hasMany(PlayersMatchCards::class);
    }
}
