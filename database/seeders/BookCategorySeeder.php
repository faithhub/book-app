<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_categories')->delete();

        DB::table('book_categories')->insert([
            [
                'name' => 'Business & Commercial Law ',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Investments & Security',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Civil procedure',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Criminal procedure',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Legal Method & Legal Systems',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Constitutional & Administrative law',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Torts & Trust & Equity',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Jurisprudence & Conflicts of Law',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Family and private law',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            [
                'name' => 'Others',
                'status' => 'Active',
                'role' => 'Vendor',
            ],
            // [
            //     'name' => 'Laws',
            //     'status' => 'Active',
            //     'role' => 'Admin',
            // ],
        ]);
    }
}
