<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->text('text');
			$table->integer('article_category_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}