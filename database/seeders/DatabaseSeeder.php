<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WaitingList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $sources = ['linkedIn', 'telegram', 'instagram', 'youtube', 'facebook'];

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@tenamart.et',
            'password' => Hash::make('password'),
        ]);

        for ($i = 1; $i <= 40; $i++) {
            WaitingList::create([
                'pharmacy' => 'Pharmacy ' . $i,
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'phone' => '09' . rand(10000000, 99999999),
                'signup_source' => $sources[array_rand($sources)],
                'created_at' => Carbon::now()->subDays(rand(0, 60)),
                'updated_at' => now(),
            ]);
        }
    }
}
