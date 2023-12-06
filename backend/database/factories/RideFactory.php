<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ride;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class RideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Ride::class;
    public function definition(): array
    {

        $array = [
            'ポタリングのみ',
            'ポタリングメイン',
            'ロングライド',
            'ガチライド',
            'トレーニング',
            'レース出場',
            'オールラウンド'
        ];

        return [
            'name'=>array_rand($array,random_int(1,count($array))),
            'team_id'=>Team::factory()
        ];
    }
}
