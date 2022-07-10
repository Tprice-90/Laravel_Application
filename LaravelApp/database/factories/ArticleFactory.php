<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $categoryId = \App\Category::pluck('id')->all();
    $authorId = \App\User::pluck('id')->all();
    return [
        'name' => $faker->sentence,
        'body' => $faker->sentence,
        'category_id' => $faker->randomElement($categoryId),
        'author_id' => $faker->randomElement($authorId),
    ];
});
