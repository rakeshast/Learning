<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $type = $this->faker->randomElement([1,2]);
        return [
            // 'name' => "Larablog",
            // 'email' => "larablog@gmail.com",
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$3.Nq.9H4urBIuAGjNcSPeuaxpz71P1E6jqjRoHVL9D7wr/tf7AzIK', // password
            // 'remember_token' => Str::random(10),
            // 'username' => "larablog",
            // 'biography' => "I am a new Blogger",
            // 'type' => 1,
            // 'blocked' => 0,
            // 'direct_publish' => 1
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
