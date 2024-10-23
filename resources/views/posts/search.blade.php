@extends('layout')

@section('content')
    <h1 style="margin-left: auto; margin-right: auto; text-align: center">Search Results</h1>
    @if($posts->isEmpty())
        <p>No results found for "{{ $query }}".</p>
    @else
    <div class="browse-content-slots">
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="browse-slot">
                    <a href="{{ route('posts.show', $post->id) }}" class="slot-link">
                        <div class="browse-slot-image">
                            <img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image">
                        </div>
                        <div class="browse-slot-text">{{ $post->title }}</div>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    @endif
@endsection
