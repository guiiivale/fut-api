<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteMatchRequest;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use App\Models\Matches;
use App\Models\Team;
use Illuminate\Http\Request;

class MatchesController extends Controller
{

    public function getMatches()
    {
        $matches = Matches::all();
        return response()->json($matches);
    }

    public function store(StoreMatchRequest $request)
    {
        $data = $request->validated();
        $match = new Matches();

        $team1 = Team::find($data['team1_id']);
        $team2 = Team::find($data['team2_id']);
        if(!$team1 || !$team2) {
            return response()->json([
                'success' => false,
                'message' => 'Team not found'], 
                404);
        }

        $match->team1()->associate($team1);
        $match->team2()->associate($team2);
        $match->team1_score = $data['team1_score'];
        $match->team2_score = $data['team2_score'];
        $match->date = $data['date'];
        $match->start_time = $data['start_time'];
        $match->end_time = $data['end_time'];
        $match->save();
        return response()->json($match);
    }

    public function update(UpdateMatchRequest $request)
    {
        $data = $request->validated();
        $match = Matches::find($data['match_id']);
        if(!$match) {
            return response()->json([
                'success' => false,
                'message' => 'Match not found'], 
                404);
        }
        if(isset($data['team1_id'])) {
            $team1 = Team::find($data['team1_id']);
            if(!$team1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Team 1 not found'], 
                    404);
            }
            $match->team1()->associate($team1);
        }
        if(isset($data['team2_id'])) {
            $team2 = Team::find($data['team2_id']);
            if(!$team2) {
                return response()->json([
                    'success' => false,
                    'message' => 'Team 2 not found'], 
                    404);
            }
            $match->team2()->associate($team2);
        }
        $match->update($data);
        return response()->json($match);
    }

}
