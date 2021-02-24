<?php

use Illuminate\Database\Seeder;

class QuestionSubTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_subtypes')->insert([
            'id' => '1',
            'question_type_id' => '1',
            'name' => 'Informação'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '2',
            'question_type_id' => '2',
            'name' => 'Imagens'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '3',
            'question_type_id' => '2',
            'name' => 'Audio / Video'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '4',
            'question_type_id' => '2',
            'name' => 'Categorias'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '5',
            'question_type_id' => '3',
            'name' => 'Mistura'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '6',
            'question_type_id' => '3',
            'name' => 'Palavras em Texto'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '7',
            'question_type_id' => '4',
            'name' => 'Verdadeiro ou Falso'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '8',
            'question_type_id' => '5',
            'name' => 'Questões'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '9',
            'question_type_id' => '5',
            'name' => 'Palavra Intrusa'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '10',
            'question_type_id' => '6',
            'name' => 'Questões Livres'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '11',
            'question_type_id' => '7',
            'name' => 'Diferenças'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '12',
            'question_type_id' => '8',
            'name' => 'Confirmação de Afirmações'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '13',
            'question_type_id' => '9',
            'name' => 'Fronteira da Palavra'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '14',
            'question_type_id' => '10',
            'name' => 'Frases'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '15',
            'question_type_id' => '10',
            'name' => 'Palavras / Excertos'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '16',
            'question_type_id' => '10',
            'name' => 'Imagens'
        ]);
        DB::table('question_subtypes')->insert([
            'id' => '17',
            'question_type_id' => '11',
            'name' => 'Pronúncia'
        ]);
    }
}
