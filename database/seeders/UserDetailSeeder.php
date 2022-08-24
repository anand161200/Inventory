<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'firstName' => 'admin',
            'lastName' => 'admin',
            'address' => 'Gujrat',
            'Gender' => 'M',
            'email' => 'admin@gmail.com',
            'phoneNumber' => '9904644459',
            'password' => bcrypt('admin@123'),
            'role' => 'admin',
        ]);

        User::create([
            'firstName' => 'user',
            'lastName' => 'user',
            'address' => 'Gujrat',
            'Gender' => 'M',
            'email' => 'user@gmail.com',
            'phoneNumber' => '9904644459',
            'password' => bcrypt('user@123'),
            'role' => 'user',
        ]);
    }
}
