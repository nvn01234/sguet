<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::insert([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'remember_token' => str_random(10)
        ]);
    }
}
