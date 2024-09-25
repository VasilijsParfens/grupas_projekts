<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\File;

class AdminController extends Controller
{
    // Izņemt visas publikācijas no datubāzes
    public function showPosts(Request $request)
    {
        // Iegūstam visas publikācijas no datubāzes
        $posts = Post::all();
    
        // Atgriežam skatu un nododam tajā publikācijas
        return view('admin.posts', compact('posts'));
    }

    // Izņemt visus lietotājus no datubāzes
    public function showUsers(Request $request)
    {
        // Iegūstam visas lietotajus no datubāzes
        $users = User::all();
        
        return view('admin.users', compact('users'));
    }

    // Izņemt visus komentārus no datubāzes
    public function showComments()
    {
        // Iegūstam visas komentārus no datubāzes
        $comments = Comment::all();
        
        return view('admin.comments', compact('comments'));
    }

    // Statistikas apskate (publikāciju, lietotāju, komentāru, vērtējumu, failu skaits)
    public function showStats()
    {
        $totalComments = Comment::count();
        $totalFiles = File::count();
        $totalLikes = Like::count();
        $totalPosts = Post::count();
        $totalUsers = User::count();
        
        return view('admin.stats', compact('totalComments', 'totalFiles', 'totalLikes', 'totalPosts', 'totalUsers'));
    }
}
