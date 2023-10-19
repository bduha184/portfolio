<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(1)->create();
        // Article::factory(10)->create();

        for($i=1;$i<=4;$i++){
            \App\Models\User::factory()->create([
                'name' => 'user'.$i,
                'email' => 'test'.$i.'@test.com',
                'password'=> \Hash::make('testtest'),
            ]);

        }

    }
}
