<?php

use Illuminate\Database\Seeder;

class ExerciseCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercise_categories')->insert([
            'id' => '1',
            'name' => 'Gramática'
        ]);
        DB::table('exercise_categories')->insert([
            'id' => '2',
            'name' => 'Ciência'
        ]);
        DB::table('exercise_categories')->insert([
            'id' => '3',
            'name' => 'Geografia'
        ]);
        DB::table('exercise_categories')->insert([
            'id' => '4',
            'name' => 'Sintax'
        ]);
    }
}
