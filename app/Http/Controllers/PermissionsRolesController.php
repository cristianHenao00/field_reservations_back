<?php

namespace App\Http\Controllers;

use App\Models\PermissionRole;
use Illuminate\Http\Request;

class PermissionsRolesController extends Controller
{
    public function index()
    {
        return response()->json(permissionRole::all(), 200);
    }

    public function show($id)
    {
        $the_permissionrole = permissionRole::find($id);
        if (is_null($the_permissionrole)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_permissionrole->roles; //Not sure about this
            $the_permissionrole->permissions;
            return response()->json($the_permissionrole, 200);
        }
    }
    public function store(Request $request)
    {
        $the_permissionrole = permissionRole::create($request->all());
        return response($the_permissionrole, 201);
    }

    public function update(Request $request, $id)
    {
        $the_permissionrole = PermissionRole::find($id);
        if (is_null($the_permissionrole)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_permissionrole->update($request->all());
            return response()->json($the_permissionrole::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_permissionrole = PermissionRole::find($id);
        if (is_null($the_permissionrole)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_permissionrole->delete();
            return response()->json(null, 204);
        }
    }
}
