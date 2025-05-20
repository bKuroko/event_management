@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold">Manage Users</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge 
                                @if($user->role === 'admin') bg-primary 
                                @elseif($user->role === 'organizer') bg-success 
                                @else bg-secondary 
                                @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $user->status === 'blocked' ? 'bg-danger' : 'bg-success' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.toggleUserStatus', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-{{ $user->status === 'blocked' ? 'success' : 'danger' }}">
                                    <i class="fas fa-ban"></i>
                                    {{ $user->status === 'blocked' ? 'Unblock' : 'Block' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
