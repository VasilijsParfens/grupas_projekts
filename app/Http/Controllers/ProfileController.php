<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Parāda lietotāja vārdu, profila bildi, reģistrācijas datumu
    public function showInfo($userId)
    {
        // Iegūst lietotāju, izmantojot ID
        $user = User::findOrFail($userId);
        
        // Iegūst lietotāja publikācijas
        $posts = Post::where('user_id', $userId)->get();
        
        // Iegūst sekotāju skaitu
        $followersCount = Follower::where('user_id', $userId)->count();

        // Sagatavo datus, kurus parādīs
        $userInfo = [
            'name' => $user->name,
            'profile_picture' => $user->profile_picture,
            'registration_date' => $user->created_at->format('Y-m-d'), // Formatē datumu
            'followers_count' => $followersCount,
            'posts' => $posts,
        ];

        // Atgriež datus, varat izmantot skatu vai atgriezt kā JSON
        return response()->json($userInfo);
    }
}

