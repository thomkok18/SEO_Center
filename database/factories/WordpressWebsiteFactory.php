<?php

namespace Database\Factories;

use gmu\wpBlogBuilder\Models\WordpressWebsite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WordpressWebsite>
 */
class WordpressWebsiteFactory extends Factory
{
    protected $model = WordpressWebsite::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status_id' => 1,
            'url' => $this->faker->domainName,
            'username' => $this->faker->userName,
            'token' => $this->faker->streetName,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
