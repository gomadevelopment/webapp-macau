<?php

use Illuminate\Database\Seeder;

class UserRoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'id' => '1',
            'role' => 'professor_admin'
        ]);
        DB::table('user_roles')->insert([
            'id' => '2',
            'role' => 'professor'
        ]);
        DB::table('user_roles')->insert([
            'id' => '3',
            'role' => 'student'
        ]);
    }
}
