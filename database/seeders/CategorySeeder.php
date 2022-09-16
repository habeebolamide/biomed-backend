<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert($this->seedCategories());        
    }

    private function seedCategories()
    {
        return $cat = array(
            array('category_name' => 'Veterinary Diagnostics', 'slug' => 'VTD', 'status' => 'active'),
            array('category_name' => 'Human Diagnostic', 'slug' => 'HMD', 'status' => 'active'),
            array('category_name' => 'Cell Culture, Cytology & Histology', 'slug' => 'CCH', 'status' => 'active'),
        );
    }
}
