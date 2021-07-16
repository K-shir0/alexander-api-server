<?php

namespace Database\Seeders;

use App\Idea;
use App\Models\Space;
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
        /*
         * Add Users
         */
        User::factory()->make([
            'first_name' => 'アドミン',
            'last_name' => 'アドミン',
            'email' => 'laravel-a@example.com',
            'password' => Hash::make('password'),
        ])->save();

        // 初期ユーザー
        $admin = User::query()->first();

        User::factory()->count(5)->create([
            'password' => Hash::make('password'),
        ]);

        // ユーザー全員
        $users = User::query()->get();


        /*
         * Add Spaces & Ideas
         */

        // 初期ユーザー用
        Space::factory()
            ->has(Idea::factory()->count(5))
            ->create(['user_id' => $admin->id]);

        // ユーザー全員
        Space::factory()
            ->has(Idea::factory()->count(5))
            ->count(($users->count() - 1) * 5)
            ->create();
    }
}
