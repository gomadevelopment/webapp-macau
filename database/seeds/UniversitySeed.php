<?php

use Illuminate\Database\Seeder;

class UniversitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universities')->insert([
            'id' => '1',
            'name' => 'University of Saint Joseph'
        ]);
        DB::table('universities')->insert([
            'id' => '2',
            'name' => 'University of Évora'
        ]);
        DB::table('universities')->insert([
            'id' => '3',
            'name' => 'University of GOMA'
        ]);
    }
}
