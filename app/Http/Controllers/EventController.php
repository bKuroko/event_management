<?php

namespace App\Http\Controllers;

use App\Models\EventDetail;
use App\Models\Staff;
use App\Models\Supplier;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = EventDetail::where('created_by', auth()->id())->paginate(10);
        return view('events.index', compact('events'));
    }

    public function show($id)
    {
        $event = EventDetail::findOrFail($id);
        $this->authorizeUser($event);

        return view('events.show', compact('event'));
    }

    public function create()
    {
        $staff = Staff::all();
        $suppliers = Supplier::all();
        return view('events.create', compact('staff', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateEvent($request);

        // Prevent duplicate event for same user on same date
        $existingEvent = EventDetail::where('created_by', auth()->id())
            ->where('date', $validated['date'])
            ->first();

        if ($existingEvent) {
            return redirect()->back()->withInput()->withErrors([
                'date' => 'You already have an event scheduled on this date.',
            ]);
        }

        $location = $this->resolveLocation($validated);

        $event = EventDetail::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'location' => $location,
            'category' => $validated['category'],
            'supplier_id' => $validated['supplier_id'],
            'created_by' => auth()->id(),
            'status' => 'pending',
            'attendees' => isset($validated['attendees']) ? (int) $validated['attendees'] : 0,

        ]);

        $event->staff()->sync($validated['staff_id']);

        return redirect()->route('dashboard')->with('success', 'Event created successfully and is now pending approval!');
    }

    public function edit($id)
    {
        $event = EventDetail::findOrFail($id);
        $this->authorizeUser($event);

        $staff = Staff::all();
        $suppliers = Supplier::all();

        return view('events.edit', compact('event', 'staff', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $event = EventDetail::findOrFail($id);
        $this->authorizeUser($event);

        $validated = $this->validateEvent($request);
        $location = $this->resolveLocation($validated);

        $event->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'location' => $location,
            'category' => $validated['category'],
            'supplier_id' => $validated['supplier_id'],
            'attendees' => isset($validated['attendees']) ? (int) $validated['attendees'] : 0,

        ]);

        $event->staff()->sync($validated['staff_id']);

        return redirect()->route('dashboard')->with('success', 'Event updated successfully!');
    }

    public function destroy($id)
    {
        $event = EventDetail::findOrFail($id);
        $this->authorizeUser($event);

        $event->delete();

        return redirect()->route('dashboard')->with('success', 'Event deleted successfully!');
    }

    // ========== Helper Methods ==========

    private function validateEvent(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'other_location' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'staff_id' => 'required|array',
            'staff_id.*' => 'exists:staff,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'attendees' => 'nullable|integer|min:0',
        ]);
    }

    private function resolveLocation(array $data): string
    {
        return ($data['location'] === 'Other' && !empty($data['other_location']))
            ? $data['other_location']
            : $data['location'];
    }

    private function authorizeUser(EventDetail $event): void
    {
        if ($event->created_by !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
