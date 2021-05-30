<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'Tag One', 'color' => 'blue']);
        Tag::create(['name' => 'Tag Two', 'color' => 'red']);
        Tag::create(['name' => 'Tag Three', 'color' => 'green']);
        Tag::create(['name' => 'Tag Four', 'color' => 'pink']);
        Tag::create(['name' => 'Tag five', 'color' => 'yellow']);
    }
}
