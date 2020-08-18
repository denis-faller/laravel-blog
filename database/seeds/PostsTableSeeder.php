<?php

use Illuminate\Database\Seeder;
use Blog\Models\Post;
use Blog\Models\Tag;
use Blog\Models\Category;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 10)->create()->each(function ($p) {
            $p->tags()->save(Tag::find(rand(1, 2)));
        });;
    }
}
