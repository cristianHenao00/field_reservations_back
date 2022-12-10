<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        return response()->json(Role::all(), 200);
    }

    public function show($id)
    {
        $the_role = Role::find($id);
        if (is_null($the_role)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_role->users;
            $the_role->permissions;
            return response()->json($the_role, 200);
        }
    }
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
            ]);
            $the_role = Role::where('name', $data['name'])->first();
            if (is_null($the_role)) {
                $the_role = Role::create($data);
                return response()->json(['role' => $the_role], 201);
            } else {
                return response()->json(['message' => 'existing database role '], 404);
            }
        } catch (Exception $e) {
            return response()->json(['data' => 'Data incomplete '], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $the_role = Role::find($id);
        if (is_null($the_role)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_role->update($request->all());
            return response()->json($the_role::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_role = Role::find($id);
        if (is_null($the_role)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_role->delete();
            return response()->json(null, 204);
        }
    }
}
