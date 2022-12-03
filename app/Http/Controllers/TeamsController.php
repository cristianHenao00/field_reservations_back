<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index()
    {
        return response()->json(Team::all(), 200);
    }

    public function show($id)
    {
        $the_team = Team::find($id);
        if (is_null($the_team)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_team->users;
            $the_team->fields;
            return response()->json($the_team, 200);
        }
    }
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'number_players' => 'required|integer',
                'public' => 'required|boolean',
                'limit' => 'required|integer'
            ]);
            $the_team = Team::where('name', $data['name'])->first();
            if (is_null($the_team)) {
                $team_new = Team::create($data);
                return response(['team' => $team_new], 201);
            }
            return response()->json(['message' => 'existing database team '], 404);
        } catch (Exception $e) {
            return response()->json(['data' => 'Data incomplete '], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $the_team = Team::find($id);
        if (is_null($the_team)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_team->update($request->all());
            return response()->json($the_team::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_team = Team::find($id);
        if (is_null($the_team)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_team->delete();
            return response()->json(null, 204);
        }
    }
}
