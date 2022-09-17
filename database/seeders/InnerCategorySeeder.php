<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InnerCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inner_categories')->insert($this->seedInnerCategories());        

    }
    private function seedInnerCategories()
    {
        return $cat = array(
            array('sub_category_id' => '1', 'inner_category_name' => 'AVIAN', 'slug' =>
            'AVIAN', 'status' => 'active'),
            array('sub_category_id' => '1', 'inner_category_name' => 'Ruminants', 'slug' => 'RMT', 'status' => 'active'),
            array('sub_category_id' => '1', 'inner_category_name' => 'Swine', 'slug' =>
            'SWN', 'status' => 'active'),
            array('sub_category_id' => '1', 'inner_category_name' => 'Equine', 'slug' =>
            'EQN', 'status' => 'active'),
            array('sub_category_id' => '1', 'inner_category_name' => 'Pets', 'slug' => 'PETS', 'status' => 'active'),



            array('sub_category_id' => '2', 'inner_category_name' => 'AVIAN', 'slug' =>
            'AVIAN', 'status' => 'active'),
            array('sub_category_id' => '2', 'inner_category_name' => 'Ruminants', 'slug' => 'RMT', 'status' => 'active'),
            array('sub_category_id' => '2', 'inner_category_name' => 'Swine', 'slug' =>
            'SWN', 'status' => 'active'),
            array('sub_category_id' => '2', 'inner_category_name' => 'Equine', 'slug' =>
            'EQN', 'status' => 'active'),
            array('sub_category_id' => '2', 'inner_category_name' => 'Pets', 'slug' => 'PETS', 'status' => 'active'),

            array('sub_category_id' => '4', 'inner_category_name' => 'AVIAN', 'slug' =>
            'AVIAN', 'status' => 'active'),
            array('sub_category_id' => '4', 'inner_category_name' => 'Ruminants', 'slug' => 'RMT', 'status' => 'active'),

            array('sub_category_id' => '5', 'inner_category_name' => 'AVIAN', 'slug' =>
            'AVIAN', 'status' => 'active'),
            array('sub_category_id' => '5', 'inner_category_name' => 'Ruminants', 'slug' => 'RMT', 'status' => 'active'),

            array('sub_category_id' => '8', 'inner_category_name' => 'AVIAN', 'slug' =>
            'AVIAN', 'status' => 'active'),
            array('sub_category_id' => '8', 'inner_category_name' => 'Ruminants', 'slug' => 'RMT', 'status' => 'active'),
        );
    }
}
