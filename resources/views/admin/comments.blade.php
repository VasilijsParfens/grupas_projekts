@extends('layout')
@section('content')
<div class="container">
    <div class="adm-button-container" style="text-align: center; margin-bottom: 60px; margin-top: 60px">
        <a href="{{ route('admin.users') }}" class="adm-button">Users</a>
        <a href="{{ route('admin.posts') }}" class="adm-button">Posts</a>
        <a href="{{ route('admin.comments') }}" class="adm-button">Comments</a>
        <a href="{{ route('admin.stats') }}" class="adm-button">Stats</a>
    </div>
    <h1 style="margin-left: auto; margin-right: auto; text-align: center;">Comment List</h1>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->user_id }}</td>
                        <td>{{ $comment->post_id }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
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

