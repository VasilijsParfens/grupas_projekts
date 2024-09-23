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
        // Kodu raksti šeit
    }

    // Popularākās publikācijas pēc vērtējumu (Likes) skaita
    public function popularPosts()
    {
        // Kodu raksti šeit
    }

    // Publikācijas no lietotājiem, kurus abonē autentificētais lietotājs
    public function followingPosts()
    {
        // Kodu raksti šeit
    }

    // Publikācijas, kas ir tendencēs pēc vērtējumiem un datuma
    public function trendingPosts()
    {
        // Kodu raksti šeit
    }
}
