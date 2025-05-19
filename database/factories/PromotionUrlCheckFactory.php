<?php

namespace Database\Factories;

use App\Models\PromotionUrlCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionUrlCheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PromotionUrlCheck::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'promotion_url_id' => 1,
            'check_id' => 1,
        ];
    }
}
