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
            return redirect()->back();
        }

        // Pārbaudām, vai jau tiek veikta abonēšana
        if (Follower::where('user_id', $followedUserId)->where('follower_id', $userId)->exists()) {
            return redirect()->back();
        }

        // Pievienojam jaunu abonēšanas ierakstu
        Follower::create([
            'user_id' => $followedUserId, // Lietotājs, kuru abonē
            'follower_id' => $userId, // Lietotājs, kurš abonē
        ]);

        return redirect()->back();
    }
    public function unfollow($followedUserId)
    {
        $userId = Auth::id(); // Iegūstam pašreizējā lietotāja ID

        // Mēģinām atrast abonēšanas ierakstu
        $follower = Follower::where('user_id', $followedUserId)->where('follower_id', $userId)->first();

        if (!$follower) {
            return redirect()->back();
        }

        // Dzēšam ierakstu
        $follower->delete();

        return redirect()->back();
    }


}

