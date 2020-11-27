<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{

		Schema::table('articles', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('articles', function(Blueprint $table) {
			$table->foreign('article_category_id')->references('id')->on('article_categories')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('article_media', function(Blueprint $table) {
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('articles_tags', function(Blueprint $table) {
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('articles_tags', function(Blueprint $table) {
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('article_favorites', function(Blueprint $table) {
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('article_favorites', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('articles', function(Blueprint $table) {
			$table->dropForeign('articles_user_id_foreign');
		});
		Schema::table('articles', function(Blueprint $table) {
			$table->dropForeign('articles_article_category_id_foreign');
		});
		Schema::table('article_media', function(Blueprint $table) {
			$table->dropForeign('article_media_article_id_foreign');
		});
		Schema::table('articles_tags', function(Blueprint $table) {
			$table->dropForeign('articles_tags_article_id_foreign');
		});
		Schema::table('articles_tags', function(Blueprint $table) {
			$table->dropForeign('articles_tags_tag_id_foreign');
		});
		Schema::table('article_favorites', function(Blueprint $table) {
			$table->dropForeign('article_favorites_article_id_foreign');
		});
		Schema::table('article_favorites', function(Blueprint $table) {
			$table->dropForeign('article_favorites_user_id_foreign');
		});
	}
}