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

        $i = count($teams)-1;
        $profiles->each(function ($query) use ($i,$teams) {
            $query->teams()->attach($teams[random_int(0,$i)]->id);
        });
    }
}
