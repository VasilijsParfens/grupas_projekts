<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Izveidot komentāru publikācijai
    public function storeComment(Request $request, $postId)
    {
        // Validate the request
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        // Check if the post exists
        $post = Post::findOrFail($postId);

        // Create a new comment
        $comment = new Comment();
        $comment->user_id = Auth::id(); // Assign the currently authenticated user
        $comment->post_id = $post->id; // Set the related post ID
        $comment->body = $request->input('body');
        $comment->save();

        return back()->with('message', 'Comment created successfully!');
    }

    // Rediģēt komentāru publikācijai (tikai komentāra autoram)
    public function updateComment(Request $request, $commentId)
    {
        // Validate the request
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        // Find the comment
        $comment = Comment::findOrFail($commentId);

        // Check if the authenticated user is the author of the comment
        if (Auth::id() !== $comment->user_id) {
            return back()->with('error', 'You are not authorized to update this comment.');
        }

        // Update the comment
        $comment->body = $request->input('body');
        $comment->save();

        return back()->with('message', 'Comment updated successfully!');
    }

    // Izdzēst komentāru publikācijai (tikai komentāra autoram vai administratoram)
    public function destroyComment($commentId)
    {
        // Find the comment
        $comment = Comment::findOrFail($commentId);

        // Check if the authenticated user is either the author or an admin
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            return back()->with('error', 'You are not authorized to delete this comment.');
        }

        // Delete the comment
        $comment->delete();

        return back()->with('message', 'Comment deleted successfully!');
    }
}



