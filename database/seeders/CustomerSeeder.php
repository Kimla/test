<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\CustomerFieldPart;
use App\Models\Certificate;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        Customer::factory(200)
            ->has(CustomerFieldPart::factory()->count($faker->numberBetween(1, 10)), 'fieldParts')
            ->has(Certificate::factory()->count($faker->numberBetween(1, 3)), 'certifications')
            ->create();
    }
}
