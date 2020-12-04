<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{

		Schema::table('chats', function(Blueprint $table) {
			$table->foreign('user_1_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('chats', function(Blueprint $table) {
			$table->foreign('user_2_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('chats_users', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('chats_users', function(Blueprint $table) {
			$table->foreign('chat_id')->references('id')->on('chats')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('chat_messages', function(Blueprint $table) {
			$table->foreign('chat_id')->references('id')->on('chats')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('chat_messages', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('users_blocked', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('users_blocked', function(Blueprint $table) {
			$table->foreign('user_blocked_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{

		Schema::table('chats', function(Blueprint $table) {
			$table->dropForeign('chats_user_1_id_foreign');
		});
		Schema::table('chats', function(Blueprint $table) {
			$table->dropForeign('chats_user_2_id_foreign');
		});
		Schema::table('chats_users', function(Blueprint $table) {
			$table->dropForeign('chats_users_user_id_foreign');
		});
		Schema::table('chats_users', function(Blueprint $table) {
			$table->dropForeign('chats_users_chat_id_foreign');
		});
		Schema::table('chat_messages', function(Blueprint $table) {
			$table->dropForeign('chat_messages_chat_id_foreign');
		});
		Schema::table('chat_messages', function(Blueprint $table) {
			$table->dropForeign('chat_messages_user_id_foreign');
		});		
		Schema::table('users_blocked', function(Blueprint $table) {
			$table->dropForeign('users_blocked_user_id_foreign');
		});
		Schema::table('users_blocked', function(Blueprint $table) {
			$table->dropForeign('users_blocked_user_blocked_id_foreign');
		});
	}
}