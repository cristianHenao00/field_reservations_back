<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function index()
    {
        return response()->json(Rating::all(), 200);
    }

    public function show($id)
    {
        $the_rating = Rating::find($id);
        if (is_null($the_rating)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_rating->field;
            $the_rating->users;
            return response()->json($the_rating, 200);
        }
    }
    public function store(Request $request)
    {
        $the_rating = Rating::create($request->all());
        return response($the_rating, 201);
    }

    public function update(Request $request, $id)
    {
        $the_rating = Rating::find($id);
        if (is_null($the_rating)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_rating->update($request->all());
            return response()->json($the_rating::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_rating = Rating::find($id);
        if (is_null($the_rating)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_rating->delete();
            return response()->json(null, 204);
        }
    }
}
