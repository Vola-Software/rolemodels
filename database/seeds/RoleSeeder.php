<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	[
        		'id' => 1,
            	'name' => 'Суперадмин'
        	],
            [
                'id' => 3,
                'name' => 'Админ' //админ на държава
            ],
            [
        		'id' => 5,
            	'name' => 'ЗвЧ Админ'
        	],
        	[
        		'id' => 7,
            	'name' => 'Админ от компания'
        	],
        	[
        		'id' => 9,
            	'name' => 'Учител'
        	],
        	[
        		'id' => 11,
            	'name' => 'Ролеви модел'
        	],
        ]);
    }
}
