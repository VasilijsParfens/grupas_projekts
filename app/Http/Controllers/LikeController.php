<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller {
    // Funkcija, kas piešķir vērtējumu publikācijai
    public function like(Request $request, $postId) {
        $userId = $request->user()->id;

        // Pārbauda, vai lietotājs jau ir novērtējis šo publikāciju
        $likeExists = Like::where('post_id', $postId)->where('user_id', $userId)->exists();

        if ($likeExists) {
            return response()->json(['message' => 'Jūs jau esat novērtējis šo publikāciju.'], 400);
        }

        // Ievieto jaunu ierakstu par like
        Like::create([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);

        return response()->json(['message' => 'Jūs veiksmīgi novērtējāt publikāciju.'], 200);
    }

    // Funkcija, kas noņem vērtējumu publikācijai
    public function unlike(Request $request, $postId) {
        $userId = $request->user()->id;

        // Pārbauda, vai lietotājs ir novērtējis šo publikāciju
        $like = Like::where('post_id', $postId)->where('user_id', $userId)->first();

        if (!$like) {
            return response()->json(['message' => 'Jūs neesat novērtējis šo publikāciju.'], 400);
        }

        // Dzēš ierakstu par like
        $like->delete();

        return response()->json(['message' => 'Jūs veiksmīgi noņēmāt savu vērtējumu no publikācijas.'], 200);
    }
}
