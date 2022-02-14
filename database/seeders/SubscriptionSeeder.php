<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('subscriptions')->truncate();
        DB::table('subscriptions')->insert([
            [
                'name' => 'Single User',
                'weekly' => 599,
                'monthly' => 1250,
                'quarterly' => 2250,
                'annually' => 7000,
            ],
            [
                'name' => 'Group Users (5)',
                'weekly' => null,
                'monthly' => 7550,
                'quarterly' => 13250,
                'annually' => 33000,
            ],
            [
                'name' => 'Group Users (10)',
                'weekly' => null,
                'monthly' => null,
                'quarterly' => null,
                'annually' => 65000,
            ]
        ]);
    }
}
