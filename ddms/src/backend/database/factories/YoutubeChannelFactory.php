<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\YoutubeChannel>
 */
class YoutubeChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'channel_id' => $this->faker->bothify('?????#####???#?#?#?#??#?#?#?#?#?#?#?#?'),
        ];
    }
}
