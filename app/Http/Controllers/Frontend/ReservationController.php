<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function makeReservation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'person' => 'required',
            'date' => 'required',
        ]);

        $reservation = new Reservation();

        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone = $request->phone;
        $reservation->person = $request->person;
        $reservation->date = $request->date;
        $reservation->message = $request->message;

        $reservation->save();

        return redirect()->back();
    }
}
