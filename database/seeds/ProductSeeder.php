<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds. php artisan db:seed --class=ProductSeeder
     *
     * @return void
     */
    public function run()
    {
        $faker = new Faker();
        DB::table('products')->insert([
            'name' => "Ace Plus",
            'upc' => "00001",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 1,
            'unit_id' => 1,
            'weight' =>  500,
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Alacot ",
            'upc' => "00002",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 2,
            'unit_id' => 1,
            'weight' =>  50,
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Cinaron plus",
            'upc' => "00003",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' =>2,
            'unit_id' => 1,
            'weight' =>  100,
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Losectil",
            'upc' => "00004",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 3,
            'unit_id' => 1,
            'weight' =>  20,
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Pentonix",
            'upc' => "00005",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 4,
            'unit_id' => 1,
            'weight' =>  20,
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Bizoran",
            'upc' => "00006",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 2,
            'unit_id' => 1,
            'weight' =>  "5/20",
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Napa",
            'upc' => "00007",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 5,
            'unit_id' => 1,
            'weight' =>  "500",
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Napa Extra",
            'upc' => "00008",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 6,
            'unit_id' => 1,
            'weight' =>  "500",
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Tusca 250ml",
            'upc' => "00009",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 6,
            'unit_id' => 4,
            'weight' =>  "250",
            'product_type_id' => 1,
        ]);
        DB::table('products')->insert([
            'name' => "Tusca",
            'upc' => "00010",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' =>7,
            'unit_id' => 4,
            'weight' =>  "500",
            'product_type_id' => 1,
        ]);
        DB::table('products')->insert([
            'name' => "Betnovet",
            'upc' => "00011",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' =>8,
            'unit_id' => 2,
            'weight' =>  "50",
            'product_type_id' => 1,
        ]);
        DB::table('products')->insert([
            'name' => "Betnovet",
            'upc' => "00012",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' =>9,
            'unit_id' => 2,
            'weight' =>  "200",
            'product_type_id' => 1,
        ]);
        DB::table('products')->insert([
            'name' => "Pavison ",
            'upc' => "00013",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 10,
            'unit_id' => 1,
            'weight' =>  "200",
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Normanal",
            'upc' => "00014",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 9,
             'unit_id' => 1,
            'weight' =>  "100",
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Traxyl",
            'upc' => "00015",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 5,
            'unit_id' => 1,
            'weight' =>  10,
            'product_type_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => "Virux",
            'upc' => "00015",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' => 7,
            'unit_id' => 1,
            'weight' =>  200,
            'product_type_id' =>2,
        ]);
        DB::table('products')->insert([
            'name' => "Virux",
            'upc' => "00015",
            'low_stock_amount' => 100,
            'description' => 'Test Description',
            'brand_id' =>8,
            'unit_id' => 1,
            'weight' =>  400,
            'product_type_id' => 2,
        ]);
    }
}
