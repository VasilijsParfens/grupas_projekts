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
            return back()->with('error', 'Jūs jau esat novērtējis šo publikāciju.');
        }

        // Ievieto jaunu ierakstu par like
        Like::create([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);

        return back()->with('success', 'Jūs veiksmīgi novērtējāt publikāciju.');
    }

    // Funkcija, kas noņem vērtējumu publikācijai
    public function unlike(Request $request, $postId) {
        $userId = $request->user()->id;

        // Pārbauda, vai lietotājs ir novērtējis šo publikāciju
        $like = Like::where('post_id', $postId)->where('user_id', $userId)->first();

        if (!$like) {
            return back()->with('error', 'Jūs neesat novērtējis šo publikāciju.');
        }

        // Dzēš ierakstu par like
        $like->delete();

        return back()->with('success', 'Jūs veiksmīgi noņēmāt savu vērtējumu no publikācijas.');
    }
}
