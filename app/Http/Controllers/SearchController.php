<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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

        // Meklēt publikācijas, kur atslēgvārdi ir līdzīgi nosaukumam, aprakstam vai autora vārdam
        $posts = Post::where('title', 'like', '%' . $keywords . '%')
            ->orWhere('description', 'like', '%' . $keywords . '%')
            ->orWhereHas('author', function ($query) use ($keywords) {
                $query->where('name', 'like', '%' . $keywords . '%');
            })
            ->get();

        // Atgriezt atrastās publikācijas
        return response()->json($posts);
    }
}
