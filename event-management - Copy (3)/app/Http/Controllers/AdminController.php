<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EventDetail;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show admin dashboard
    public function index()
    {
        $events = EventDetail::all();
        $users = User::all();
        $bookings = Booking::all();
        return view('admin.dashboard', compact('events', 'users', 'bookings'));
    }

    // Manage events
    public function manageEvents()
    {
        $events = EventDetail::paginate(10);
        return view('admin.events.index', compact('events'));
    }

    // Create event
    public function createEvent()
    {
        return view('admin.events.create');
    }

    // Store new event
    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        EventDetail::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'category' => $request->category,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.manageEvents')->with('success', 'Event created successfully!');
    }

    // Edit event
    public function editEvent($id)
    {
        $event = EventDetail::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    // Update event
    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        $event = EventDetail::findOrFail($id);
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.manageEvents')->with('success', 'Event updated successfully!');
    }

    // Delete event
    public function deleteEvent($id)
    {
        EventDetail::destroy($id);
        return redirect()->route('admin.manageEvents')->with('success', 'Event deleted successfully!');
    }

    // Manage bookings
    public function manageBookings()
    {
        $bookings = Booking::all();
        return view('admin.bookings.index', compact('bookings'));
    }

    // Delete booking
    public function deleteBooking($id)
    {
        Booking::destroy($id);
        return redirect()->route('admin.manageBookings')->with('success', 'Booking deleted successfully!');
    }

    // Approve event
    public function approveEvent($id)
    {
        $event = EventDetail::findOrFail($id);
        $event->is_approved = true; // assumes a column named 'is_approved'
        $event->save();

        return redirect()->route('admin.manageEvents')->with('success', 'Event approved successfully!');
    }

    // ✅ Correctly placed inside the controller:
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function toggleUserStatus($id)
{
    $user = User::findOrFail($id);
    $user->status = $user->status === 'blocked' ? 'active' : 'blocked';
    $user->save();

    return redirect()->route('admin.manageUsers')->with('success', 'User status updated.');
}

}
