<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
        	[
        		'id' => 1,
        		'name' => 'Кока-кола ХБК',
        		'website' => 'https://bg.coca-colahellenic.com/bg',
        		'city_id' => '1',
        		'address' => 'ул. "Рачо Петков - Казанджията", №8'
        	],
            [
                'id' => 2,
                'name' => 'HPE',
                'website' => 'https://www.hpe.com/emea_europe/en/home.html',
                'city_id' => '1',
                'address' => ' '
            ],

            [
                'id' => 999,
                'name' => 'Друга',
                'website' => '#',
                'city_id' => '1',
                'address' => ' '
            ]
        ]);
    }
}
