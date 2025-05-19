<?php

namespace Database\Factories;

use gmu\wpBlogBuilder\Models\WordpressBlog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WordpressBlog>
 */
class WordpressBlogFactory extends Factory
{
    protected $model = Wordpressblog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'wordpress_website_id' => null,
            'wordpress_website_status_id' => 1,
            'wordpress_website_format_id' => 1,
            'title' => $this->faker->title,
            'seo_title' => $this->faker->title,
            'description' => $this->faker->streetName,
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'content' => $this->faker->streetName,
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
