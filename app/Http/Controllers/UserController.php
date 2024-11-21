<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Optional profile picture validation
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePictureName = uniqid() . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->move(public_path('profile_pictures'), $profilePictureName);

            // Update the user's profile picture path in the database (if necessary)
            $user->profile_picture = $profilePictureName;
            $user->save();
        }

        // Log in the user after registration or redirect as necessary
        auth()->login($user);

        return redirect('/');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email', 'password' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        if (auth()->user()->id !== $user->id && !auth()->user()->is_admin){
            return redirect()->route('/')->with('error', 'Unauthorized action.');
        }

        if ($user->profile_picture) {
            $profilePicturePath = public_path('profile_pictures/' . $user->profile_picture);
            if (file_exists($profilePicturePath)) {
                unlink($profilePicturePath);
            }
    }
        $user->delete();

        return back();
    }

    public function showEditProfileForm()
    {
        return view('user.edit', [
            'user' => auth()->user(),
        ]);
    }

    // Edit profile information
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
            if ($user->profile_picture && file_exists(public_path('profile_pictures/' . $user->profile_picture))) {
                unlink(public_path('profile_pictures/' . $user->profile_picture));
            }

            // Save new profile picture
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_pictures'), $fileName);
            $user->profile_picture = $fileName;
        }

        // Save updated user information
        $user->save();

        return back()->with('message', 'Profile updated successfully!');
    }

}
