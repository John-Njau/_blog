<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//        User::truncate();
//        Category::truncate();
//        Post::truncate();

//        $user = User::factory()->create([
//            "name"=>"Jing Jong"
//        ]);


//        Post::factory(5)->create([
//                "user_id" => $user->id
//            ]
//        );

        Post::factory(10)->create();



//        $user = User::factory()->create();
//
//        $personal = Category::create([
//            'name' => 'Personal',
//            'slug' => 'personal'
//        ]);
//
//        $work = Category::create([
//            'name' => 'Work',
//            'slug' => 'work'
//        ]);
//
//        $family = Category::create([
//            'name' => 'Family',
//            'slug' => 'family'
//        ]);
//
//        Post::create([
//            'user_id' => $user->id,
//            'category_id' => $personal->id,
//            'slug' => 'personal-post',
//            'title' => 'Personal Post',
//            'excerpt' => '<p>Trying excerpts posted using seaders</p>',
//            'body' => '<p>In the name of the holy code, we are going to make it out alive.</p>',
//        ]);
//
//        Post::create([
//            'user_id' => $user->id,
//            'category_id' => $family->id,
//            'title' => 'Family Post',
//            'slug' => 'family-post',
//            'excerpt' => '<p>Trying excerpts posted using seaders</p>',
//            'body' => '<p>In the name of the holy code, we are going to make it out alive.</p>',
//        ]);
//
//        Post::create([
//            'user_id' => $user->id,
//            'category_id' => $work->id,
//            'title' => 'Work Post',
//            'slug' => 'work-post',
//            'excerpt' => '<p>Trying excerpts posted using seaders</p>',
//            'body' => '<p>In the name of the holy code, we are going to make it out alive.</p>',
//        ]);
    }
}
