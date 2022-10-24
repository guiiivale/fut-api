<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCardsRequest;
use App\Http\Requests\StoreCardRequest;
use App\Models\Matches;
use App\Models\Player;
use App\Models\PlayersMatchCards;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function getCards(GetCardsRequest $request)
    {
        $data = $request->validated();
        $cards = PlayersMatchCards::where('match_id', $data['match_id'])->get();
        if(!$cards){
            return response()->json([
                'success' => false,
                'message' => 'Cards not found'], 
                404);
        }
        return response()->json($cards);
    }

    public function store(StoreCardRequest $request)
    {
        $data = $request->validated();
        $match = Matches::find($data['match_id']);
        $player = Player::find($data['player_id']);
        if(!$match) {
            return response()->json([
                'success' => false,
                'message' => 'Match not found'], 
                404);
        }
        if(!$player) {
            return response()->json([
                'success' => false,
                'message' => 'Player not found'], 
                404);
        }
        if($match->team1->id != $player->team->id && $match->team2->id != $player->team->id) {
            return response()->json([
                'success' => false,
                'message' => 'Player not in match'], 
                404);
        }
        $card = PlayersMatchCards::where('match_id', $data['match_id'])->where('player_id', $data['player_id'])->first();
        if($card) {
            return response()->json([
                'success' => false,
                'message' => 'Match player cards already exists, must be updated'], 
                404);
        }
        $card = new PlayersMatchCards();
        $card->match()->associate($match);
        $card->player()->associate($player);
        $card->yellow_cards = $data['yellow_cards'] ?? 0;
        $card->red_cards = $data['red_cards'] ?? 0;
        $card->save();
        return response()->json($card);
    }
}
