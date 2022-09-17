<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_diseases')->insert($this->seedDiseases());
    }
    private function seedDiseases()
    {
        return $cat = array(
            array('disease_name' => 'Infectious Bronchitis'),
            array('disease_name' =>
            'Infectious Laryngotracheitis'),
            array('disease_name' =>
            'Newcastle disease'),
            array('disease_name' =>
            'Avian Reovirus'),
            array('disease_name' => 'AKABANE'),
            array('disease_name' => 'BESNOITIOSIS'),
            array('disease_name' => 'BESNOITIOSIS'),
            array('disease_name' => 'Bovine Herpes Virus-2'),
            array('disease_name' =>
            'Bovine Herpes Virus-4'),
            array('disease_name' =>
            'Foot and Mouth Disease'),
            array('disease_name' =>
            'Avian Influenza'),
            array('disease_name' =>
            'African Swine Fever'),
            array('disease_name' =>
            'Anaplasma phagocytophilum '),
            array('disease_name' => 'Blue Tongue'),
            array('disease_name' => 'Brucellosis'),
            array('disease_name' => 'Multi diseases'),
            array('disease_name' => 'Avian Flu'),
            array('disease_name' =>
            'PPR'),
            array('disease_name' =>
            'Rift Valley Fever'),
            array('disease_name' =>
            'Diseases free'),
            array('disease_name' => 'Trypanosomiasis'),
        );
    }
}
