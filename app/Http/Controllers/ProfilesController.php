<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index()
    {
        return response()->json(Profile::all(), 200);
    }

    public function show($id)
    {
        $the_profile = Profile::find($id);
        if (is_null($the_profile)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            return response()->json($the_profile, 200);
        }
    }
    public function store(Request $request)
    {
        $url = '';
        // if (
        //     $request->file('image') && $request->file('image')->getClientOriginalExtension() == 'jpg' ||
        //     $request->file('image')->getClientOriginalExtension() == 'png'
        // ) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = $request->user_id . '-' . time() . '.' . $extension;
        //     $url = $file->move('avatars', $filename);
        // } else {
        //     return response(['menssage' => 'An image must be uploaded'], 400);
        // }
        $the_profile = Profile::where('user_id', '=', $request->user_id)->first();
        if (is_null($the_profile)) {
            $data = $request->all();
            $data['url_avatar'] = $url;
            $the_profile = Profile::create($data);
            $the_profile = Profile::find($the_profile->id);
            return response($the_profile, 201);
        } else {
            return response()->json(['message' => 'The user already has a profile'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $the_profile = Profile::find($id);
        $the_User = User::find($request->user_id);
        if (is_null($the_profile) && is_null($the_User)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_profile->update($request->all());
            return response()->json($the_profile::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_profile = Profile::find($id);
        if (is_null($the_profile)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_profile->delete();
            return response()->json(null, 204);
        }
    }
}
