<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        \App\Models\BlogSocialMedia::factory(1)->create();
        \App\Models\Setting::factory(1)->create();
        \App\Models\Type::factory()->count(2)->sequence(['name' => 'Admin/Super Author'],['name' => 'Author'])
        ->create();
        \App\Models\User::factory()->count(2)->sequence(
            ['name' => 'Larablog', 'email' => 'larablog@gmail.com', 'email_verified_at' => now(), 'password' => '$2y$10$3.Nq.9H4urBIuAGjNcSPeuaxpz71P1E6jqjRoHVL9D7wr/tf7AzIK','remember_token' => Str::random(10), 'username' => "larablog", 'biography' => "I am a new Blogger", 'type' => 1, 'blocked' => 0, 'direct_publish' => 1],
            ['name' => 'Larablog Author', 'email' => 'larablog_author@gmail.com', 'email_verified_at' => now(), 'password' => '$2y$10$3.Nq.9H4urBIuAGjNcSPeuaxpz71P1E6jqjRoHVL9D7wr/tf7AzIK','remember_token' => Str::random(10), 'username' => "larablog_author", 'biography' => "I am a new Blogger", 'type' => 2, 'blocked' => 0, 'direct_publish' => 1])
        ->create();
        // \App\Models\Type::factory(2)->create();
        // \App\Models\User::factory(1)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\SubCategory::factory(5)->create();
        \App\Models\Post::factory(10)->create();
    }
}
