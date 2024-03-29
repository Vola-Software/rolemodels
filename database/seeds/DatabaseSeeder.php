<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RegionSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(ClassStageSeeder::class);
        $this->call(ClassMajorSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(RequestStatusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleModelProfessionSeeder::class);
    }
}
