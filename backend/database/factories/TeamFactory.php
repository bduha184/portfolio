<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Team;
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
    protected $model = Team::class;
    public function definition(): array
    {
        $header_img = $this->faker->image(storage_path('app/public/uploaded'), 600, 600);
        $thumbnail = $this->faker->image(storage_path('app/public/uploaded'), 600, 600);

        $header_img_path = basename($header_img);
        $thumbnail_path = basename($thumbnail);


        $ages = [
            '10代',
            '20代',
            '30代',
            '40代',
            '50代',
            '60代',
            '70代'
        ];

        $averages = [
            '1:9',
            '2:8',
            '3:7',
            '4:6',
            '5:5',
            '6:4',
            '7:3',
            '8:2',
            '9:1',
        ];

        $activeDate = [
            '平日',
            '土日',
            '土日祝',
        ];


        return [
            'header_img_path' => 'uploaded/' . $header_img_path,
            'thumbnail_path' => 'uploaded/' . $thumbnail_path,
            'team_name' => $this->faker->realText(10),
            'introduction' => $this->faker->realText(50),
            'average'=> $averages[random_int(0,8)],
            'from_age'=> $ages[random_int(0,6)],
            'to_age'=> $ages[random_int(0,6)],
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
