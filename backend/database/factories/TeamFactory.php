<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $header_img = $this->faker->image(storage_path('app/public/uploaded'),600,600);
        $thumbnail = $this->faker->image(storage_path('app/public/uploaded'),600,600);

        $header_img_path = basename($header_img);
        $thumbnail_path = basename($thumbnail);

        return [
            'header_img_path' => 'uploaded/' . $header_img_path,
            'thumbnail_path' => 'uploaded/' . $thumbnail_path,
            'team_name' => $this->faker->realText(10),
            'introduction' => $this->faker->realText(50),
            // 'average'=> $this->faker->numberBetween(1, 10),
            // 'from_age'=> $this->faker->numberBetween(1, 10),
            // 'to_age'=> $this->faker->numberBetween(1, 10),
            'detail_activity' => $this->faker->realText(50),
            'detail_area' => $this->faker->realText(50),
            'active_date' => $this->faker->realText(10),
            'active_date_detail' => $this->faker->realText(50),
            'team_url' => $this->faker->realText(50),
            'schedule' => $this->faker->realText(50),
            'user_id' => User::factory(),
        ];
    }
}
