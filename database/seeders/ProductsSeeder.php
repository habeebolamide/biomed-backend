<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert($this->seedProducts());
    }
    private function seedProducts()
    {
        return $cat = array(
            array('sub_category_id' => '1', 'inner_category_name' => 'AVIAN', 'slug' =>
            'AVIAN', 'status' => 'active'),
        );
    }
}
