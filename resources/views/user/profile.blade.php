@extends('layout')

@section('content')
<!-- Profile Section -->
<section class="profile-section">
    <img src="{{ asset($user['profile_picture'] ? 'profile_pictures/' . $user['profile_picture'] : 'assets/noimage.png') }}" alt="{{ $user['name'] }}" class="profile-image">
    <div class="profile-info">
        <h2>{{ $user['name'] }}</h2>
        <div class="profile-stats">
            <div>{{ $followersCount }} followers</div>
            @if (Auth::check() && Auth::id() !== $user['id']) <!-- Only show follow/unfollow if not viewing own profile -->
                @if (Auth::user()->isFollowing($user->id))
                    <!-- Unfollow Form -->
                    <form action="{{ route('unfollow', $user['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Unfollow</button>
                    </form>
                @else
                    <!-- Follow Form -->
                    <form action="{{ route('follow', $user['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Follow</button>
                    </form>
                @endif
            @elseif (Auth::guest())
                <p>Please <a href="{{ route('login') }}">login</a> to follow or unfollow users.</p>
            @endif

            @if (Auth::check() && Auth::id() === $user['id']) <!-- Only show Edit Profile if viewing own profile -->
                <div class="profile-actions">
                    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Edit Profile</a>
                </div>
            @endif
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
                <!-- Keep slot design intact and make it clickable with CSS -->
                <a href="{{ route('posts.show', $post->id) }}" class="slot-link">
                    <div class="profile-slot-image">
                        <img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image">
                    </div>
                    <div class="profile-slot-text">{{ $post->title }}</div>
                </a>
            </div>
            @endforeach
        @endif
    </div>
</section>
@endsection
