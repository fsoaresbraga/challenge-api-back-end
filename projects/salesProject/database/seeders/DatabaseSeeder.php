<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\CompanyTableSeeder;
use Database\Seeders\DirectorTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $this->call([
            DirectorTableSeeder::class,
            CompanyTableSeeder::class,
           UserTableSeeder::class
        ]);
    }
}
