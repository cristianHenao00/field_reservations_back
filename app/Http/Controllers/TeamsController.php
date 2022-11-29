<?php

namespace App\Http\Controllers;

use App\Models\Team;
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
        $the_team = Team::create($request->all());
        return response($the_team, 201);
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
