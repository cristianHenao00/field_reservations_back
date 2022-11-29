<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index()
    {
        return response()->json(Reservation::all(), 200);
    }

    public function show($id)
    {
        $the_reservation = Reservation::find($id);
        if (is_null($the_reservation)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            return response()->json($the_reservation::find($id), 200);
        }
    }
    public function store(Request $request)
    {
        $the_reservation = Reservation::create($request->all());
        return response($the_reservation, 201);
    }

    public function update(Request $request, $id)
    {
        $the_reservation = Reservation::find($id);
        if (is_null($the_reservation)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_reservation->update($request->all());
            return response()->json($the_reservation::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_reservation = Reservation::find($id);
        if (is_null($the_reservation)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_reservation->delete();
            return response()->json(null, 204);
        }
    }
}
