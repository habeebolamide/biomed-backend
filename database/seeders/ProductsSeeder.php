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
        DB::select('INSERT INTO product_quantities (product_id, quantity) SELECT id, 50 FROM products');
    }
    private function seedProducts()
    {
        return $cat = array(
            array('nested_sub_category_id' => '1', 'product_disease_id' => '1', 'product_name' =>
            'ID Screen® Infectious Bronchitis Competition', 'price' => '120', 'product_slug' => 'IIB', 'code' => 'VDEA01', 'description' => 'https://www.id-vet.com/produit/id-screen-infectious-bronchitis-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '10'),
            array('nested_sub_category_id' => '1', 'product_disease_id' => '1', 'product_name' =>
            'ID Screen® Infectious Bronchitis Indirect', 'price' => '150', 'product_slug' => 'IBI', 'code' => 'VDEA02', 'description' => 'https://www.id-vet.com/produit/id-screen-infectious-bronchitis-indirect/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '10'),
            array('nested_sub_category_id' => '1', 'product_disease_id' => '2', 'product_name' =>
            'ID Screen® ILT gB Indirect', 'price' => '180', 'product_slug' => 'ILTGBI', 'code' => 'VDEA03', 'description' => 'https://www.id-vet.com/produit/id-screen-ilt-gb-indirect/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '5'),
            array('nested_sub_category_id' => '1', 'product_disease_id' => '2', 'product_name' =>
            'ID Screen® ILT gI Indirect', 'price' => '280', 'product_slug' => 'ILTGII', 'code' => 'VDEA04', 'description' => 'https://www.id-vet.com/produit/id-screen-ilt-gi-indirect/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '2'),
            array('nested_sub_category_id' => '1', 'product_disease_id' => '2', 'product_name' =>
            'ID Screen® ILT Indirect', 'price' => '80', 'product_slug' => 'ILTI', 'code' => 'VDEA05', 'description' => 'https://www.id-vet.com/produit/id-screen-ilt-indirect/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '5'),
            array('nested_sub_category_id' => '1', 'product_disease_id' => '3', 'product_name' =>
            'ID Screen® Newcastle Disease Competition', 'price' => '45', 'product_slug' => 'NDC', 'code' => 'VDEA06', 'description' => 'https://www.id-vet.com/produit/id-screen-newcastle-disease-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '5'),
            array('nested_sub_category_id' => '1', 'product_disease_id' => '3', 'product_name' =>
            'ID Screen® Newcastle Disease Indirect', 'price' => '145', 'product_slug' => 'NDI', 'code' => 'VDEA07', 'description' => 'https://www.id-vet.com/produit/id-screen-newcastle-disease-indirect/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '10'),
            array('nested_sub_category_id' => '1', 'product_disease_id' => '3', 'product_name' =>
            'ID Screen® Newcastle Disease Indirect Conventional Vaccines', 'price' => '195', 'product_slug' => 'NDICV', 'code' => 'VDEA08', 'description' => 'https://www.id-vet.com/produit/id-screen-newcastle-disease-indirect-conventional-vaccines/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '1', 'product_disease_id' => '3', 'product_name' =>
            'ID Screen® Newcastle Disease Nucleoprotein Indirect', 'price' => '135', 'product_slug' => 'NDNI', 'code' => 'VDEA09', 'description' => 'https://www.id-vet.com/produit/id-screen-newcastle-disease-nucleoprotein-indirect/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '1', 'product_disease_id' => '4', 'product_name' =>
            'ID Screen® Avian Reovirus Indirect', 'price' => '198', 'product_slug' => 'ARI', 'code' => 'VDEA09', 'description' => 'https://www.id-vet.com/produit/id-screen-avian-reovirus-indirect/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),

            array('nested_sub_category_id' => '2', 'product_disease_id' => '5', 'product_name' =>
            'ID Screen® Akabane Competition', 'price' => '28', 'product_slug' => 'SAC', 'code' => 'VDER01', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '2', 'product_disease_id' => '6', 'product_name' =>
            'ID Screen® Besnoitia Indirect 2.0', 'price' => '38', 'product_slug' => 'SBI', 'code' => 'VDER02', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '2', 'product_disease_id' => '6', 'product_name' =>
            'ID Screen® Besnoitia Milk Indirect', 'price' => '30', 'product_slug' => 'BMI', 'code' => 'VDER03', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '2', 'product_disease_id' => '7', 'product_name' =>
            'ID Screen® BHV-2 Indirect', 'price' => '30', 'product_slug' => 'BHV', 'code' => 'VDER04', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '2', 'product_disease_id' => '9', 'product_name' =>
            'ID Screen® FMD NSP Competition', 'price' => '80', 'product_slug' => 'NSP', 'code' => 'VDER06', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '2', 'product_disease_id' => '9', 'product_name' =>
            'ID Screen® FMD Type O Competition', 'price' => '180', 'product_slug' => 'TPOC', 'code' => 'VDER08', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),

            array('nested_sub_category_id' => '6', 'product_disease_id' => '10', 'product_name' =>
                'ID Gene™ Infectious Bronchitis Duplex', 'price' => '280', 'product_slug' => 'IBD', 'code' => 'VDPA01', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '6', 'product_disease_id' => '11', 'product_name' =>
            'ID Gene™ Influenza H5/H7 Triplex – Export version', 'price' => '30', 'product_slug' => 'IFT', 'code' => 'VDPA02', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '6', 'product_disease_id' => '11', 'product_name' =>
            'ID Gene™ Influenza H9 Lineage G1-like Duplex', 'price' => '25', 'product_slug' => 'IHL', 'code' => 'VDPA04', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),


            array('nested_sub_category_id' => '7', 'product_disease_id' => '12', 'product_name' =>
            'ID Gene™ African Swine Fever Duplex', 'price' => '85', 'product_slug' => 'ASFD', 'code' => 'VDPR01', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '30'),
            array('nested_sub_category_id' => '7', 'product_disease_id' => '13', 'product_name' =>
            'ID Gene™ Anaplasma phagocytophilum Duplex', 'price' => '875', 'product_slug' => 'APD', 'code' => 'VDPR02', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),
            array('nested_sub_category_id' => '7', 'product_disease_id' => '14', 'product_name' =>
            'ID Gene™ BlueTongue Duplex', 'price' => '472', 'product_slug' => 'BTD', 'code' => 'VDPR03', 'description' => 'https://www.id-vet.com/produit/id-screen-akabane-competition/', 'is_variant' => 'no', 'status' => 'active', 'discount' => '20'),

        );
    }
}
