<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Exception;
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
        try {
            $data = $request->validate([
                'team_id' => 'required|integer',
                'field_id' => 'required|integer',
                'date' => 'required',
                'hour' => 'required',
                'experation' => 'required',
            ]);
            $the_reservation = Reservation::where([['field_id', $data['field_id']], ['date', $data['date']], ['hour', $data['hour']]])->first();
            if (is_null($the_reservation)) {
                $reservation_new = Reservation::create($data);
                return response()->json(['reservation' => $reservation_new], 201);
            }
            return response()->json(['message' => 'existing database reservation '], 404);
        } catch (Exception $e) {
            return response()->json(['data' => 'Data incomplete '], 400);
        }
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
