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

        // Fetch the 6 popular posts, ordered by likes

        // Fetch the 6 trending posts, ordered by likes

        // Fetch the 6 following posts, posts from users that authentficated user follows
        
        // Use compact to pass the $newestPosts to the view
        return view('posts.homepage', compact('newestPosts'));
    }
    

}
