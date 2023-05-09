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
        DB::table('nested_sub_categories')->upsert($this->seedInnerCategories(), [
            'name',
        ], ['name']);
    }
    private function seedInnerCategories()
    {
        return $cat = array(
            array('sub_category_id' => '1', 'name' => 'ELISA', 'slug' =>
            'ELISA', 'status' => 'active'),
            array('sub_category_id' => '1', 'name' => 'AGID', 'slug' => 'AGID', 'status' => 'active'),
            array('sub_category_id' => '1', 'name' => 'Cell culture', 'slug' =>
            'CC', 'status' => 'active'),
            array('sub_category_id' => '1', 'name' => 'CFT', 'slug' =>
            'CFT', 'status' => 'active'),
            array('sub_category_id' => '1', 'name' => 'IFAT', 'slug' => 'IFAT', 'status' => 'active'),
            array('sub_category_id' => '1', 'name' => 'PCR', 'slug' => 'PCR', 'status' => 'active'),
            array('sub_category_id' => '1', 'name' => 'Rapid Test', 'slug' => 'RT', 'status' => 'active'),
            array('sub_category_id' => '1', 'name' => 'RSA', 'slug' => 'RSA', 'status' => 'active'),



            // array('sub_category_id' => '2', 'name' => 'AVIAN', 'slug' =>
            // 'AVIAN', 'status' => 'active'),
            // array('sub_category_id' => '2', 'name' => 'Ruminants', 'slug' => 'RMT', 'status' => 'active'),
            // array('sub_category_id' => '2', 'name' => 'Swine', 'slug' =>
            // 'SWN', 'status' => 'active'),
            // array('sub_category_id' => '2', 'name' => 'Equine', 'slug' =>
            // 'EQN', 'status' => 'active'),
            // array('sub_category_id' => '2', 'name' => 'Pets', 'slug' => 'PETS', 'status' => 'active'),

            // array('sub_category_id' => '4', 'name' => 'AVIAN', 'slug' =>
            // 'AVIAN', 'status' => 'active'),
            // array('sub_category_id' => '4', 'name' => 'Ruminants', 'slug' => 'RMT', 'status' => 'active'),

            // array('sub_category_id' => '5', 'name' => 'AVIAN', 'slug' =>
            // 'AVIAN', 'status' => 'active'),
            // array('sub_category_id' => '5', 'name' => 'Ruminants', 'slug' => 'RMT', 'status' => 'active'),

            // array('sub_category_id' => '8', 'name' => 'AVIAN', 'slug' =>
            // 'AVIAN', 'status' => 'active'),
            // array('sub_category_id' => '8', 'name' => 'Ruminants', 'slug' => 'RMT', 'status' => 'active'),
        );
    }
}
