<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check = DB::table('admins')->where('username', 'admin')->first();
        if(!isset($check)){
            DB::table('admins')->insert([
                [
                    'name' => 'Admin Admin',
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'mobile' => '09078354678',
                    'dob' => '2021-12-30',
                    'gender' => 'Male',
                    'password' => Hash::make('Admin@123'),
                ]
            ]);
        }
    }
}
