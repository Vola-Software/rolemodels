<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
        	[
                'id' => 1,
        		'region_id' => 23,
        		'name' => 'София'
        	],
            [
                'id' => 6,
                'region_id' => 3,
                'name' => 'Варна'
            ],
            [
                'id' => 7,
                'region_id' => 4,
                'name' => 'Велико Търново'
            ],
            [
                'id' => 8,
                'region_id' => 3,
                'name' => 'Провадия'
            ],
            [
                'id' => 13,
                'region_id' => 16,
                'name' => 'Пловдив'
            ],
            [
                'id' => 14,
                'region_id' => 24,
                'name' => 'Стара Загора'
            ],
            [
                'id' => 16,
                'region_id' => 17,
                'name' => 'Разград'
            ],
            [
                'id' => 18,
                'region_id' => 16,
                'name' => 'Първомай'
            ],
            [
                'id' => 19,
                'region_id' => 2,
                'name' => 'Бургас'
            ],
            [
                'id' => 21,
                'region_id' => 17,
                'name' => 'Завет'
            ],
            [
                'id' => 26,
                'region_id' => 13,
                'name' => 'Пазарджик'
            ],
            [
                'id' => 29,
                'region_id' => 15,
                'name' => 'Плевен'
            ],
            [
                'id' => 30,
                'region_id' => 11,
                'name' => 'Луковит'
            ],
            [
                'id' => 31,
                'region_id' => 22,
                'name' => 'Пирдоп'
            ],
            [
                'id' => 32,
                'region_id' => 1,
                'name' => 'Благоевград'
            ],
            [
                'id' => 33,
                'region_id' => 5,
                'name' => 'Видин'
            ],
            [
                'id' => 34,
                'region_id' => 6,
                'name' => 'Враца'
            ],
            [
                'id' => 35,
                'region_id' => 7,
                'name' => 'Габрово'
            ],
            [
                'id' => 36,
                'region_id' => 8,
                'name' => 'Добрич'
            ],
            [
                'id' => 37,
                'region_id' => 9,
                'name' => 'Кърджали'
            ],
            [
                'id' => 38,
                'region_id' => 10,
                'name' => 'Кюстендил'
            ],
            [
                'id' => 39,
                'region_id' => 11,
                'name' => 'Кюстендил'
            ],
            [
                'id' => 40,
                'region_id' => 12,
                'name' => 'Монтана'
            ],
            [
                'id' => 41,
                'region_id' => 14,
                'name' => 'Перник'
            ],
            [
                'id' => 42,
                'region_id' => 18,
                'name' => 'Русе'
            ],
            [
                'id' => 43,
                'region_id' => 19,
                'name' => 'Силистра'
            ],
            [
                'id' => 44,
                'region_id' => 20,
                'name' => 'Сливен'
            ],
            [
                'id' => 45,
                'region_id' => 21,
                'name' => 'Смолян'
            ],
            [
                'id' => 46,
                'region_id' => 22,
                'name' => 'София област'
            ],
            [
                'id' => 47,
                'region_id' => 25,
                'name' => 'Търговище'
            ],
            [
                'id' => 48,
                'region_id' => 26,
                'name' => 'Хасково'
            ],
            [
                'id' => 49,
                'region_id' => 27,
                'name' => 'Шумен'
            ],
            [
                'id' => 50,
                'region_id' => 28,
                'name' => 'Ямбол'
            ]
        ]);

        DB::table('cities')->insert([
            [
                'id' => 2,
                'type' => 2,
                'region_id' => 25,
                'name' => 'Голямо Ново'
            ],
            [
                'id' => 3,
                'type' => 2,
                'region_id' => 4,
                'name' => 'Кесарево'
            ],
            [
                'id' => 4,
                'type' => 2,
                'region_id' => 4,
                'name' => 'Поликраище'
            ],
            [
                'id' => 5,
                'type' => 2,
                'region_id' => 24,
                'name' => 'Хрищени'
            ],
            [
                'id' => 9,
                'type' => 2,
                'region_id' => 27,
                'name' => 'Хитрино'
            ],
            [
                'id' => 10,
                'type' => 2,
                'region_id' => 6,
                'name' => 'Михайлово'
            ],
            [
                'id' => 11,
                'type' => 2,
                'region_id' => 6,
                'name' => 'Тишевица'
            ],
            [
                'id' => 12,
                'type' => 2,
                'region_id' => 12,
                'name' => 'Лехчево'
            ],
            [
                'id' => 15,
                'type' => 2,
                'region_id' => 24,
                'name' => 'Манолово'
            ],
            [
                'id' => 17,
                'type' => 2,
                'region_id' => 20,
                'name' => 'Гавраилово'
            ],
            [
                'id' => 20,
                'type' => 2,
                'region_id' => 28,
                'name' => 'Скалица'
            ],
            [
                'id' => 22,
                'type' => 2,
                'region_id' => 16,
                'name' => 'Христо Даново'
            ],
            [
                'id' => 23,
                'type' => 2,
                'region_id' => 22,
                'name' => 'Мирково'
            ],
            [
                'id' => 24,
                'type' => 2,
                'region_id' => 11,
                'name' => 'Дерманци'
            ],
            [
                'id' => 25,
                'type' => 2,
                'region_id' => 13,
                'name' => 'Огняново'
            ],
            [
                'id' => 27,
                'type' => 2,
                'region_id' => 11,
                'name' => 'Брестница'
            ],
            [
                'id' => 28,
                'type' => 2,
                'region_id' => 22,
                'name' => 'Априлово'
            ],
        ]);
    }
}
