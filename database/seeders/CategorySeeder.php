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

        DB::table('categories')->upsert($this->seedCategories(), ['category_name'], ['category_name']);        
    }

    private function seedCategories()
    {
        return $cat = array(
            array('category_name' => 'Veterinary Diagnostics', 'slug' => 'VTD', 'status' => 'active', 'description' => "BioMed’s Veterinary diagnostics section offers a wide range of diagnostics kits such like ELISA, PCR, rapid test kits and any other technics or technologies that can  help in the diagnostics processes of the animal diseases and/or related disease"),
            array('category_name' => 'Human Diagnostic', 'slug' => 'HMD', 'status' => 'active', 'description' => "BioMed’s Human diagnostics section offers a wide range of diagnostics kits and reagents such like ELISA, PCR, rapid test kits and any other technics our technologies that can help in the diagnostic process of the human diseases and/or related diseases"),
            array('category_name' => 'Cell Culture, Cytology & Histology', 'slug' => 'CCH', 'status' => 'active', 'description' => "In this section you will find our wide range of Liquid and Powder Media provides the nutrients for all your cell culture applications. Each of these high-quality Cell Culture Media is manufactured according to the originally published formula, or is further developed and designed to meet highest expectations.
            <br />
            Apart from our Classic Media, such as DMEM or RPMI, we offer various ready-to-use Special Cell Culture Media and Cryopreservation Media. Our Special Media are specifically tailored to an application or cell type."),
            array('category_name' => 'Just Good', 'slug' => 'CCH', 'status' => 'active', 'description' => "In this section you will find our wide range of Liquid and Powder Media provides the nutrients for all your cell culture applications. Each of these high-quality Cell Culture Media is manufactured according to the originally published formula, or is further developed and designed to meet highest expectations.
            <br />
            Apart from our Classic Media, such as DMEM or RPMI, we offer various ready-to-use Special Cell Culture Media and Cryopreservation Media. Our Special Media are specifically tailored to an application or cell type."),
            array('category_name' => 'Josba', 'slug' => 'CCH', 'status' => 'active', 'description' => "In this section you will find our wide range of Liquid and Powder Media provides the nutrients for all your cell culture applications. Each of these high-quality Cell Culture Media is manufactured according to the originally published formula, or is further developed and designed to meet highest expectations.
            <br />
            Apart from our Classic Media, such as DMEM or RPMI, we offer various ready-to-use Special Cell Culture Media and Cryopreservation Media. Our Special Media are specifically tailored to an application or cell type."),
        );
    }
}
