<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
   public function follow($followedUserId)
    {
        $userId = Auth::id(); // Iegūstam pašreizējā lietotāja ID

        // Pārbaudām, vai lietotājs cenšas abonēt sevi
        if ($userId == $followedUserId) {
            return view('/');
        }

        // Pārbaudām, vai jau tiek veikta abonēšana
        if (Follower::where('user_id', $followedUserId)->where('follower_id', $userId)->exists()) {
            return view('/');
        }

        // Pievienojam jaunu abonēšanas ierakstu
        Follower::create([
            'user_id' => $followedUserId, // Lietotājs, kuru abonē
            'follower_id' => $userId, // Lietotājs, kurš abonē
        ]);

        return view('/');
    }
    public function unfollow($followedUserId)
    {
        $userId = Auth::id(); // Iegūstam pašreizējā lietotāja ID

        // Mēģinām atrast abonēšanas ierakstu
        $follower = Follower::where('user_id', $followedUserId)->where('follower_id', $userId)->first();

        if (!$follower) {
            return view('/');
        }

        // Dzēšam ierakstu
        $follower->delete();

        return view('/');
    }


}

