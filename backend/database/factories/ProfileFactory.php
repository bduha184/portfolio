<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Profile::class;

    public function definition(): array
    {
        $header_img = $this->faker->image(storage_path('app/public/uploaded'),600,600);
        $thumbnail = $this->faker->image(storage_path('app/public/uploaded'),600,600);

        $header_img_path = basename($header_img);
        $thumbnail_path = basename($thumbnail);

        return [
                'header_img_path' => 'uploaded/'.$header_img_path,
                'thumbnail_path' => 'uploaded/'.$thumbnail_path,
                'introduction'=> $this->faker->realText(50),
                'user_id'=>User::factory(),
        ];
    }
}
