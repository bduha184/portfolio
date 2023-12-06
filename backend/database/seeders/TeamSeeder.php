<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $array_rides = [
            '',
            'ポタリングのみ',
            'ポタリングメイン',
            'ロングライド',
            'ガチライド',
            'トレーニング',
            'レース出場',
            'オールラウンド'
        ];

        $array_areas = [
            '',
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

        $teams = Team::all();

        $teams->each(function ($query) use ($array_areas,$array_rides) {
                $area_nums = random_int(1,9);
                $ride_nums = random_int(1,6);
                for($i = 1;$i<=$area_nums;$i++){

                    $query->areas()->create([
                        'name'=>$array_areas[$i],
                        'team_id'=>$query->team_id
                    ]);
                }
                for($j = 1;$j<=$ride_nums;$j++){

                    $query->rides()->create([
                        'name'=>$array_rides[$j],
                        'team_id'=>$query->team_id
                    ]);
                }
        });
    }
}
