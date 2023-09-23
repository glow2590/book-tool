<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // create a list of books using faker
            'author_id' => 1,
            'title' => $this->faker->sentence(3),
            // create a paragraph of overview
            'overview' => $this->faker->paragraph(3),
            // add book image
            'image' => $this->faker->imageUrl(),

            'slug' => $this->faker->slug(),

        ];
    }
}
