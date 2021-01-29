<?php

use Illuminate\Database\Seeder;

class QuestionTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->insert([
            'id' => '1',
            'name' => 'Informação'
        ]);
        DB::table('question_types')->insert([
            'id' => '2',
            'name' => 'Correspondência'
        ]);
        DB::table('question_types')->insert([
            'id' => '3',
            'name' => 'Preenchimento'
        ]);
        DB::table('question_types')->insert([
            'id' => '4',
            'name' => 'Verdadeiro ou Falso'
        ]);
        DB::table('question_types')->insert([
            'id' => '5',
            'name' => 'Escolha Múltipla'
        ]);
        DB::table('question_types')->insert([
            'id' => '6',
            'name' => 'Questões Livres'
        ]);
        DB::table('question_types')->insert([
            'id' => '7',
            'name' => 'Diferenças'
        ]);
        DB::table('question_types')->insert([
            'id' => '8',
            'name' => 'Correção de Afirmações'
        ]);
        DB::table('question_types')->insert([
            'id' => '9',
            'name' => 'Conteúdo gerado automaticamente'
        ]);
        DB::table('question_types')->insert([
            'id' => '10',
            'name' => 'Ordenação'
        ]);
        DB::table('question_types')->insert([
            'id' => '11',
            'name' => 'Vogais'
        ]);
    }
}
