<?php

use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            'name' => "Liquid",
        ]);
        DB::table('product_types')->insert([
            'name' => "Tablet",
        ]);
        DB::table('product_types')->insert([
            'name' => "Capsule",
        ]);
        DB::table('product_types')->insert([
            'name' => "Suppository",
        ]);
        DB::table('product_types')->insert([
            'name' => "Drop",
        ]);
        DB::table('product_types')->insert([
            'name' => "Inhalers",
        ]);
        DB::table('product_types')->insert([
            'name' => "Injection",
        ]);
        DB::table('product_types')->insert([
            'name' => "Implants or patches",
        ]);
    }
}
