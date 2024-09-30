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

        return response()->json(['message' => 'Comment created successfully!', 'comment' => $comment]);
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
            return response()->json(['message' => 'You are not authorized to update this comment.'], 403);
        }

        // Update the comment
        $comment->body = $request->input('body');
        $comment->save();

        return response()->json(['message' => 'Comment updated successfully!', 'comment' => $comment]);
    }

    // Izdzēst komentāru publikācijai (tikai komentāra autoram)
    public function destroyComment($commentId)
    {
        // Find the comment
        $comment = Comment::findOrFail($commentId);

        // Check if the authenticated user is the author of the comment
        if (Auth::id() !== $comment->user_id) {
            return response()->json(['message' => 'You are not authorized to delete this comment.'], 403);
        }

        // Delete the comment
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully!']);
    }
}

