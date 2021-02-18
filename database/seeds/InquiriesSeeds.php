<?php

use Illuminate\Database\Seeder;

class InquiriesSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inquiries')->insert([
            'id' => '1',
            'question' => 'Antes de começar a ouvir, estabeleço a forma como vou ouvir.',
            'order' => '1'
        ]);
        DB::table('inquiries')->insert([
            'id' => '2',
            'question' => 'Penso que ouvir é mais difícil do que ler, falar ou escrever em Português.',
            'order' => '2'
        ]);
        DB::table('inquiries')->insert([
            'id' => '3',
            'question' => 'Traduzo para mim enquanto ouço.',
            'order' => '3'
        ]);
        DB::table('inquiries')->insert([
            'id' => '4',
            'question' => 'Sou capaz de me concentrar facilmente.',
            'order' => '4'
        ]);
        DB::table('inquiries')->insert([
            'id' => '5',
            'question' => 'Uso as palavras que compreendo para tentar compreender o significado das palavras que não compreendo.',
            'order' => '5'
        ]);
        DB::table('inquiries')->insert([
            'id' => '6',
            'question' => 'Uso a minha experiência e conhecimento para me ajudarem a compreender.',
            'order' => '6'
        ]);
        DB::table('inquiries')->insert([
            'id' => '7',
            'question' => 'Antes de ouvir, penso em textos semelhantes que já ouvi.',
            'order' => '7'
        ]);
        DB::table('inquiries')->insert([
            'id' => '8',
            'question' => 'Tento voltar atrás no que estou a ouvir, quando perco a concentração.',
            'order' => '8'
        ]);
        DB::table('inquiries')->insert([
            'id' => '9',
            'question' => 'Quando estou a ouvir, procuro adaptar a forma como estou a interpretar o que ouço, se vejo que não é a mais correta.',
            'order' => '9'
        ]);
        DB::table('inquiries')->insert([
            'id' => '10',
            'question' => 'Depois de ouvir, penso no que ouvi e em como posso ouvir de forma diferente na próxima vez.',
            'order' => '10'
        ]);
        DB::table('inquiries')->insert([
            'id' => '11',
            'question' => 'Não fico nervoso quando ouço em Português.',
            'order' => '11'
        ]);
        DB::table('inquiries')->insert([
            'id' => '12',
            'question' => 'Quando tenho dificuldade em compreender o que ouço, desisto e paro de ouvir.',
            'order' => '12'
        ]);
        DB::table('inquiries')->insert([
            'id' => '13',
            'question' => 'Uso a ideia geral do texto para me ajudar a adivinhar o significado das palavras que não compreendo.',
            'order' => '13'
        ]);
        DB::table('inquiries')->insert([
            'id' => '14',
            'question' => 'Quando compreendo o significado de uma palavra, penso no que ouvi anteriormente, para perceber se estou correto.',
            'order' => '14'
        ]);
        DB::table('inquiries')->insert([
            'id' => '15',
            'question' => 'Qual o nível de Ansiedade que teve ao fazer os Exercícios?',
            'order' => '999'
        ]);
    }
}
