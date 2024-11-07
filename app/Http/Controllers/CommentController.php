<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComment(Request $request, $postId)
    {
        // Validate the request
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        // Check for spam-like messages
        if ($this->isSpam($request->input('body'))) {
            return back()->with('error', 'Your comment appears to be spam and cannot be posted.');
        }

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

    // Helper method to detect spam messages
    private function isSpam($message)
    {
        // Define an array of forbidden words
        $forbiddenWords = [
            'casino', 'gamble', 'gambling', 'bet', 'betting',
            'jackpot', 'slots', 'poker', 'roulette', 'blackjack',
            'lottery', 'wager', 'stake', 'advertisement', 'advertise',
            'promo', 'promotion', 'offer', 'discount', 'free',
            'win', 'winner', 'winning', 'prize'
        ];

        // Additional spam checks
        $isRepetitive = preg_match('/(.)\1{4,}/', $message); // More than 4 repetitions of the same character
        $isNonsensical = preg_match('/^[a-zA-Z0-9\s,.!?]{10,}$/', $message); // Less likely to be gibberish if it's alphabetic and meets length criteria
        $containsLink = preg_match('/https?:\/\/[^\s]+/', $message); // Check for links
        $excessivePunctuation = preg_match('/[!@#$%^&*()_+={}\[\]|:;"\'<>,.?~`]{3,}/', $message);

        // Check for common spam phrases
        $commonSpamPatterns = [
            'click here', 'buy now', 'call now', 'visit our website'
        ];

        $containsCommonSpam = false;
        foreach ($commonSpamPatterns as $pattern) {
            if (stripos($message, $pattern) !== false) {
                $containsCommonSpam = true;
                break;
            }
        }

        // Check for forbidden words
        foreach ($forbiddenWords as $word) {
            if (stripos($message, $word) !== false) {
                return true;
            }
        }

        // Minimum word count
        $wordCount = str_word_count($message);
        $hasEnoughWords = $wordCount >= 1;

        // Final check combining all conditions
        return $isRepetitive || !$isNonsensical || $containsLink || $excessivePunctuation || $containsCommonSpam || !$hasEnoughWords;
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

        // Check for spam-like messages
        if ($this->isSpam($request->input('body'))) {
            return back()->with('error', 'Your updated comment appears to be spam and cannot be posted.');
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
