<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Annonce>
 */
class AnnonceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'photo' => 'b31d1dbaf9a509865ac5c6b8e169e301.png',
            'ville_code' => 72028,
            'habitation_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'exterieur_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'start_watch' => $this->faker->date,
            'end_watch' => $this->faker->date,
            'garde_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'chats' => 1,
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
