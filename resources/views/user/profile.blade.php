@extends('layout')

@section('content')
<!-- Profile Section -->
<section class="profile-section">
    <img src="{{ asset($userInfo['profile_picture'] ? 'profile_pictures/' . $userInfo['profile_picture'] : 'assets/noimage.png') }}" alt="{{ $userInfo['name'] }}" class="profile-image">
    <div class="profile-info">
        <h2>{{ $userInfo['name'] }}</h2>
        <div class="profile-stats">
            <div>{{ $followersCount }} followers</div>
        </div>
    </div>
</section>

<!-- Posts Section -->
<section class="profile-posts">
    <h3>Posts</h3>
    <div class="profile-content-slots">
        @if($posts->isEmpty())
            <p>This user has no posts.</p>
        @else
            @foreach($posts as $post)
                <div class="profile-slot">
                    <div class="profile-slot-image"><img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image"></div> <!-- Assuming your Post model has an image_url field -->
                    <div class="profile-slot-text">{{ $post->title }}</div>
                </div>
            @endforeach
        @endif
    </div>
</section>
@endsection
