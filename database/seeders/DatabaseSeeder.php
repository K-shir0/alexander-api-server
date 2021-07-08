<?php

namespace Database\Seeders;

use App\Idea;
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
            'first_name' => 'アドミン',
            'last_name' => 'アドミン',
            'email' => 'laravel-a@example.com',
            'password' => Hash::make('password'),
        ])->save();

        Idea::factory()->make([
            'title' => 'タイトル',
        ])->save();


        Idea::factory()->make([
            'title' => 'タイトル',
        ])->save();

        Idea::factory()->make([
            'title' => 'タイトル',
            'parent_id' => 1,
        ])->save();
    }
}
