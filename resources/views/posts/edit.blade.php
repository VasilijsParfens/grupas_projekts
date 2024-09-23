@extends('layout')
@section('content')
    <div class="create-container">
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="create-inputs">
                <div class="create-input">
                    <label for="title">Post Title:</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
                </div>

                <div class="create-input">
                    <label for="description">Description:</label>
                    <textarea name="description">{{ old('description', $post->description) }}</textarea>
                </div>

                <div class="create-input">
                    <label for="cover_image">Current Cover Image:</label>
                    @if($post->cover_image)
                        <img src="{{ asset('cover_images/' . $post->cover_image) }}" alt="Cover Image" width="200px">
                    @else
                        <p>No cover image.</p>
                    @endif
                    <label for="cover_image">Change Cover Image:</label>
                    <input type="file" name="cover_image">
                </div>

                <div class="create-input">
                    <label for="files">Current Files:</label>
                    @if($post->files && $post->files->count() > 0)
                        <ul>
                            @foreach($post->files as $file)
                                <li>{{ $file->file_name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No files uploaded.</p>
                    @endif
                    <label for="files">Upload New Files (Max 5):</label>
                    <input type="file" name="files[]" multiple>
                </div>

                <div class="create-input">
                    <button type="submit">Update Post</button>
                </div>
            </div>
        </form>
    </div>
@endsection
