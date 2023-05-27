<?php

namespace Database\Seeders;

use App\Models\Role;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'keterangan' => 'Administrator'
        ]);

        Role::create([
            'name' => 'user',
            'keterangan' => 'User'
        ]);

        \App\Models\User::factory(3)->create();
    }
}
