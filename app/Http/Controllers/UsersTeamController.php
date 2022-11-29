<?php

namespace App\Http\Controllers;

use App\Models\UsersTeam;
use Illuminate\Http\Request;

class UsersTeamController extends Controller
{
    public function index()
    {
        return response()->json(UsersTeam::all(), 200);
    }

    public function show($id)
    {
        $the_usersTeam = UsersTeam::find($id);
        if (is_null($the_usersTeam)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            return response()->json($the_usersTeam::find($id), 200);
        }
    }
    public function store(Request $request)
    {
        $the_usersTeam = UsersTeam::create($request->all());
        return response($the_usersTeam, 201);
    }

    public function update(Request $request, $id)
    {
        $the_usersTeam = UsersTeam::find($id);
        if (is_null($the_usersTeam)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_usersTeam->update($request->all());
            return response()->json($the_usersTeam::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_usersTeam = UsersTeam::find($id);
        if (is_null($the_usersTeam)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_usersTeam->delete();
            return response()->json(null, 204);
        }
    }
}
