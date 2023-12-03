<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call([
        // TagsSeeder::class,
        // AreasSeeder::class,
        ProfileSeeder::class,
        TagsSeeder::class,
    ]);

    }
}
