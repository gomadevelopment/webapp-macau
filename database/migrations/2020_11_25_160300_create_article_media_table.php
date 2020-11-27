<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleMediaTable extends Migration {

	public function up()
	{
		Schema::create('article_media', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->string('media_url', 255);
			$table->string('media_type')->nullable();
			$table->tinyInteger('poster')->default('0');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('article_media');
	}
}