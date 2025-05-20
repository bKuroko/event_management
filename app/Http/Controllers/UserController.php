<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EventDetail;
use App\Models\Booking;
use App\Models\Staff;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // User registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard'); // Redirect to user dashboard
    }

    // User login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // User logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Display the user dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // For backward compatibility, keeping these variables
        $events = EventDetail::all();
        $bookings = Booking::where('user_id', $user->id)->get();
        
        // Get staff and suppliers for the event creation form
        $staffMembers = Staff::all();
        $suppliers = Supplier::all();
        
        return view('dashboard', compact('user', 'events', 'bookings', 'staffMembers', 'suppliers'));
    }

    /**
     * Register a user for an event.
     */
    public function registerEvent(Request $request, $eventId)
    {
        $user = Auth::user();

        // Check if already registered
        $existingBooking = Booking::where('user_id', $user->id)
            ->where('event_id', $eventId)
            ->first();
            
        if (!$existingBooking) {
            Booking::create([
                'user_id' => $user->id,
                'event_id' => $eventId,
                'status' => 'confirmed',
            ]);
            
            return redirect()->route('dashboard')->with('success', 'Successfully registered for the event!');
        }
        
        return redirect()->route('dashboard')->with('error', 'You are already registered for this event.');
    }
    
    // User dashboard display with bookings and events
    public function getDashboardDetails()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->with('event')->get();
        $events = EventDetail::all();

        return view('dashboard', compact('user', 'bookings', 'events'));
    }
}
