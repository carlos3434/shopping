<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        $v = $faker->vehicleArray();
        return [
            'uuid' => \Ramsey\Uuid\Uuid::uuid4(),
            'title' => $v['brand'],
            'description' => $v['brand'],
            'category_id' => $this->faker->randomElement([ 1 , 2 , 3 , 4 , 5]),
            'original_price' => $this->faker->randomDigit,
            'actual_price' => $this->faker->randomDigit,
            'image' => '',
            'quantity' => $this->faker->randomDigit,
            'status' => $this->faker->randomElement([0, 1]),
            'model' => $v['model'],
            'size' => $faker->vin,
            'registration' => $faker->vehicleRegistration,

        ];
    }
}