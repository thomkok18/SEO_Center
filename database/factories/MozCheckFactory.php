<?php

namespace Database\Factories;

use App\Models\MozCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

class MozCheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MozCheck::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'domain_name' => 'test.com',
            'domain_authority' => 100,
            'indexed_at' => now(),
        ];
    }
}
