@extends('layout')
@section('content')
<div class="homepage-scrollable-container">
    <div class="homepage-wide-container">
        <div class="homepage-block-title"><a href="/newest">Recent</a></div>
        <div class="homepage-content-slots">
            @if(count($newestPosts) > 0)
                @foreach($newestPosts as $post)
                    <div class="homepage-slot">
                        <a href="{{ route('posts.show', $post->id) }}" class="slot-link">
                            <div class="homepage-slot-image">
                                <img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image">
                            </div>
                            <div class="homepage-slot-text">{{ $post->title }}</div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>No posts found</p>
            @endif
        </div>
    </div>

    <div class="homepage-wide-container">
        <div class="homepage-block-title"><a href="/popular">Popular</a></div>
        <div class="homepage-content-slots">
            @if(count($popularPosts) > 0)
                @foreach($popularPosts as $post)
                    <div class="homepage-slot">
                        <a href="{{ route('posts.show', $post->id) }}" class="slot-link">
                            <div class="homepage-slot-image">
                                <img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image">
                            </div>
                            <div class="homepage-slot-text">{{ $post->title }}</div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>No posts found</p>
            @endif
        </div>
    </div>

    <div class="homepage-wide-container">
        <div class="homepage-block-title"><a href="/trending">Trending</a></div>
        <div class="homepage-content-slots">
            @if(count($trendingPosts) > 0)
                @foreach($trendingPosts as $post)
                    <div class="homepage-slot">
                        <a href="{{ route('posts.show', $post->id) }}" class="slot-link">
                            <div class="homepage-slot-image">
                                <img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image">
                            </div>
                            <div class="homepage-slot-text">{{ $post->title }}</div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>No posts found</p>
            @endif
        </div>
    </div>

    @auth
    <div class="homepage-wide-container">
        <div class="homepage-block-title"><a href="/following">Following</a></div>
        <div class="homepage-content-slots">
            @foreach (range(1, 6) as $i)
                <div class="homepage-slot">
                    <a href="#" class="slot-link"> <!-- Placeholder link for "following" posts -->
                        <div class="homepage-slot-image"></div>
                        <div class="homepage-slot-text">Slot {{ $i }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endauth
</div>
@endsection
