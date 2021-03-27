<?php

namespace Database\Factories;

use App\Models\CustomerFieldPart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFieldPartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerFieldPart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'size' => $this->faker->numberBetween(100, 1000),
            'latest_cultivation' => $this->faker->date(),
            'pre_fruit' => $this->faker->realText(10),
            'map_image' => $this->generateImage(),
            'irrigation' => $this->faker->boolean,
        ];
    }

    protected function generateImage()
    {
        return [
            'source' => 'https://placeimg.com/100/100/any?' . $this->faker->numberBetween(1, 100),
            'sizes' => [
                'small' => [
                    'url' => 'https://placeimg.com/100/100/any?' . $this->faker->numberBetween(1, 100),
                    'width' => 100,
                    'height' => 100
                ],
                'medium' => [
                    'url' => 'https://placeimg.com/250/150/any?' . $this->faker->numberBetween(1, 100),
                    'width' => 250,
                    'height' => 150
                ],
                'large' => [
                    'url' => 'https://placeimg.com/500/300/any?' . $this->faker->numberBetween(1, 100),
                    'width' => 500,
                    'height' => 300
                ]
            ]
        ];
    }
}
