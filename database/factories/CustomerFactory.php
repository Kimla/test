<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['admin' => false])->id,
            'has_separate_owner' => true,
            'owner_name' => $this->faker->name,
            'owner_email' => $this->faker->email,
            'owner_phone' => $this->faker->phoneNumber,
            'company_name' => $this->faker->company,
            'company_org_nr' => $this->faker->ean8,
            'company_address' => $this->faker->streetAddress,
            'company_postcode' => $this->faker->postcode,
            'company_city' => $this->faker->city,
            'role' => $this->faker->randomElement(['new', 'grower']),
            'has_previously_grown_for_foodhills' => $this->faker->boolean,
            'organic_farming' => $this->faker->boolean,
        ];
    }
}
