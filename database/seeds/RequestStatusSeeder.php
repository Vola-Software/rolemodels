<?php

use Illuminate\Database\Seeder;

class RequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('request_statuses')->insert([
        	['name' => 'Чака одобрение'],
        	['name' => 'Одобрен от админ'],
        	['name' => 'Записан ролеви модел'],
        	['name' => 'Изпълнен'],
        	['name' => 'Завършен'],
        	['name' => 'Отхвърлен'],
        	['name' => 'Отменен'],
            ['name' => 'Архивиран'],
        ]);
    }
}
