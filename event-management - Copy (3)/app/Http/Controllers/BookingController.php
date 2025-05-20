<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\EventDetail;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Show booking form
    public function create($eventId)
    {
        $event = EventDetail::findOrFail($eventId);
        return view('bookings.create', compact('event'));
    }

    // Store booking
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'booking_date' => 'required|date',
            'status' => 'required|in:confirmed,pending,cancelled',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'event_id' => $eventId,
            'booking_date' => $request->booking_date,
            'status' => $request->status,
        ]);

        return redirect()->route('events.index');
    }

    // View user bookings
    public function myBookings()
    {
        $bookings = Booking::where('user_id', auth()->id())->get();
        return view('bookings.index', compact('bookings'));
    }
}

{
    //
}
