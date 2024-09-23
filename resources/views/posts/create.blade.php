@extends('layout')
@section('content')
    <div class="create-container">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="create-inputs">
                <div class="create-input">
                    <label for="title">Post Title:</label>
                    <input type="text" name="title" required>
                </div>
                <div class="create-input">
                    <label for="description">Description:</label>
                    <textarea name="description"></textarea>
                </div>
                <div class="create-input">
                    <label for="cover_image">Post Cover Image:</label>
                    <input type="file" name="cover_image" required>
                </div>
                <div class="create-input">
                    <label for="files">Upload Files (Max 5):</label>
                    <input type="file" name="files[]" multiple>
                </div>
                <div class="create-input">
                    <button type="submit">Create Post</button>
                </div>
            </div>
        </form>
    </div>

@endsection
