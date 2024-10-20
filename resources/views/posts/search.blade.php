@extends('layout')

@section('content')
    <h1 style="margin-left: auto; margin-right: auto; text-align: center">Search Results</h1>
    @if($results->isEmpty())
        <p>No results found for "{{ $query }}".</p>
    @else
    <div class="grid-container">
        @foreach($results as $post)
            <div class="post-preview">
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="post-link">
                    <img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image">
                    <div class="post-info">
                        <div class="post-user">{{ $post->user->name }}</div>
                        <div class="post-title">{{ $post->title }}</div>
                </div>
                </a>
            </div>
        @endforeach
    </div>
    @endif
@endsection
