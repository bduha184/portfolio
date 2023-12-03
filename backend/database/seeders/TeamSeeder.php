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
        $tags = Tag::all();
        $areas = Area::all();

        // factory(Team::class,2)
        // ->create()
        // ->each(function (Team $team) use ($tags,$areas) {
        //     $tag_rand = rand(0,6);
        //     $area_rand = rand(0,9);

        //     $team->tags()->attach(
        //         $tags->random($tag_rand)->pluck('id')->toArray()
        //     );
        //     $team->areas()->attach(
        //         $areas->random($area_rand)->pluck('id')->toArray()
        //     );

        // });

    }
}
