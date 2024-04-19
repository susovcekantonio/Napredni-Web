@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Users</h2>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Change Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if ($user->role !== 'admin')
                    <form action="{{ route('admin.change_role', $user->id) }}" method="POST">
                        @csrf
                        <select name="role" onchange="this.form.submit()">
                            <option value="professor" {{ $user->role == 'professor' ? 'selected' : '' }}>Professor</option>
                            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                        </select>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection