<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index()
    {
        return response()->json(Permission::all(), 200);
    }

    public function show($id)
    {
        $the_permission = Permission::find($id);
        if (is_null($the_permission)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_permission->roles;
            return response()->json($the_permission, 200);
        }
    }
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'url' => 'required|string',
                'method' => 'required|string',
            ]);
            $the_permission = Permission::where([['url', $data['url']], ['method', $data['method']]])->first();
            if (is_null($the_permission)) {
                $the_permission = Permission::create($data);
                return response()->json(['permission' => $the_permission], 201);
            }
            return response()->json(['message' => 'existing database permission '], 404);
        } catch (Exception $e) {
            return response()->json(['data' => 'Data incomplete '], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $the_permission = Permission::find($id);
        if (is_null($the_permission)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_permission->update($request->all());
            return response()->json($the_permission::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_permission = Permission::find($id);
        if (is_null($the_permission)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_permission->delete();
            return response()->json(null, 204);
        }
    }
}
