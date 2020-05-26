<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Angel Pineda',
            'email' => 'a@gmail.com',
            'birth_date' => '08-09-08',
            'gender' => 'Male',
            'house_number' => NULL,
            'barangay' => NULL,
            'contact_no' => '09353328974',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);


    }
}
