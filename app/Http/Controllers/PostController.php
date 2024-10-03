<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comments;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'files' => 'array|max:5',
            'files.*' => 'file|max:5120', // Maximum file size 5MB
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = auth()->id(); // Assuming the user is authenticated

        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $coverImageName = $post->id . '_' . time() . '.' . $coverImage->getClientOriginalExtension();
            $coverImage->move(public_path('cover_images'), $coverImageName);
            $post->cover_image = $coverImageName;
        }

        $post->save();

        // Store additional files
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('files/' . $post->id), $fileName);

                // Save file info to the files table
                $postFile = new File;
                $postFile->post_id = $post->id;
                $postFile->file_name = $fileName;
                $postFile->save();
            }
        }
        return redirect('/');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'files.*' => 'nullable|file|max:5120', // Maximum file size 5MB
        ]);

        // Find the post by ID
        $post = Post::findOrFail($id);

        // Check if the authenticated user is the author of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/');
        }

        // Update the post details
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        // Handle cover image update
        if ($request->hasFile('cover_image')) {
            // Delete old cover image if it exists
            if ($post->cover_image && file_exists(public_path('cover_images/' . $post->cover_image))) {
                unlink(public_path('cover_images/' . $post->cover_image));
            }

            // Store the new cover image
            $coverImage = $request->file('cover_image');
            $coverImageName = 'cover_' . time() . '.' . $coverImage->getClientOriginalExtension();
            $coverImage->move(public_path('cover_images'), $coverImageName);
            $post->cover_image = $coverImageName;
            $post->save();
        }

        // Handle file updates
        if ($request->hasFile('files')) {
            // Delete old files if they exist
            $oldFiles = File::where('post_id', $post->id)->get();
            foreach ($oldFiles as $oldFile) {
                if (file_exists(public_path('files/' . $post->id . '/' . $oldFile->file_name))) {
                    unlink(public_path('files/' . $post->id . '/' . $oldFile->file_name));
                }
                $oldFile->delete(); // Delete old file record from the database
            }

            // Store new files
            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('files/' . $post->id), $fileName);

                // Save file info to the files table
                $postFile = new File;
                $postFile->post_id = $post->id;
                $postFile->file_name = $fileName;
                $postFile->save();
            }
        }

        return redirect('/')->with('success', 'Post updated successfully.');
    }


    public function destroy($id)
{
    // Find the post by ID
    $post = Post::findOrFail($id);

    // Delete the cover image if it exists
    $coverImagePath = public_path('cover_images/' . $post->cover_image);
    if (file_exists($coverImagePath)) {
        unlink($coverImagePath); // Use unlink for a single file
    }

    // Delete the files directory for the post
    $filesDirectoryPath = public_path('files/' . $post->id); // No 'public/' prefix
    if (is_dir($filesDirectoryPath)) {
        $this->deleteDirectory($filesDirectoryPath); // Custom function to delete the directory
    }

    // Delete the post (this will also delete associated files due to cascading in DB)
    $post->delete();

    return redirect('/');
}

private function deleteDirectory($dir)
{
    if (!is_dir($dir)) {
        return;
    }

    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            $this->deleteDirectory($path); // Recursive delete
        } else {
            unlink($path); // Delete the file
        }
    }

    rmdir($dir); // Remove the empty directory
}


public function show(Post $post)
{
    $author = $post->user;
    $comments = $post->comments()->with('user')->get();
    $files = $post->files;
    $likesCount = $post->likes()->count(); // Count likes
    $commentsCount = $post->comments()->count(); // Count comments
    $isLikedByUser = $post->likes()->where('user_id', auth()->id())->exists();

    return view('posts.show', compact('post', 'author', 'comments', 'files', 'likesCount', 'commentsCount', 'isLikedByUser'));
}

}
