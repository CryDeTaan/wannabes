<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Snippet;
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
    }
}
