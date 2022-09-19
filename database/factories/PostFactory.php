<?php

namespace Database\Factories;

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
        $id = rand(30, 600);
        $title = $this->faker->sentence($nbWords = 5, $variableNbWords = true);

        return [
            'user_id' => User::where('email', 'admin@mail.com')->value('id'),
            'title' => $title,
            'slug' => strSlug($title),
            'thumbnail' => $this->faker->imageUrl(),
            'short_description' => $this->faker->sentence(10),
            'long_description' => $this->faker->paragraph(50),
            'total_views' => rand(0, 100),
        ];
    }
}
