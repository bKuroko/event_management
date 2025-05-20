@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Welcome Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Welcome back, {{ $user->name }}</h2>
            <p class="text-muted mb-0">Here's an overview of your events</p>
        </div>
        <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createEventModal">
            <i class="fas fa-plus me-2"></i> Create Event
        </button>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Events Section -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
        <div class="card-header bg-white py-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-day text-primary me-2"></i>Your Events
                </h5>
                
            </div>
        </div>
        
        <div class="card-body p-4">
            @php
                $myEvents = \App\Models\EventDetail::where('created_by', auth()->id())
                    ->with(['staff', 'supplier'])
                    ->get();
            @endphp

            @if($myEvents->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-calendar-plus fa-4x text-muted opacity-25"></i>
                    </div>
                    <h5 class="text-muted mb-3">No events created yet</h5>
                    <p class="text-muted mb-4">Get started by creating your first event</p>
                    <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createEventModal">
                        <i class="fas fa-plus me-2"></i> Create Event
                    </button>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($myEvents as $event)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                <div class="card-body position-relative">
                                    <!-- Status Badge -->
                                    <div class="position-absolute top-0 end-0 mt-3 me-3">
                                        @if ($event->is_approved)
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">
                                                <i class="fas fa-check-circle me-1"></i> Approved
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">
                                                <i class="fas fa-clock me-1"></i> Pending
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Event Date -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                            <i class="fas fa-calendar-alt fa-lg"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">DATE</small>
                                            <strong>{{ $event->date ? \Carbon\Carbon::parse($event->date)->format('M d, Y') : 'N/A' }}</strong>
                                        </div>
                                    </div>
                                    
                                    <!-- Event Title & Category -->
                                    <h5 class="card-title mb-2">{{ $event->title }}</h5>
                                    <span class="badge bg-primary bg-opacity-10 text-primary mb-3">{{ $event->category }}</span>
                                    
                                    <!-- Location -->
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                        <small class="text-truncate">{{ $event->location }}</small>
                                    </div>
                                    
                                    <!-- Attendees -->
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-users text-muted me-2"></i>
                                        <small>{{ $event->attendees ?? '0' }} attendees</small>
                                    </div>
                                    
                                    <!-- View Details Button -->
                                    <button type="button" class="btn btn-outline-primary w-100 rounded-pill mt-auto"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewEventModal"
                                        data-event-id="{{ $event->id }}"
                                        data-event-title="{{ $event->title }}"
                                        data-event-description="{{ $event->description }}"
                                        data-event-date="{{ $event->date }}"
                                        data-event-location="{{ $event->location }}"
                                        data-event-category="{{ $event->category }}"
                                        data-event-status="{{ $event->is_approved }}"
                                        data-event-staff="{{ $event->staff->pluck('name')->join(', ') }}"
                                        data-event-supplier="{{ $event->supplier->name ?? 'N/A' }}"
                                        data-event-attendees="{{ is_array($event->attendees) ? implode(',', $event->attendees) : $event->attendees }}">
                                        <i class="fas fa-eye me-2"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Create Event Modal -->
<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="createEventModalLabel">
                    <i class="fas fa-plus-circle text-primary me-2"></i>Create New Event
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-heading text-muted"></i></span>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Event title" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light align-items-start pt-2"><i class="fas fa-align-left text-muted"></i></span>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe your event" required>{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-calendar-day text-muted"></i></span>
                                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select category</option>
                                <option value="Business" {{ old('category') == 'Business' ? 'selected' : '' }}>Business</option>
                                <option value="Social" {{ old('category') == 'Social' ? 'selected' : '' }}>Social</option>
                                <option value="Education" {{ old('category') == 'Education' ? 'selected' : '' }}>Education</option>
                                <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                <option value="Sports" {{ old('category') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-muted"></i></span>
                            <select class="form-select" id="location" name="location" required>
                                <option value="" disabled {{ old('location') ? '' : 'selected' }}>Select a location</option>
                                <option value="Limketkai Center" {{ old('location') == 'Limketkai Center' ? 'selected' : '' }}>Limketkai Center</option>
                                <option value="SM CDO Downtown Premier" {{ old('location') == 'SM CDO Downtown Premier' ? 'selected' : '' }}>SM CDO Downtown Premier</option>
                                <option value="Ayala Centrio Mall" {{ old('location') == 'Ayala Centrio Mall' ? 'selected' : '' }}>Ayala Centrio Mall</option>
                                <option value="Xavier University Gym" {{ old('location') == 'Xavier University Gym' ? 'selected' : '' }}>Xavier University Gym</option>
                                <option value="Capitol University Complex" {{ old('location') == 'Capitol University Complex' ? 'selected' : '' }}>Capitol University Complex</option>
                                <option value="Pueblo de Oro Convention Center" {{ old('location') == 'Pueblo de Oro Convention Center' ? 'selected' : '' }}>Pueblo de Oro Convention Center</option>
                                <option value="Other" {{ old('location') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="mb-3" id="otherLocationDiv" style="{{ old('location') == 'Other' ? '' : 'display: none;' }}">
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-map-pin text-muted"></i></span>
                                <input type="text" class="form-control" id="otherLocation" name="other_location" value="{{ old('other_location') }}" placeholder="Specify location" {{ old('location') == 'Other' ? 'required' : '' }}>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Staff <span class="text-danger">*</span></label>
                        <div class="border rounded-3 p-3 bg-light" style="max-height: 200px; overflow-y: auto;">
                            @foreach($staffMembers as $staff)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" 
                                        name="staff_id[]" id="staff_{{ $staff->id }}" 
                                        value="{{ $staff->id }}" 
                                        {{ is_array(old('staff_id')) && in_array($staff->id, old('staff_id')) ? 'checked' : '' }}>
                                    <label class="form-check-label d-flex align-items-center" for="staff_{{ $staff->id }}">
                                        <span class="avatar-xs me-2">
                                            <span class="avatar-title bg-primary bg-opacity-10 text-primary rounded-circle">
                                                {{ substr($staff->name, 0, 1) }}
                                            </span>
                                        </span>
                                        <div>
                                            <div>{{ $staff->name }}</div>
                                            <small class="text-muted">{{ $staff->role }}</small>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Select staff to assign to this event</small>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="supplier_id" class="form-label">Supplier <span class="text-danger">*</span></label>
                            <select class="form-select" id="supplier_id" name="supplier_id" required>
                                <option value="" selected disabled>Select a supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="attendees" class="form-label">Attendees <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-users text-muted"></i></span>
                                <input type="number" class="form-control" id="attendees" name="attendees" value="{{ old('attendees') }}" min="0" placeholder="Expected attendees" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary rounded-pill py-2">
                            <i class="fas fa-save me-2"></i> Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Event Modal -->
<div class="modal fade" id="viewEventModal" tabindex="-1" aria-labelledby="viewEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="viewEventModalLabel">
                    <i class="fas fa-calendar-check text-primary me-2"></i>Event Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h3 id="eventTitle" class="mb-1"></h3>
                        <span class="badge bg-primary bg-opacity-10 text-primary" id="eventCategory"></span>
                    </div>
                    <span id="eventStatus" class="badge"></span>
                </div>

                <p id="eventDescription" class="text-muted mb-4"></p>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light h-100">
                            <div class="card-body">
                                <h6 class="card-title text-muted mb-3">
                                    <i class="fas fa-info-circle me-2"></i>Event Information
                                </h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <i class="fas fa-calendar-day text-primary me-2"></i>
                                        <strong>Date:</strong> <span id="eventDate"></span>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <strong>Location:</strong> <span id="eventLocation"></span>
                                    </li>
                                    <li>
                                        <i class="fas fa-users text-primary me-2"></i>
                                        <strong>Attendees:</strong> <span id="eventAttendeesCount"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-0 bg-light h-100">
                            <div class="card-body">
                                <h6 class="card-title text-muted mb-3">
                                    <i class="fas fa-users-cog me-2"></i>Team & Suppliers
                                </h6>
                                <div class="mb-3">
                                    <strong class="d-block mb-1">Staff Assigned:</strong>
                                    <div id="eventStaffList" class="d-flex flex-wrap gap-2"></div>
                                </div>
                                <div>
                                    <strong class="d-block mb-1">Supplier:</strong>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1" id="eventSupplier"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <a href="#" id="editEventBtn" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <button type="button" class="btn btn-outline-danger rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#deleteEventModal" data-bs-dismiss="modal">
                    <i class="fas fa-trash-alt me-2"></i>Delete
                </button>
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" id="deleteEventForm">
            @csrf
            @method('DELETE')
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="deleteEventModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-4">
                        <i class="fas fa-trash-alt fa-3x text-danger opacity-25"></i>
                    </div>
                    <h5 class="mb-3">Are you sure?</h5>
                    <p class="text-muted">This action cannot be undone. The event will be permanently deleted.</p>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                        <i class="fas fa-trash-alt me-2"></i>Yes, Delete
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const locationSelect = document.getElementById('location');
        const otherDiv = document.getElementById('otherLocationDiv');
        const otherInput = document.getElementById('otherLocation');

        function toggleOtherLocation(value) {
            if (value === 'Other') {
                otherDiv.style.display = 'block';
                otherInput.setAttribute('required', 'required');
            } else {
                otherDiv.style.display = 'none';
                otherInput.removeAttribute('required');
            }
        }

        toggleOtherLocation(locationSelect.value);

        locationSelect.addEventListener('change', function () {
            toggleOtherLocation(this.value);
        });
    });

    const viewModal = document.getElementById('viewEventModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        // Basic Event Info
        document.getElementById('eventTitle').textContent = button.getAttribute('data-event-title');
        document.getElementById('eventCategory').textContent = button.getAttribute('data-event-category');
        document.getElementById('eventDescription').textContent = button.getAttribute('data-event-description');
        document.getElementById('eventDate').textContent = button.getAttribute('data-event-date') ? 
            new Date(button.getAttribute('data-event-date')).toLocaleDateString('en-US', { 
                year: 'numeric', month: 'short', day: 'numeric' 
            }) : 'N/A';
        document.getElementById('eventLocation').textContent = button.getAttribute('data-event-location');
        document.getElementById('eventSupplier').textContent = button.getAttribute('data-event-supplier');

        // Status badge
        const statusRaw = button.getAttribute('data-event-status');
        const statusBadge = document.getElementById('eventStatus');
        const isApproved = statusRaw === '1' || statusRaw === 'true';
        statusBadge.textContent = isApproved ? 'Approved' : 'Pending';
        statusBadge.className = 'badge ' + (isApproved ? 'bg-success bg-opacity-10 text-success rounded-pill px-3' : 'bg-warning bg-opacity-10 text-warning rounded-pill px-3');

        // Attendees
        const attendeesRaw = button.getAttribute('data-event-attendees');
        document.getElementById('eventAttendeesCount').textContent = attendeesRaw || '0';

        // Staff
        const staffRaw = button.getAttribute('data-event-staff');
        const staffList = staffRaw ? staffRaw.split(',') : [];
        const staffContainer = document.getElementById('eventStaffList');
        staffContainer.innerHTML = '';
        staffList.forEach(name => {
            if (name.trim()) {
                const badge = document.createElement('span');
                badge.className = 'badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1';
                badge.innerHTML = `<i class="fas fa-user me-1"></i> ${name.trim()}`;
                staffContainer.appendChild(badge);
            }
        });

        // Edit/Delete
        const eventId = button.getAttribute('data-event-id');
        document.getElementById('editEventBtn').setAttribute('href', `/events/${eventId}/edit`);
        document.getElementById('deleteEventForm').setAttribute('action', `/events/${eventId}`);
    });
</script>
@endsection