<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Ali",
            'email' => 'alaa@gmail.com',
            'age'=>35,
            'role_id' => 1,
            'password' => Hash::make('23456789'),
            'code' => 1111,
            'StatusCode'=>true
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'age' => 3967,
        //     'role_id' => 2,
        //     'password' => Hash::make('23456789'),
        //     'StatusCode' => true
        // ]);
    }
}
