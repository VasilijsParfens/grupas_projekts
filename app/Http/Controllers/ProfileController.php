<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        // Atgriež datus uz skatu
        return view('user.profile', compact('user', 'posts', 'followersCount'));
    }

    // Edit profile information (including profile picture)
    public function editProfile(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10 MB
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update user's name
        $user->name = $request->input('name');

        // Check if a new profile picture is uploaded
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            // Check if the file size is more than 10 MB
            if ($file->getSize() > 10240 * 1024) { // 10 MB in bytes
                return back()->with('error', 'Profile picture cannot exceed 10 MB.');
            }

            // Delete old profile picture if exists
            if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }

            // Save new profile picture
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profile_pictures', $fileName);
            $user->profile_picture = $fileName;
        }

        // Save updated user information
        $user->save();

        return back()->with('message', 'Profile updated successfully!');
    }
}
