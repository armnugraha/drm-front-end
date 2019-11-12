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
        ));

    }
}