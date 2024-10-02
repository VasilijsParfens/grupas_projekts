@extends('layout')
@section('content')

    <div class="browse-tabs">
        <a href="/newest"><div class="browse-tab" id="newTab">New</div></a>
        <a href="/popular"><div class="browse-tab" id="popularTab">Popular</div></a>
        <a href="/trending"><div class="browse-tab browse-active" id="trendingTab">Trending</div></a>
        @auth
            <a href="/following"><div class="browse-tab" id="followingTab">Following</div></a>
        @endauth
    </div>

    <h2 style="text-align: center;">Trending posts</h2>

    <div class="browse-content-slots">
        @if(count($trendingPosts) > 0)
            @foreach($trendingPosts as $post)
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
@endsection
