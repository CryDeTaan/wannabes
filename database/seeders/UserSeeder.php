<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->hasSnippets(50)
            ->create([
                'name' => 'CryDeTaan',
                'email' => 'CryDeTaan@wannabe.test',
                'password' => bcrypt('123')
        ]);

        User::factory(10)
            ->hasSnippets(50)
            ->create();
    }
}
