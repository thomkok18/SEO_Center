<?php

namespace Database\Factories;

use App\Models\CompetitorWebsite;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitorWebsiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompetitorWebsite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => 1,
            'url' => 'https://www.google.com',
        ];
    }
}
