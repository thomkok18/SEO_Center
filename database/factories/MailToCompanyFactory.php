<?php

namespace Database\Factories;

use App\Models\MailToCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailToCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailToCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => 3,
            'user_id' => 5,
        ];
    }
}
