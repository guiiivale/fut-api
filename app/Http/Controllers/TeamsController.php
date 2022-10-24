<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteTeamRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function getTeams()
    {
        $teams = Team::all();
        return response()->json($teams);
    }
    
    public function store(StoreTeamRequest $request)
    {
        $data = $request->validated();
        $team = Team::create($data);
        return response()->json($team);
    }

    public function update(UpdateTeamRequest $request)
    {
        $data = $request->validated();
        $team = Team::find($data['team_id']);
        if(!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Team not found'], 
                404);
        }
        $team->update($data);
        return response()->json($team);
    }
    
    public function destroy(DeleteTeamRequest $request)
    {
        $data = $request->validated();
        $team = Team::find($data['team_id']);
        if(!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Team not found'], 
                404);
        }
        $team->delete();
        return response()->json([
            'success' => true,
            'message' => 'Team deleted'], 
            200);
    }
}
