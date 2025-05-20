@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Edit Event</h2>
        </div>
        
        <div class="card-body">
            <form action="{{ route('events.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Event Title</label>
                            <input name="title" class="form-control form-control-lg" 
                                   value="{{ old('title', $event->title) }}" required
                                   placeholder="Enter event title">
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="4" required
                                      placeholder="Describe the event details">{{ old('description', $event->description) }}</textarea>
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Event Date</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                <input type="date" name="date" class="form-control" 
                                       value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label fw-bold">Location</label>
                            <select name="location" class="form-select" id="locationSelect" required>
                                <option value="Limketkai Center" {{ old('location') == 'Limketkai Center' ? 'selected' : '' }}>Limketkai Center</option>
                                <option value="SM CDO Downtown Premier" {{ old('location') == 'SM CDO Downtown Premier' ? 'selected' : '' }}>SM CDO Downtown Premier</option>
                                <option value="Ayala Centrio Mall" {{ old('location') == 'Ayala Centrio Mall' ? 'selected' : '' }}>Ayala Centrio Mall</option>
                                <option value="Xavier University Gym" {{ old('location') == 'Xavier University Gym' ? 'selected' : '' }}>Xavier University Gym</option>
                                <option value="Capitol University Complex" {{ old('location') == 'Capitol University Complex' ? 'selected' : '' }}>Capitol University Complex</option>
                                <option value="Pueblo de Oro Convention Center" {{ old('location') == 'Pueblo de Oro Convention Center' ? 'selected' : '' }}>Pueblo de Oro Convention Center</option>
                                <option value="Other" {{ !in_array(old('location', $event->location), ['Barangay Hall', 'Municipal Gym']) ? 'selected' : '' }}>Other Location</option>
                            </select>
                        </div>

                        <!-- Other Location (Conditional) -->
                        <div class="mb-3" id="other-location-container" style="{{ in_array(old('location', $event->location), ['Barangay Hall', 'Municipal Gym']) ? 'display:none;' : '' }}">
                            <label for="other_location" class="form-label fw-bold">Specify Location</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                <input name="other_location" class="form-control" 
                                       value="{{ in_array(old('location', $event->location), ['Barangay Hall', 'Municipal Gym']) ? '' : old('location', $event->location) }}"
                                       placeholder="Enter venue address">
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label fw-bold">Event Category</label>
                            <select name="category" class="form-select" required>
                                <option value="Community" {{ old('category', $event->category) === 'Community' ? 'selected' : '' }}>Community</option>
                                <option value="Sports" {{ old('category', $event->category) === 'Sports' ? 'selected' : '' }}>Sports</option>
                                <option value="Education" {{ old('category', $event->category) === 'Education' ? 'selected' : '' }}>Education</option>
                                <option value="Health" {{ old('category', $event->category) === 'Health' ? 'selected' : '' }}>Health</option>
                                <option value="Other" {{ !in_array(old('category', $event->category), ['Community', 'Sports', 'Education', 'Health']) ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Staff Assignment -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Assign Staff Members</label>
                            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($staff as $s)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               name="staff_id[]" value="{{ $s->id }}"
                                               id="staff_{{ $s->id }}"
                                               {{ in_array($s->id, old('staff_id', $event->staff->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="staff_{{ $s->id }}">
                                            {{ $s->name }} <small class="text-muted">({{ $s->position }})</small>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Attendees -->
                        <div class="mb-3">
                            <label for="attendees" class="form-label fw-bold">Expected Attendees</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-people"></i></span>
                                <input type="number" name="attendees" class="form-control" 
                                       min="0" value="{{ old('attendees', $event->attendees) }}"
                                       placeholder="Estimated number of attendees">
                            </div>
                        </div>

                        <!-- Supplier -->
                        <div class="mb-4">
                            <label for="supplier_id" class="form-label fw-bold">Supplier</label>
                            <select name="supplier_id" class="form-select" required>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $event->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }} <small class="text-muted">({{ $supplier->service }})</small>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle"></i> Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const locationSelect = document.getElementById('locationSelect');
        const otherLocationInput = document.getElementById('other-location-container');

        locationSelect.addEventListener('change', function() {
            otherLocationInput.style.display = this.value === 'Other' ? 'block' : 'none';
            
            // Clear other location field when switching back to predefined locations
            if (this.value !== 'Other') {
                document.querySelector('[name="other_location"]').value = '';
            }
        });
    });
</script>

<style>
    .form-control, .form-select {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
    }
    .card {
        border-radius: 0.5rem;
    }
    .form-label {
        color: #495057;
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
</style>
@endsection