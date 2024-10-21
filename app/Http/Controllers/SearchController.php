<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User; // Pievienots User modelis
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function filter(Request $request)
    {
        // Validēt atslēgvārdus
        $request->validate([
            'keywords' => 'required|string',
        ]);

        $keywords = $request->input('keywords');

        // Meklēt publikācijas, kur atslēgvārdi ir līdzīgi nosaukumam, aprakstam vai lietotāja vārdam
        $posts = Post::where('title', 'like', '%' . $keywords . '%')
            ->orWhere('description', 'like', '%' . $keywords . '%')
            ->orWhereHas('user', function ($query) use ($keywords) { // Nomainīts uz user
                $query->where('name', 'like', '%' . $keywords . '%');
            })
            ->get();

        // Atgriezt atrastās publikācijas ar posts.search skatu
        return view('posts.search', compact('posts'));
    }
}
