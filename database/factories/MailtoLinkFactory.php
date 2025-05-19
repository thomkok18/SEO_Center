<?php

namespace Database\Factories;

use App\Models\MailtoLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MailtoLink>
 */
class MailtoLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailtoLink::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'inserts' => $this->faker->name(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->email(),
        ];
    }
}
