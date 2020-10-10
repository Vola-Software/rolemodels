<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
        	['name' => 'Благоевград'],
			['name' => 'Бургас'],
			['name' => 'Варна'],
			['name' => 'Велико Търново'],
			['name' => 'Видин'],
			['name' => 'Враца'],
			['name' => 'Габрово'],
			['name' => 'Добрич'],
			['name' => 'Кърджали'],
			['name' => 'Кюстендил'],
			['name' => 'Ловеч'],
			['name' => 'Монтана'],
			['name' => 'Пазарджик'],
			['name' => 'Перник'],
			['name' => 'Плевен'],
			['name' => 'Пловдив'],
			['name' => 'Разград'],
			['name' => 'Русе'],
			['name' => 'Силистра'],
			['name' => 'Сливен'],
			['name' => 'Смолян'],
			['name' => 'София област'],
			['name' => 'София'],
			['name' => 'Стара загора'],
			['name' => 'Търговище'],
			['name' => 'Хасково'],
			['name' => 'Шумен'],
			['name' => 'Ямбол']
        ]);
    }
}
