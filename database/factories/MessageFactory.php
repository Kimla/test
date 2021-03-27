<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(40),
            'image' => $this->generateImage(),
            'content' => "<p>{$this->faker->realText(300)}</p><p>{$this->faker->realText(300)}</p><p>{$this->faker->realText(300)}</p>",
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
