<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Likes;
use App\Models\Files;

class AdminController extends Controller
{
    // Izņemt visas publikācijas no datubāzes
    public function showPosts(Request $request)
    {
        // Kodu raksti šeit
    }

    // Izņemt visus lietotājus no datubāzes
    public function showUsers(Request $request)
    {
        // Kodu raksti šeit
    }

    // Izņemt visus komentārus no datubāzes
    public function showComments()
    {
        // Kodu raksti šeit
    }

    // Statistikas apskate (publikāciju, lietotāju, komentāru, vērtējumu, failu skaits)
    public function showStats()
    {
        // Kodu raksti šeit
    }
}
