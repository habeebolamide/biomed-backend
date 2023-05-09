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
        DB::table('sub_categories')->upsert($this->seedSubCategories(), [
            'name' 
        ], ['name']);        

    }

    private function seedSubCategories()
    {
        return $sub_cat = array(
            array('category_id' => '1','name' => 'AVIAN','slug' => 'AVIAN',
                    'description' => 'We offer large range of diagnostic tests kits for major notifiable poultry diseases from
                    Elisa, PCR to Rapid Test kits.',
                    'status' => 'active'
            ),
            array('category_id' => '1','name' => 'Ruminants','slug' => 'RMT',
                    'description' => 'We offer large range of diagnostic tests kits for major notifiable diseases of ruminant
                    from Elisa, PCR to Rapid Test kits.',
                    'status' => 'active'
             ),
            array('category_id' => '1','name' => 'Swine','slug' => 'SWN',
             'description' => 'We offer diagnostic tests kits for major notifiable diseases of swine such as Aujeszky’s
                Disease, Classical Swine Fever, and Foot and Mouth Disease, diseases impacting
                swine production such as PRRS and Mycoplasma hyopneumoniae, as well as emerging
                diseases of concern, such as
                African Swine Fever.',
             'status' => 'active'
            ),
            array('category_id' => '1','name' => 'Equine','slug' => 'EQN',
            'description' => 'We offer various diagnostic tests kit for important equine infectious diseases, such as
            Equine Infectious Anemia (EIA), as well as emerging diseases of concern, such as
            Glanders.',
            'status' => 'active'
           ),
            
            //
            // array('category_id' => '1', 'sub_category_name' => 'PCR Kits', 'slug' =>
            // 'PCK', 'status' => 'active'),
            // array('category_id' => '1', 'sub_category_name' => 'Sera', 'slug' => 'SERA', 'status' => 'active'),
            // array('category_id' => '1', 'sub_category_name' => 'Positive control', 'slug' =>
            // 'PCS', 'status' => 'active'),
            // array('category_id' => '1', 'sub_category_name' => 'Negative control', 'slug' =>
            // 'NGC', 'status' => 'active'),
            // array('category_id' => '1', 'sub_category_name' => 'Research Sera', 'slug' =>
            // 'RSS', 'status' => 'active'),
            // array('category_id' => '1', 'sub_category_name' => 'Antigens', 'slug' =>
            // 'ANT', 'status' => 'active'),
            // array('category_id' => '1', 'sub_category_name' => 'Rapid test Kit', 'slug' => 'RTK',
            // 'status' => 'active'),
            // array('category_id' => '1', 'sub_category_name' => 'Microbiology', 'slug' =>
            // 'MBIO', 'status' => 'active'),
            // array('category_id' => '1', 'sub_category_name' => 'Research', 'slug' =>
            // 'RSH', 'status' => 'active'),


            // array('category_id' => '2', 'sub_category_name' => 'ELISA KITS', 'slug' => 'ELK', 'status' => 'active'),
            // array('category_id' => '2', 'sub_category_name' => 'Rapid test Kits', 'slug' =>
            // 'RTK', 'status' => 'active'),
            // array('category_id' => '2', 'sub_category_name' => 'IFA Kits', 'slug' =>
            // 'IFA', 'status' => 'active'),
            // array('category_id' => '2', 'sub_category_name' => 'Food Safety Testing', 'slug' =>
            // 'FST', 'status' => 'active'),
            // array('category_id' => '2', 'sub_category_name' => 'PCR Reagents', 'slug' => 'PCR', 'status' => 'active'),
        );
    }
}
