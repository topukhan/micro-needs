<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'guest@gmail.com'],
            [
                'name' => 'Guest User',
                'password' => Hash::make('12345678'),
            ]
        );
        // add more 20 users
        User::factory()->count(20)->create();
    }
}
