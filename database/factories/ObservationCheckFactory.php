<?php

namespace Database\Factories;

use App\Models\ObservationCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObservationCheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ObservationCheck::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'observation_id' => 1,
            'check_id' => 3,
        ];
    }
}
