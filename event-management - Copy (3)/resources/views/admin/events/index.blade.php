@extends('layouts.admin')

@section('title', 'Manage Events')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="fas fa-calendar-check me-2 text-danger"></i>Manage Events</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if ($events->isEmpty())
                <div class="alert alert-warning text-center mb-0">
                    <i class="fas fa-info-circle me-2"></i>No events found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Attendees</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th class="text-end">Approval</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($event->description, 50) }}</td>
                                    <td>{{ $event->date ? $event->date->format('M d, Y') : 'N/A' }}</td>
                                    
                                    <!-- New Attendees Column -->
                                    <td>{{ $event->attendees ?? '0' }}</td>

                                    <!-- Status: Running or Ended -->
                                    <td>
                                        @if ($event->date && $event->date->isFuture())
                                            <span class="badge bg-success">Running</span>
                                        @else
                                            <span class="badge bg-secondary">Ended</span>
                                        @endif
                                    </td>

                                    <td>{{ $event->creator->name ?? 'N/A' }}</td>

                                    <!-- Approval button -->
                                    <td class="text-end">
                                        @if (! $event->is_approved)
                                            <form action="{{ route('admin.events.approve', $event->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-sm btn-outline-success rounded-pill">
                                                    <i class="fas fa-check-circle me-1"></i>Approve
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-primary">Approved</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
