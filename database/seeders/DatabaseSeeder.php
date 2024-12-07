<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    //When run from terminal, this function creates 15 posts using the PostFactory.
    public function run(): void
    {
        Post::factory(15)->create();
    }
}
