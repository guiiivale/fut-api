<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
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
}
