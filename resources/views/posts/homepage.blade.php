@extends('layout')
@section('content')
<div class="homepage-scrollable-container">
    <div class="homepage-wide-container">
        <div class="homepage-block-title">Popular</div>
        <div class="homepage-content-slots">
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 1</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 2</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 3</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 4</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 5</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 6</div>
            </div>
        </div>
    </div>
    <div class="homepage-wide-container">
        <div class="homepage-block-title">Trending</div>
        <div class="homepage-content-slots">
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 1</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 2</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 3</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 4</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 5</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 6</div>
            </div>
        </div>
    </div>
    <div class="homepage-wide-container">
        <div class="homepage-block-title">Following</div>
        <div class="homepage-content-slots">
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 1</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 2</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 3</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 4</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 5</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 6</div>
            </div>
        </div>
    </div>
    <div class="homepage-wide-container">
        <div class="homepage-block-title">Recommended</div>
        <div class="homepage-content-slots">
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 1</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 2</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 3</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 4</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 5</div>
            </div>
            <div class="homepage-slot">
                <div class="homepage-slot-image"></div>
                <div class="homepage-slot-text">Slot 6</div>
            </div>
        </div>
    </div>
    <div class="homepage-wide-container">
        <div class="homepage-block-title">Recent</div>
        <div class="homepage-content-slots">
            @if(count($newestPosts) > 0)
                    @foreach($newestPosts as $post)
                    <div class="homepage-slot">
                        <div class="homepage-slot-image"><img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image"></div>
                        <div class="homepage-slot-text">Slot 1</div>
                    </div>
                    @endforeach
            @else
                <p>No posts found</p>
            @endif
        </div>
    </div>
</div>

@endsection
