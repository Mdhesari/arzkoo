<?php

namespace Database\Factories;

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
            'title'     => $this->faker->title(),
            'body'      => $this->faker->text(),
            'excerpt'   => $this->faker->sentences(),
            'author_id' => 1,
            'status'    => 'PUBLISHED',
            'slug'      => 'test',
        ];
    }
}
