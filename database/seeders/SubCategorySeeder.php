<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert($this->seedSubCategories());        

    }

    private function seedSubCategories()
    {
        return $cat = array(
            array('category_id' => '1','sub_category_name' => 'ELISA Kits', 'slug' => 'ELK', 'status' => 'active'),
            array('category_id' => '1', 'sub_category_name' => 'PCR Kits', 'slug' =>
            'PCK', 'status' => 'active'),
            array('category_id' => '1', 'sub_category_name' => 'Sera', 'slug' => 'SERA', 'status' => 'active'),
            array('category_id' => '1', 'sub_category_name' => 'Positive control', 'slug' =>
            'PCS', 'status' => 'active'),
            array('category_id' => '1', 'sub_category_name' => 'Negative control', 'slug' =>
            'NGC', 'status' => 'active'),
            array('category_id' => '1', 'sub_category_name' => 'Research Sera', 'slug' =>
            'RSS', 'status' => 'active'),
            array('category_id' => '1', 'sub_category_name' => 'Antigens', 'slug' =>
            'ANT', 'status' => 'active'),
            array('category_id' => '1', 'sub_category_name' => 'Rapid test Kit', 'slug' => 'RTK',
            'status' => 'active'),
            array('category_id' => '1', 'sub_category_name' => 'Microbiology', 'slug' =>
            'MBIO', 'status' => 'active'),
            array('category_id' => '1', 'sub_category_name' => 'Research', 'slug' =>
            'RSH', 'status' => 'active'),


            array('category_id' => '2', 'sub_category_name' => 'ELISA KITS', 'slug' => 'ELK', 'status' => 'active'),
            array('category_id' => '2', 'sub_category_name' => 'Rapid test Kits', 'slug' =>
            'RTK', 'status' => 'active'),
            array('category_id' => '2', 'sub_category_name' => 'IFA Kits', 'slug' =>
            'IFA', 'status' => 'active'),
            array('category_id' => '2', 'sub_category_name' => 'Food Safety Testing', 'slug' =>
            'FST', 'status' => 'active'),
            array('category_id' => '2', 'sub_category_name' => 'PCR Reagents', 'slug' => 'PCR', 'status' => 'active'),
        );
    }
}
