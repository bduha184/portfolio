<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $num = 20;

        for ($i = 1; $i <= $num; $i++) {
            \App\Models\User::factory()
                ->create([
                    'name' => 'user' . $i,
                    'email' => 'test' . $i . '@test.com',
                    'password' => \Hash::make('testtest'),
                ]);
        }

        \App\Models\Profile::factory($num)
            ->hasTeams()
            ->create();

    }
}
