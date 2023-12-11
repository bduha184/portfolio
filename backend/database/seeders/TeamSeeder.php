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
            'ポタリングのみ',
            'ポタリングメイン',
            'ロングライド',
            'ガチライド',
            'トレーニング',
            'レース出場',
            'オールラウンド'
        ];

        $array_areas = [
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

        $array_days = [
            '平日',
            '土日',
            '土日祝',
        ];


        $teams = Team::all();

        $teams->each(function ($query) use ($array_areas,$array_rides,$array_days) {
                $area_nums = random_int(0,count($array_areas));
                $ride_nums = random_int(0,count($array_rides));
                $day_nums = random_int(0,count($array_days));
                for($i = 0;$i<$area_nums;$i++){

                    $query->areas()->create([
                        'name'=>$array_areas[$i],
                        'team_id'=>$query->team_id
                    ]);
                }
                for($j = 0;$j<$ride_nums;$j++){

                    $query->rides()->create([
                        'name'=>$array_rides[$j],
                        'team_id'=>$query->team_id
                    ]);
                }
                for($k = 0;$k<$day_nums;$k++){

                    $query->days()->create([
                        'name'=>$array_days[$k],
                        'team_id'=>$query->team_id
                    ]);
                }
        });
    }
}
