<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //With phone
        DB::table('users')->insert([
            [
                'id' => 2,
                'first_name' => 'Учител',
                'middle_name' => 'Дас',
                'last_name' => 'Калов',
                'phone' => '0123451234',
                'role_id' => 9,
                'email' => 'teacher1@mail.com',
                'password' => bcrypt('pass1234')
            ]
        ]);

        //Without phone
        DB::table('users')->insert([
        	[
        		'id' => 1,
        		'first_name' => 'Админ',
        		'middle_name' => 'Супер',
        		'last_name' => 'Едно',
        		'role_id' => 1,
        		'email' => 'admin@mail.com',
        		'password' => bcrypt('pass1234')
        	],
        	[
        		'id' => 3,
        		'first_name' => 'Служител',
        		'middle_name' => 'Работар',
        		'last_name' => 'Бачкев',
        		'role_id' => 11,
        		'email' => 'rolemodel1@mail.com',
        		'password' => bcrypt('pass1234')
        	],
            [
                'id' => 4,
                'first_name' => 'ЗвЧ',
                'middle_name' => 'Админ',
                'last_name' => 'Админов',
                'role_id' => 5,
                'email' => 'tfb_admin@mail.com',
                'password' => bcrypt('pass1234')
            ],
            [
                'id' => 5,
                'first_name' => 'Служител',
                'middle_name' => 'Админ',
                'last_name' => 'Шефов',
                'role_id' => 7,
                'email' => 'company_admin@mail.com',
                'password' => bcrypt('pass1234')
            ]
        ]);

        DB::table('teachers')->insert([
        	'user_id' => 2,
        	'school_id' => 1
        ]);

        DB::table('professionals')->insert([
            [
            	'user_id' => 3,
            	'company_id' => 1,
            	'position' => 'Стругар'
            ],
            [
                'user_id' => 5,
                'company_id' => 1,
                'position' => 'Мениджър'
            ]
        ]);
    }
}
