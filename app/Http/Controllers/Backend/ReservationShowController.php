<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;


class ReservationShowController extends Controller
{
    public function Show()
    {
        return view('backend.reservation.index',[
            'reservations'   => Reservation::latest('id')->get()
        ]);
    }

    public function Status($id)
    {
        $reservation =  Reservation::find($id);
        $reservation->Status = true;
        $reservation->save();

        notify()->success('Reservation Confirmed', "Success");
        return redirect()->back();
    }

    public function Destroy($id)
    {
        $reservation =  Reservation::find($id);
        $reservation->delete();

        notify()->success('Reservation Deleted', "Success");
        return redirect()->back();
    }
}
