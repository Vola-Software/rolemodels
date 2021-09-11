<?php

use Illuminate\Database\Seeder;

class RoleModelProfessionSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('role_model_professions')->insert([
        		['name' => 'Спорт'],
        		['name' => 'Кино,театър, музика'],
        		['name' => 'Изкуство'],
        		['name' => 'Наука'],
        		['name' => 'Технологии - IT, инженерни специалности'],
        		['name' => 'Предприемачество и управление'],
        		['name' => 'Медии'],
        		['name' => 'Финанси'],
        		['name' => 'Английски език'],
        		['name' => 'Нямам предпочитания']
        	]);
    }
}