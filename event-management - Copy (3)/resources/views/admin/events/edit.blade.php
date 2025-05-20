@extends('layouts.app')

@section('content')
    <h1>Edit Event</h1>

    <form action="{{ route('admin.events.update', $event) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" required>
            @error('title')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Description</label>
            <textarea name="description">{{ old('description', $event->description) }}</textarea>
            @error('description')<div>{{ $message }}</div>@enderror
        </div>

        <input type="date" name="date" 
    value="{{ old('date', $event->date ? \Carbon\Carbon::parse($event->date)->format('Y-m-d') : '') }}" 
    required>

        {{-- Display Created At --}}
        <div>
            <label>Created At</label>
            <input type="text" disabled 
                value="{{ $event->created_at ? $event->created_at->format('Y-m-d H:i:s') : 'N/A' }}">
        </div>

        {{-- Display Created By (assuming relation 'creator') --}}
        <div>
            <label>Created By</label>
            <input type="text" disabled 
                value="{{ $event->creator ? $event->creator->name : 'Unknown' }}">
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
