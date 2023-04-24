<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;



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

            'name' => $this->faker->name(),
            'info' => $this->faker->text(),
            'auther' => $this->faker->name(),
            'publishing_house' => $this->faker->name(),
            'date' => $this->faker->date(),
            'availablity' =>rand(0,1),
            'price' =>rand(100,1000),
            'link'=>$this->faker->url(),
            'category_id'=>rand(1,4),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}