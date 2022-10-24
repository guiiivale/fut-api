<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeletePlayerRequest;
use App\Http\Requests\PlayerRequest;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use App\Models\PlayersClassification;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    public function getPlayers(PlayerRequest $request)
    {
        $data = $request->validated();
        if(isset($data['cpf'])){
            $player = Player::where('cpf', $data['cpf'])->first();
            if(!$player){
                return response()->json([
                    'success' => false,
                    'message' => 'Player not found'], 
                    404);
            }
            return response()->json($player);
        }
        $players = Player::all();
        return response()->json($players);
    }

    public function store(StorePlayerRequest $request)
    {
        $data = $request->validated();
        $team = Team::find($data['team_id']);
        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Team not found'
            ]);
        }
        if($team->players()->count() == 5 )
        {
            return response()->json([
                'success' => false,
                'message' => 'Team already has 5 players'
            ]);
        }
        $IsNumberAlreadyTaken = Player::where('number', $data['number'])->where('team_id', $data['team_id'])->first();
        if($IsNumberAlreadyTaken)
        {
            return response()->json([
                'success' => false,
                'message' => 'Number already taken'
            ]);
        }
        $player = new Player();
        $player->name = $data['name'];
        $player->cpf = $data['cpf'];
        $player->number = $data['number'];
        $player->team()->associate($team);
        $player->save();
        $classification = new PlayersClassification();
        $classification->player()->associate($player);
        $classification->save();
        return response()->json($player);
    }

    public function update(UpdatePlayerRequest $request)
    {
        $data = $request->validated();
        $player = Player::find($data['player_id']);
        if (!$player) {
            return response()->json([
                'success' => false,
                'message' => 'Player not found'
            ]);
        }
        if (isset($data['name'])) {
            $player->name = $data['name'];
        }
        if (isset($data['cpf'])) {
            $player->cpf = $data['cpf'];
        }
        if (isset($data['number'])) {
            $IsNumberAlreadyTaken = Player::where('number', $data['number'])->where('team_id', $player->team_id)->first();
            if($IsNumberAlreadyTaken)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Number already taken'
                ]);
            }
            $player->number = $data['number'];
        }
        $player->save();
        return response()->json($player);
    }

    public function destroy(DeletePlayerRequest $request)
    {
        $data = $request->validated();
        $player = Player::find($data['player_id']);
        if (!$player) {
            return response()->json([
                'success' => false,
                'message' => 'Player not found'
            ]);
        }
        $player->delete();
        return response()->json([
            'success' => true,
            'message' => 'Player deleted'
        ]);
    }
}
