<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Category::factory(5)->create();
        Car::factory(30)->create();

        Car::deleteIndex();
        Car::createIndex($shards = null, $replicas = null);
        //Car::putMapping($ignoreConflicts = true);
        Car::addAllToIndex();
    }
}
