<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => "Square Pharmaceuticals Ltd",
        ]);
        DB::table('brands')->insert([
            'name' => "Opsonin Pharmaceuticals Ltd",
        ]);
        DB::table('brands')->insert([
            'name' => "Incepta Pharmaceuticals Ltd",
        ]);
        DB::table('brands')->insert([
            'name' => "Aristopharma Ltd",
        ]);
        DB::table('brands')->insert([
            'name' => "Beximco Pharmaceuticals Ltd",
        ]);
        DB::table('brands')->insert([
            'name' => "Healthcare  Pharmaceuticals Ltd",
        ]);
        DB::table('brands')->insert([
            'name' => "Healthcare  Pharmaceuticals Ltd",
        ]);
        DB::table('brands')->insert([
            'name' => "ACME Laboratories Ltd",
        ]);
        DB::table('brands')->insert([
            'name' => "Renata Limited",
        ]);
        DB::table('brands')->insert([
            'name' => "Eskayef Bangladesh Ltd",
        ]);
        DB::table('brands')->insert([
            'name' => "ACI Ltd",
        ]);
    }
}
