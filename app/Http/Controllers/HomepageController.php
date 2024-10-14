<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomepageController extends Controller
{
    // Izvadīt galvēno lapu
    public function index()
    {
        // Fetch the 6 newest posts, ordered by the latest 'created_at' timestamp
        $newestPosts = Post::orderBy('created_at', 'desc')
                           ->take(6)
                           ->get();
    
        // Fetch the 6 popular posts, ordered by the count of likes
        $popularPosts = Post::withCount('likes')
                            ->orderBy('likes_count', 'desc')
                            ->take(6)
                            ->get();
    
        // Fetch the 6 trending posts, ordered by likes and date
        // Assuming trending is determined by likes count and recency
        $trendingPosts = Post::withCount('likes')
                             ->orderByRaw('likes_count + (DATEDIFF(NOW(), created_at) * 0.1) DESC')
                             ->take(6)
                             ->get();
        // Get the authenticated user
        $authUser = Auth::user();

        // Fetch IDs of users that the authenticated user is following
        $followingUserIds = $authUser->following()->pluck('user_id');

        // Fetch the 6 most recent posts from followed users
        $followingPosts = Post::whereIn('user_id', $followingUserIds)
            ->orderBy('created_at', 'desc')  // Order by the most recent
            ->take(6)  // Limit to 6 posts
            ->get();
        
        // Use compact to pass the posts to the view
        return view('posts.homepage', compact('newestPosts', 'popularPosts', 'trendingPosts', 'followingPosts'));
    }

    

}
