<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();

        return view('backend.reservation.index', compact('reservations'));
    }

    public function statusChange($id)
    {
        $reservations = Reservation::findOrfail($id);
        $reservations->status = true;

        $reservations->save();

        return redirect()->back()->with('success', 'Category Deleted Successfully');;

    }
}
