<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->make([
            'name' => 'アドミン',
            'email' => 'laravel-a@example.com',
            'password' => Hash::make('password'),
        ])->save();
    }
}
