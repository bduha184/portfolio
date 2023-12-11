<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for($i=1;$i<=2;$i++){
            User::factory()
            ->hasProfiles()
            ->hasTeams()
            ->create([
                'name' => 'test'.$i,
                'email' => 'test'.$i.'@test.com',
                'password' => Hash::make('testtest'),
                'password_confirmation' => Hash::make('testtest'),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
