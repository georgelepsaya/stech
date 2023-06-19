<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ::factory(10)->create();

        User::factory()->create([
            'name' => 'test',
            'email' => 'test@inbox.lv',
            'password' => bcrypt('qwer1234')
        ]);
        User::factory()->create([
            'name' => 'Joe',
            'email' => 'joe@gmail.com',
            'password' => bcrypt('pass1234')
        ]);
    }
}
