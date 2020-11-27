<?php

use Illuminate\Database\Seeder;

class ArticleCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_categories')->insert([
            'id' => '1',
            'name' => 'Gramática'
        ]);
        DB::table('article_categories')->insert([
            'id' => '2',
            'name' => 'Ciência'
        ]);
        DB::table('article_categories')->insert([
            'id' => '3',
            'name' => 'Geografia'
        ]);
        DB::table('article_categories')->insert([
            'id' => '4',
            'name' => 'Sintax'
        ]);
    }
}
