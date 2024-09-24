<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    // Izvadīt galvēno lapu
    public function index()
    {
        // Fetch the 6 newest posts, ordered by the latest 'created_at' timestamp
        $newestPosts = Post::orderBy('created_at', 'desc')
                                       ->take(6)
                                       ->get();
    
        // Use compact to pass the $newestPosts to the view
        return view('posts.homepage', compact('newestPosts'));
    }
    
    // Function to show 6 newest posts
    public function newestPosts()
    {
        // Kodu raksti šeit
    }

    // Function to show 6 most popular posts (based on likes count)
    public function popularPosts()
    {
        // Kodu raksti šeit
    }

    // Function to show 6 posts from users followed by the authenticated user
    public function followingPosts()
    {
        // Kodu raksti šeit
    }

    // Function to show 6 trending posts (based on likes and date)
    public function trendingPosts()
    {
       // Kodu raksti šeit
    }
}
