<?php

namespace Database\Factories;

use App\Models\MajesticCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

class MajesticCheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MajesticCheck::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'domain_name' => 'test.com',
            'citation_flow' => 100,
            'trust_flow' => 100,
            'indexed_at' => now(),
        ];
    }
}
