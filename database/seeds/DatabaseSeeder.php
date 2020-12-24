<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'user_level' => 1,
            'password' => Hash::make('admin'),
            'firstname' => 'admin',
            'lastname' => 'admin',
            'birthdate' => '1997/12/15',
            'gender' => 'male',
            'address' => 'address',
            'spec' => 'spec',
            'city' => 'city',
            'postal_code' => 'postal_code',
            'phone' => 'phone',
            'bio' => 'bio',
            'status' => 'status',
        ]);
    }
}

