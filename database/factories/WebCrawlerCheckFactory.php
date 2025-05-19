<?php

namespace Database\Factories;

use App\Models\WebCrawlerCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebCrawlerCheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WebCrawlerCheck::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'server_ip' => '127.0. 0.1',
            'http_status' => 200,
            'page_language' => 'nl',
            'page_title' => 'This is the page title',
            'page_description' => 'This is the page description',
            'measured_at' => now(),
            'follow_internal_links' => $this->faker->numberBetween(0, 100),
            'no_follow_internal_links' => $this->faker->numberBetween(0, 100),
            'follow_external_links' => $this->faker->numberBetween(0, 100),
            'no_follow_external_links' => $this->faker->numberBetween(0, 100),
            'follow_social_links' => $this->faker->numberBetween(0, 100),
            'no_follow_social_links' => $this->faker->numberBetween(0, 100),
            'follow_customer_links' => $this->faker->numberBetween(0, 100),
            'no_follow_customer_links' => $this->faker->numberBetween(0, 100),
            'follow_competitor_links' => $this->faker->numberBetween(0, 100),
            'no_follow_competitor_links' => $this->faker->numberBetween(0, 100),
            'image_count' => $this->faker->numberBetween(0, 100),
        ];
    }
}
