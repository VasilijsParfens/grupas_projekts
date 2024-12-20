@extends('layout')
@section('content')
    <div class="post-page-container">
        <div class="post-page-top-section">
            <div class="post-page-cover-image">
                <img src="{{ asset($post->cover_image ? 'cover_images/' . $post->cover_image : 'assets/noimage.png') }}" alt="{{ $post->title }}" class="post-image" style="width: 300px; height: 300px;">
            </div>

            <div class="post-page-details">
                <div class="post-page-profile-info">
                    <img src="{{ asset($author['profile_picture'] ? 'profile_pictures/' . $author['profile_picture'] : 'assets/noimage.png') }}" alt="{{ $author['name'] }}" class="profile-image">
                    <div class="profile-details">
                        <h2>
                            <a href="{{ route('profile.show', $author->id) }}">{{ $author->name }}</a>
                        </h2>
                        <div class="post-page-metadata">
                            <span>{{ $likesCount }} Likes</span>
                            <span>{{ $commentsCount }} comments</span>
                            <span>Posted {{ $post->created_at->format('d.m.Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="post-page-description">
                    {{ $post->description }}
                </div>

                <!-- Like Button Visible to Authenticated Users Only and Not the Post Author -->
                @if(Auth::check() && Auth::id() !== $author->id)
                    <form action="{{ $isLikedByUser ? route('posts.unlike', $post->id) : route('posts.like', $post->id) }}" method="POST" class="post-page-like-form">
                        @csrf
                        <button type="submit" class="post-page-like-button">
                            {{ $isLikedByUser ? 'Unlike' : 'Like' }} Post
                        </button>
                    </form>
                @endif


                <!-- Edit and Delete Buttons Visible Only to Post Author -->
                @if(Auth::check() && Auth::id() === $author->id)
                    <div class="post-page-author-actions" style="margin-top: 20px">
                        <a href="{{ route('posts.edit', $post->id) }}" class="post-page-edit-button">Edit Post</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="post-page-delete-button" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        @if ($post->files->isNotEmpty())
            <div class="post-page-files">
                <h3>Files:</h3>
                @foreach ($post->files as $file)
                    <div class="post-page-file">
                        <a href="javascript:void(0);" onclick="window.open('{{ asset('files/' . $post->id . '/' . $file->file_name) }}', '_blank');">
                            {{ $file->file_name }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Comment Form Visible to Authenticated Users Only -->
        @if(Auth::check())
            <div class="post-page-comment-form">
                <h3>Add a Comment:</h3>
                <form id="commentForm" action="{{ route('comments.store', $post->id) }}" method="POST" class="post-page-comment-form-container">
                    @csrf
                    <input type="text" name="honeypot" style="display:none;"> <!-- Honeypot field -->
                    <textarea name="body" rows="3" placeholder="Write your comment..." required></textarea>
                    <button type="submit">Post Comment</button>
                </form>
            </div>
@endif

        <!-- Display Comments Section -->
        <div class="post-page-comments">
            @foreach($post->comments as $comment)
                <div class="post-page-comment" id="comment-{{ $comment->id }}">
                    <img src="{{ $comment->user->profile_picture ? '/profile_pictures/' . $comment->user->profile_picture : '/assets/noimage.png' }}" alt="{{ $comment->user->name }}">
                    <div class="post-page-comment-text">
                        <strong>{{ $comment->user->name }}</strong>
                        <p>{{ $comment->body }}</p>
                        <div class="post-page-comment-actions">
                            @if(Auth::id() === $comment->user_id) <!-- Check if the logged-in user is the author -->
                                <button type="button" class="post-page-edit-button" onclick="toggleEditForm({{ $comment->id }})">Edit</button>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="post-page-delete-button">Delete</button>
                                </form>
                            @endif
                        </div>
                        <!-- Edit Comment Form -->
                        <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="post-page-edit-comment-form" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="body" value="{{ $comment->body }}" required>
                            <button type="submit" class="post-page-edit-button save-button" style="margin-top: 10px;">Save</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
@endsection

