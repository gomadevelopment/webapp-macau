<?php

use Illuminate\Database\Seeder;

class TagsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'id' => '1',
            'name' => 'Ciência'
        ]);
        DB::table('tags')->insert([
            'id' => '2',
            'name' => 'Tecnologia'
        ]);
        DB::table('tags')->insert([
            'id' => '3',
            'name' => 'Natureza'
        ]);
        DB::table('tags')->insert([
            'id' => '4',
            'name' => 'Sintax'
        ]);
        DB::table('tags')->insert([
            'id' => '5',
            'name' => 'Geografia'
        ]);
        DB::table('tags')->insert([
            'id' => '6',
            'name' => 'Desporto'
        ]);
    }
}
