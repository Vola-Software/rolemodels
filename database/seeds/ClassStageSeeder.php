<?php

use Illuminate\Database\Seeder;

class ClassStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_stages')->insert([
        	['name' => '1-4 клас'],
        	['name' => '5-7 клас'],
        	['name' => '8-10 клас'],
        	['name' => '11-12 клас'],
        ]);
    }
}
