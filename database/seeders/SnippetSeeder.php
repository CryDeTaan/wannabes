<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Snippet;
use App\Models\User;
use App\Models\Tag;

class SnippetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();

        Snippet::all()->each(function ($snippet) use ($tags) {
            $snippet->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')
            );
        });

        $userCount = User::count();
        $snippetCount = Snippet::count();

        foreach(range(1,300) as $index) {
            $user = User::find(rand(1, $userCount));
            $snippet = Snippet::find(rand(1, $snippetCount));
            $snippet->streetcred()->updateOrCreate([
                'user_id' => $user->id,
            ], [
                'streetcred' => 1
            ]);
            $user->increment('streetcred');
        }

    }
}
