<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;

class CheckPostAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the post by ID
        $post = Post::findOrFail($request->route('id'));

        // Check if the authenticated user is the post author
        if (auth()->user()->id !== $post->user_id) {
            // If not, deny access
            abort(403, 'Unauthorized action.');
        }

        // Proceed if authorized
        return $next($request);
    }
}
