<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Team;
class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $profiles = Profile::all();
        $teams = Team::all();

        $i = 0;
        $profiles->each(function ($query) use ($i,$teams) {
            $query->teams()->attach($teams[$i]->id);
            $i++;
        });
    }
}
