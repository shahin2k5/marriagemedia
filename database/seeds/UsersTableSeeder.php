<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'=>'1',
        	'name'=>'Md. Admin',
        	'username'=>'admin',
        	'email'=>'admin@blog.com',
        	'password'=>bcrypt('123456')
        ]);

        DB::table('users')->insert([
        	'name'=>'Md. User',
        	'username'=>'user',
        	'email'=>'user@blog.com',
        	'password'=>bcrypt('123456')
        ]);

        DB::table('users')->insert([
            'role_id'=>'3',
            'name'=>'Md. Agent',
            'username'=>'agent',
            'email'=>'agent@blog.com',
            'password'=>bcrypt('123456')
        ]);
        
    }
}
