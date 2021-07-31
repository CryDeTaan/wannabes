<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Snippet;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $snippetCount = Snippet::count();
        $userCount = User::count();

        foreach(range(1,130) as $index) {
            Comment::factory()->create([
                'snippet_id' => Snippet::find(rand(1, $snippetCount)),
                'user_id' => User::find(rand(1, $userCount)),
            ]);
        }
    }
}
