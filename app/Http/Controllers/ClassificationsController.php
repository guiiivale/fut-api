<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayersClassificationRequest;
use App\Http\Requests\TeamsClassificationRequest;
use App\Models\Classification;
use App\Models\PlayersClassification;
use Illuminate\Http\Request;

class ClassificationsController extends Controller
{
    public function getTeamsClassification(TeamsClassificationRequest $request)
    {
        $data = $request->validated();
        if($data['team_id']){
            $classification = Classification::where('team_id', $data['team_id'])->first();
            if(!$classification){
                return response()->json([
                    'success' => false,
                    'message' => 'Team not found'], 
                    404);
            }
            return response()->json($classification);
        }
        $order = $data['order'];
        if($order != 'asc' && $order != 'desc') {
            return response()->json([
                'success' => false,
                'message' => 'Order must be asc or desc'], 
                404);
        }
        $classifications = Classification::orderBy('goals_scored', $order)->get();
        $dataClassification = [];
        foreach($classifications as $key => $classification) {
            $dataClassification[] = [
                'position' => $key + 1,
                'team' => $classification->team->name,
                'goals_scored' => $classification->goals_scored,
            ];
        }
        return response()->json($dataClassification);
    }

    public function getPlayersClassification(PlayersClassificationRequest $request)
    {
        $data = $request->validated();
        if($data['player_id'])
        {
            $player = PlayersClassification::where('player_id', $data['player_id'])->first();
            if(!$player) {
                return response()->json([
                    'success' => false,
                    'message' => 'Player not found'], 
                    404);
            }
            return response()->json($player);
        }
        $order = $data['order'];
        if($order != 'asc' && $order != 'desc') {
            return response()->json([
                'success' => false,
                'message' => 'Order must be asc or desc'], 
                404);
        }
        $classifications = PlayersClassification::orderBy('points', $order)->get();
        $dataClassification = [];
        foreach($classifications as $key => $classification) {
            $dataClassification[] = [
                'position' => $key + 1,
                'player' => $classification->player->name,
                'points' => $classification->points,
            ];
        }
        return response()->json($dataClassification);
    }
}
