<?php

namespace Database\Factories;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         
                return [
                    'user_id' => 1,
                    'category_id'=> random_int(1,8),
                    'title' => $faker->sentence($nbWords = 10, $variableNbWords = true),
                    'slug' => Str::slug($faker->sentence($nbWords = 10, $variableNbWords = true)),
                    'image' => 'laravel-wiki-5f92a8e71c7bc1603447015.jpg',
                    'body' => $faker->paragraph($nbSentences = 20, $variableNbSentences = true),
                    'view_count' => random_int(10,100),
                    'status' => 1
                ];
        
    }
}
