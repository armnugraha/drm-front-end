<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	\DB::table('products')->truncate();

    	\DB::table('products')->insert(array (
            0 => 
            array (
                'name' => 'Indomie Goreng',
            	'barcode' => '082138',
            	'pcs_price' => 2000,
            	'dozen_price' => 53000
            ),
            1 => 
            array (
                'name' => 'Indomie Kuah',
            	'barcode' => '082139',
            	'pcs_price' => 1800,
            	'dozen_price' => 50000
            ),
            2 => 
            array (
                'name' => 'Sedap Kuah',
            	'barcode' => '082140',
            	'pcs_price' => 2200,
            	'dozen_price' => 60000
            ),
            3 => 
            array (
                'name' => 'Sedap Goreng',
            	'barcode' => '082141',
            	'pcs_price' => 1900,
            	'dozen_price' => 52000
            ),
            4 => 
            array (
                'name' => 'Cholotos',
            	'barcode' => '082142',
            	'pcs_price' => 1000,
            	'dozen_price' => 50000
            ),
            5 => 
            array (
                'name' => 'Kopi ABC',
            	'barcode' => '082143',
            	'pcs_price' => 3800,
            	'dozen_price' => 50000
            ),
            6 => 
            array (
                'name' => 'Larutan',
            	'barcode' => '082144',
            	'pcs_price' => 1800,
            	'dozen_price' => 50000
            ),
        ));

    }
}