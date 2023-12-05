<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Tag;
use App\Models\Area;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $array_tags = [
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

        $teams->each(function ($query) use ($array_areas,$array_tags) {
                $area_nums = random_int(1,9);
                $tag_nums = random_int(1,6);
                for($i = 1;$i<=$area_nums;$i++){

                    $query->areas()->create([
                        'name'=>$array_areas[$i],
                        'team_id'=>$query->team_id
                    ]);
                }
                for($j = 1;$j<=$tag_nums;$j++){

                    $query->tags()->create([
                        'name'=>$array_tags[$j],
                        'team_id'=>$query->team_id
                    ]);
                }
        });
    }
}
