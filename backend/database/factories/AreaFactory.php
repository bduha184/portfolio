<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $array = [
            '北海道',
            '青森',
            '秋田',
            '岩手',
            '大阪',
            '京都',
            '兵庫',
            '奈良',
            '滋賀',
            '和歌山',
        ];

        return [
            'name'=>$array,
        ];
    }
}
