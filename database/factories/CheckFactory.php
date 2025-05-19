<?php

namespace Database\Factories;

use App\Models\Check;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Check::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 4,
            'web_crawler_check_id' => 1,
            'majestic_check_id' => 1,
            'moz_check_id' => 1,
            'commentary' => 'You need to change this to remove the 404 error.',
            'measured_at' => now(),
            'latest_scan' => now(),
            'latest_scan_update' => now(),
        ];
    }
}
