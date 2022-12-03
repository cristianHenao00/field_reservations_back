<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Exception;
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
        try {
            $data = $request->validate([
                'field_type' => 'required|string',
                'field_characteristic' => 'required|string',
                'field_location' => 'required|string'
            ]);
            $the_field = Field::where(['field_type', $data['field_type']], ['field_location', $data['field_location']])->first();
            if (is_null($the_field)) {
                $the_field = Field::create($data);
                return response()->json(['field' => $the_field], 201);
            }
            return response()->json(['message' => 'existing database field '], 404);
        } catch (Exception $e) {
            return response(['data' => 'Data incomplete '], 400);
        }

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
