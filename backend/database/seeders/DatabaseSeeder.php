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
          // AreasSeeder::class,
        UserSeeder::class,
        // ProfileSeeder::class,
        TeamSeeder::class,
    ]);

    }
}
