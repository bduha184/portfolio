<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\Area;
use App\Models\Team;
class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Profile::factory(2)
        ->hasTeams()
        ->create();

    }
}
