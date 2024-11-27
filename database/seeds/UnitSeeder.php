<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            'name' => "mg",
        ]);
        DB::table('units')->insert([
            'name' => "g",
        ]);
        DB::table('units')->insert([
            'name' => "kg",
        ]);
        DB::table('units')->insert([
            'name' => "ml",
        ]);
        DB::table('units')->insert([
            'name' => "l",
        ]);
    }
}
