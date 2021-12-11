<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_materials')->delete();

        DB::table('book_materials')->insert([
            
            [
                'name' => 'Textbooks',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Law Reports',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Journals',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Articles',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Videos',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
        ]);
    }
}
