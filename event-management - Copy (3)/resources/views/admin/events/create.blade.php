    @extends('layouts.admin')

@section('content')
    <h1>Create Event</h1>

    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf
        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
            @error('title')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Description</label>
            <textarea name="description">{{ old('description') }}</textarea>
            @error('description')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Start Date</label>
            <input type="date" name="start_date" value="{{ old('start_date') }}" required>
            @error('start_date')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label>End Date</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}" required>
            @error('end_date')<div>{{ $message }}</div>@enderror
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
