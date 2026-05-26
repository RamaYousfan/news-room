<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        Role::firstOrCreate([
            'name' => 'admin'
        ]);

        Role::firstOrCreate([
            'name' => 'writer'
        ]);

        Role::firstOrCreate([
            'name' => 'reader'
        ]);


        $admin = User::factory()->create([

            'name' => 'Admin User',

            'email' => 'admin@test.com',

        ]);

        $admin->assignRole(
            'admin'
        );


        $writer = User::factory()->create([

            'name' => 'Writer User',

            'email' => 'writer@test.com',

        ]);

        $writer->assignRole(
            'writer'
        );


        User::factory(5)

            ->create()

            ->each(

                fn($user)

                =>

                $user->assignRole(
                    'reader'
                )

            );

    }
}