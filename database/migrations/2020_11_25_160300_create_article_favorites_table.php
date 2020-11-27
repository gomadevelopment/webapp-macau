<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleFavoritesTable extends Migration {

	public function up()
	{
		Schema::create('article_favorites', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('article_favorites');
	}
}