<?php

namespace Database\Factories;

use App\Models\ConclusionType;
use App\Models\PromotionUrl;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionUrlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PromotionUrl::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supplier_id' => 2,
            'customer_id' => 3,
            'conclusion_id' => ConclusionType::PENDING,
            'url_type_id' => 1,
            'website_id' => 3,
            'price_type_id' => null,
            'promotion_url' => 'https://www.test.com',
            'custom_price' => $this->faker->randomFloat(2,1, 5000),
            'archived' => false,
        ];
    }
}
