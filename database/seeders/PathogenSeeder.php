<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PathogenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pathogens')->upsert($this->seedPathogens(), [
            'name' 
        ], ['name']);        

    }
    private function seedPathogens()
    {
        return $pathogen = array(
            array('nested_sub_category_id' => '1','name' => 'Avian
                    Enceph alomyel itis Virus ','slug' => 'AEV',
                    'status' => 'active'
            ),
            array('nested_sub_category_id' => '1','name' => 'Avian Leukosis Virus','slug' => 'AEV',
            'status' => 'active'
           ),
            array('nested_sub_category_id' => '6','name' => 'Infectious Bronchitis Virus','slug' => 'IBV',
            'status' => 'active'
            ),
            
        );
    }
}
