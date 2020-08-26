<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => function(){ return \App\User::all()->random(); },
        'category_id' => function(){ return \App\Models\Category::all()->random();},
        'title' => $faker->sentence(5),
        'body' => $faker->text
     ];
});
