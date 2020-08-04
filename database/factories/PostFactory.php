<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Blog\Models\Post;
use Blog\Models\Site;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Post::class, function (Faker $faker) {
    $date = Carbon\Carbon::now();
    return [
        'site_id' => Site::MAIN_SITE_ID,
        'main_page' => $faker->boolean,
        'name' => $faker->sentence(5),
        'url' => $faker->domainWord,
        'publish_time' => $date, 
        'preview_img' => '/assets/images/img_1.jpg',
        'view_count' => 0,
        'category_id' => rand(1, 2),
        'author_id' => 1,
        'text' => $faker->text(300),
        'created_at' => $date, 
        'updated_at' => $date
    ];
});
