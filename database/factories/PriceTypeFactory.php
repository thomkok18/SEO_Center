<?php

namespace Database\Factories;

use App\Models\PriceType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PriceType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_en' => 'test',
            'name_nl' => 'test',
            'price' => 12.34,
            'archived' => false
        ];
    }
}
