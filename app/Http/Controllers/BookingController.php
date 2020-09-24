<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    public function book(Request $request)
    {
        $quantity = (int) $request->get('quantity', 1);

        if ($quantity < 1) {
            $quantity = 1;
        }

        Booking::create([
            'user_id' => Auth::user()->id,
            'scheduled_meal_id' => $request->get('scheduled_meal_id'),
            'quantity' => $quantity,
        ]);

        return Redirect::back();
    }

    public function unbook(Request $request)
    {
        Booking::where('id', $request->get('booking_id'))->delete();

        return Redirect::back();
    }

    public function setQuantity(Request $request)
    {
        if ($request->get('quantity') > 0) {
            Booking::where('id', $request->get('booking_id'))->update(['quantity' => $request->get('quantity')]);
        } else {
            return Redirect::route('unbook', ['booking_id' => $request->get('booking_id')]);
        }

        return Redirect::back();
    }
}
