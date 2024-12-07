@extends('layout')
@section('content')
<div class="admin-container">
    <div class="adm-button-container" style="text-align: center; margin-bottom: 60px; margin-top: 60px">
        <a href="{{ route('admin.users') }}" class="adm-button">Users</a>
        <a href="{{ route('admin.posts') }}" class="adm-button">Posts</a>
        <a href="{{ route('admin.comments') }}" class="adm-button">Comments</a>
        <a href="{{ route('admin.stats') }}" class="adm-button">Stats</a>
        <a href="{{ route('export-users-xlsx') }}" class="btn btn-primary">Export Users to XLSX</a>
    </div>
    <h1 style="margin-left: auto; margin-right: auto; text-align: center;">User List</h1>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                            <td>{{ $user->created_at }}</td>  
                            <td>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
