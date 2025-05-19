<?php

namespace Database\Factories;

use App\Models\Observation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Observation::class;

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
            'archived' => false
        ];
    }
}
