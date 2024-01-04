<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ride;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
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
        Ride::factory()->create();

    }
}
