<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File; // Add this import for file handling

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $likes = [];

        // Create users using factories
        User::factory(20)->create();

        // Create two specific users (one regular and one admin)
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('parole123'),
            'is_admin' => false,
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('parole123'),
            'is_admin' => true,
            'remember_token' => null,
        ]);

        // Post seeder
        for ($i = 1; $i <= 100; $i++) {
            // Get a random image from the test_images directory
            $testImagesDir = public_path('test_images');
            $coverImagesDir = public_path('cover_images');

            // Ensure the directory exists
            if (!File::exists($coverImagesDir)) {
                File::makeDirectory($coverImagesDir, 0777, true, true);
            }

            $images = File::files($testImagesDir); // Get all files in the test_images directory
            if (count($images) > 0) {
                // Randomly select an image
                $randomImage = $images[array_rand($images)];

                // Generate a unique name for the cover image to avoid conflicts
                $coverImageName = 'cover_' . time() . '_' . $i . '.' . $randomImage->getExtension();

                // Copy the image to the public/cover_images directory
                File::copy($randomImage->getPathname(), $coverImagesDir . '/' . $coverImageName);

                // Create the post with the assigned cover image
                Post::create([
                    'user_id' => rand(1, 22), // Assuming you have users with IDs 1-22
                    'title' => $faker->sentence($nbWords = 6, $variableNbWords = true), // Random title
                    'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true), // Random description
                    'cover_image' => $coverImageName, // Assign the copied image name to the post
                ]);
            } else {
                // Handle case where no images are available in the test_images directory
                Post::create([
                    'user_id' => rand(1, 22),
                    'title' => $faker->sentence($nbWords = 6),
                    'description' => $faker->paragraph($nbSentences = 3),
                ]);
            }
        }

        // Likes seeder
        for ($i = 0; $i < 500; $i++) {
            do {
                $user_id = $faker->numberBetween(1, 22);  // Random user_id between 1 and 22
                $post_id = $faker->numberBetween(1, 100); // Random post_id between 1 and 100
                $key = "$user_id-$post_id"; // Create a unique key
            } while (in_array($key, $likes)); // Keep generating until it's unique

            $likes[] = $key; // Store the unique key to avoid duplicates

            DB::table('likes')->insert([
                'user_id' => $user_id,
                'post_id' => $post_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Follower seeder
        $userIds = range(1, 22); // Assuming you have 22 users

        foreach ($userIds as $userId) {
            // Randomly choose followers for each user
            $followers = Arr::random($userIds, rand(1, 5)); // Randomly pick 1 to 5 followers

            foreach ($followers as $followerId) {
                if ($userId !== $followerId) { // Ensure a user does not follow themselves
                    DB::table('followers')->insert([
                        'user_id' => $userId,
                        'follower_id' => $followerId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Comment seeder
        $posts = Post::all();
        $users = User::all();

        if ($posts->isEmpty() || $users->isEmpty()) {
            $this->command->info('No posts or users found to create comments. Please seed posts and users first.');
            return;
        }

        foreach ($posts as $post) {
            for ($i = 0; $i < 10; $i++) { // Create 10 comments per post
                Comment::create([
                    'user_id' => $users->random()->id, // Randomly assign a user
                    'post_id' => $post->id, // Assign the current post
                    'body' => $faker->sentence($nbWords = 10, $variableNbWords = true), // Generate a random sentence
                ]);
            }
        }

        $this->command->info('Database seeded successfully!');
    }
}
