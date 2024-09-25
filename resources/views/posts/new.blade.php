@extends('layout')
@section('content')

    <div class="browse-tabs">
        <a href="/newest"><div class="browse-tab browse-active" id="newTab">New</div></a>
        <a href="/popular"><div class="browse-tab" id="popularTab">Popular</div></a>
        <a href="/trending"><div class="browse-tab" id="trendingTab">Trending</div></a>
        @auth
            <a href="/following"><div class="browse-tab" id="followingTab">Following</div></a>
        @endauth
    </div>

    <h2 style="text-align: center;">Recent posts</h2>

    <div class="browse-content-slots">
        @if(count($newestPosts) > 0)
            @foreach($newestPosts as $post)
                <div class="browse-slot">
                    <div class="browse-slot-image"><img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image"></div>
                    <div class="browse-slot-text">{{$post->title}}</div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
