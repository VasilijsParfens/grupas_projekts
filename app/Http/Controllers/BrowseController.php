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
        $newestPosts = Post::with('user') // Load the related user to avoid N+1 queries
                           ->withCount('likes')
                           ->orderBy('created_at', 'desc')
                           ->get();
        return view('posts.new', compact('newestPosts'));
    }

    // Popularākās publikācijas pēc vērtējumu (Likes) skaita
    public function popularPosts()
    {
        $popularPosts = Post::with('user')
                            ->withCount('likes')
                            ->orderBy('likes_count', 'desc')
                            ->get();
        return view('posts.popular', compact('popularPosts'));
    }

    // Publikācijas no lietotājiem, kurus abonē autentificētais lietotājs
    public function followingPosts()
    {
        $authUser = Auth::user();
        $followingUserIds = $authUser->following()->pluck('user_id');

        $posts = Post::with('user')
            ->withCount('likes')
            ->whereIn('user_id', $followingUserIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.following', compact('posts'));
    }

    // Publikācijas, kas ir tendencēs pēc vērtējumiem un datuma
    public function trendingPosts()
    {
        $trendingPosts = Post::with('user')
                             ->withCount('likes')
                             ->orderByRaw('likes_count + (DATEDIFF(NOW(), created_at) * 0.1) DESC')
                             ->get();
        return view('posts.trending', compact('trendingPosts'));
    }
}
