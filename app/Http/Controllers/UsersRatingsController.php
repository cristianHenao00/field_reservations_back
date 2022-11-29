<?php

namespace App\Http\Controllers;

use App\Models\UsersRating;
use Illuminate\Http\Request;

class UsersRatingsController extends Controller
{
    public function index()
    {
        return response()->json(UsersRating::all(), 200);
    }

    public function show($id)
    {
        $the_usersRating = UsersRating::find($id);
        if (is_null($the_usersRating)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            return response()->json($the_usersRating::find($id), 200);
        }
    }
    public function store(Request $request)
    {
        $the_usersRating = UsersRating::create($request->all());
        return response($the_usersRating, 201);
    }

    public function update(Request $request, $id)
    {
        $the_usersRating = UsersRating::find($id);
        if (is_null($the_usersRating)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_usersRating->update($request->all());
            return response()->json($the_usersRating::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_usersRating = UsersRating::find($id);
        if (is_null($the_usersRating)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_usersRating->delete();
            return response()->json(null, 204);
        }
    }
}
