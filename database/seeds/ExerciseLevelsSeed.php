<?php

use Illuminate\Database\Seeder;

class ExerciseLevelsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercise_level')->insert([
            'id' => '1',
            'name' => 'A1'
        ]);
        DB::table('exercise_level')->insert([
            'id' => '2',
            'name' => 'A2'
        ]);
        DB::table('exercise_level')->insert([
            'id' => '3',
            'name' => 'A3'
        ]);
        DB::table('exercise_level')->insert([
            'id' => '4',
            'name' => 'B1'
        ]);
        DB::table('exercise_level')->insert([
            'id' => '5',
            'name' => 'B2'
        ]);
        DB::table('exercise_level')->insert([
            'id' => '6',
            'name' => 'B3'
        ]);
    }
}
