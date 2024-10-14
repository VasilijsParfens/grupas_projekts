<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class BrowseController extends Controller
{
    // Jaunākās publikācijas
    public function newestPosts()
    {
        $newestPosts = Post::orderBy('created_at', 'desc')
                           ->get();
        return view('posts.new', compact('newestPosts'));
    }

    // Popularākās publikācijas pēc vērtējumu (Likes) skaita
    public function popularPosts()
    {
        $popularPosts = Post::withCount('likes')
                            ->orderBy('likes_count', 'desc')
                            ->get();
        return view('posts.popular', compact( 'popularPosts'));
    }

    // Publikācijas no lietotājiem, kurus abonē autentificētais lietotājs
    public function followingPosts()
    {
        // Get the authenticated user
        $authUser = Auth::user();

        // Fetch IDs of users that the authenticated user is following
        $followingUserIds = $authUser->follows()->pluck('user_id');

        // Fetch the 6 most recent posts from followed users
        $posts = Post::whereIn('user_id', $followingUserIds)
            ->orderBy('created_at', 'desc')  // Order by the most recent
            ->take(6)  // Limit to 6 posts
            ->get();

        // Return the posts to the view (or as JSON for an API)
        return view('posts.following', ['posts' => $posts]);
    }

    // Publikācijas, kas ir tendencēs pēc vērtējumiem un datuma
    public function trendingPosts()
    {
        $trendingPosts = Post::withCount('likes')
                             ->orderByRaw('likes_count + (DATEDIFF(NOW(), created_at) * 0.1) DESC')
                             ->get();
        return view('posts.trending', compact('trendingPosts'));
    }
}
