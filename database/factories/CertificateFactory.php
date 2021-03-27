<?php

namespace Database\Factories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Certificate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($this->faker->numberBetween(2, 6)),
            'url' => 'https://placeimg.com/100/100/any?' . $this->faker->numberBetween(1, 100),
        ];
    }
}
