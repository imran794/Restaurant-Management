<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\carbon;


class ReservationController extends Controller
{
    public function store(Request $request)
    {
         $request->validate([
            'name'               => 'required',
            'phone'              => 'required',
            'email'              => 'required',
            'date_and_time'      => 'required',
        ]);

        Reservation::create([
            'name'            => $request->name,
            'phone'           => $request->phone,
            'email'           => $request->email,
            'date_and_time'   => $request->date_and_time,
            'message'         => $request->message,
            'status'          => false,
            'created_at'      => carbon::now(),
        ]);

        notify()->success('Reservation Request Send Succussfully. We Will Confirm to you Shortly', "Added");
        return redirect()->back();
    }
}
