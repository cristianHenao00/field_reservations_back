<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    public function index()
    {
        return response()->json(Field::all(), 200);
    }

    public function show($id)
    {
        $the_field = Field::find($id);
        if (is_null($the_field)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_field->teams;
            $the_field->ratings;
            return response()->json($the_field, 200);
        }
    }
    public function store(Request $request)
    {
        $the_field = Field::create($request->all());
        return response($the_field, 201);
    }

    public function update(Request $request, $id)
    {
        $the_field = Field::find($id);
        if (is_null($the_field)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_field->update($request->all());
            return response()->json($the_field::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_field = Field::find($id);
        if (is_null($the_field)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_field->delete();
            return response()->json(null, 204);
        }
    }
}
