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
         * Add Spaces
         */
        // 初期ユーザー用
        Space::factory(5)->create([
            'user_id' => $admin->id
        ]);

        $admin_space = Space::query()->first();

        // ユーザー全員
        Space::factory($users->count() * 5)->create([
            'user_id' => $users->pluck('id')->random(),
        ]);

        $spaces = Space::query()->get();


        /*
         * Add Ideas
         */
        // 初期ユーザー用
        Idea::factory(5)->create([
            'user_id' => $admin->id,
            'space_id' => $admin_space->pluck('id')->random(),
        ]);

        // ユーザー全員
        Idea::factory($users->count() * 25)->create([
            'user_id' => $users->pluck('id')->random(),
            'space_id' => $spaces->pluck('id')->random(),
        ]);


//        Idea::factory($users->count() * 25)->create([
//            'space_id' => $spaces->pluck('id')->random(),
//            'user_id' => $users->pluck('id')->random()
//        ]);

//        Space::factory()->make([
//            'title' => '新規のアイデア',
//        ])->save();

//        Idea::factory()->make([
//            'title' => 'タイトル',
//        ])->save();
//
//
//        Idea::factory()->make([
//            'title' => 'タイトル',
//        ])->save();
//
//        Idea::factory()->make([
//            'title' => 'タイトル',
//            'parent_id' => 1,
//        ])->save();
    }
}
