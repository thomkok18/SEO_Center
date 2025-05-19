<?php

namespace Tests\Feature;

use App\Models\User;
use gmu\wpBlogBuilder\Models\WordpressBlog;
use App\Providers\RouteServiceProvider;
use gmu\wpBlogBuilder\Models\WordpressWebsite;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class WordpressBlogTest extends TestCase
{
    public function login(int $id) {
        $user = User::find($id);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'testen24',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        return $user;
    }

    public function test_create_wordpress_blog_admin_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.wordpress-blogs.create'));

        $response->assertStatus(200);
    }

    public function test_create_wordpress_blog_admin_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.wordpress-blogs.create'));

        $response->assertStatus(403);
    }

    public function test_create_category_wordpress_blog_admin_screen_can_be_rendered()
    {
        $this->login(1);

        $website = WordpressWebsite::factory()->create();
        $blog = WordpressBlog::factory()->create([
            'wordpress_website_id' => $website->id
        ]);

        $response = $this->get(route('admin.wordpress-blogs.create-category', $blog->id));

        $response->assertStatus(200);
    }

    public function test_create_category_wordpress_blog_admin_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $website = WordpressWebsite::factory()->create();
        $blog = WordpressBlog::factory()->create([
            'wordpress_website_id' => $website->id
        ]);

        $response = $this->get(route('admin.wordpress-blogs.create-category', $blog->id));

        $response->assertStatus(403);
    }

    public function test_user_can_add_wordpress_blog()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('admin.wordpress-blogs.store'), [
            'wordpress_website_status_id' => 1,
            'wordpress_website_format_id' => 1,
            'wordpress_website_id' => 1,
            'title' => 'Test: wanneer en hoe gebruik je het?',
            'seo_title' => 'Test: wanneer en hoe gebruik je het?',
            'description' => 'Dit is een description',
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'content' => 'dit is content',
            'publication_date' => Carbon::now()->addDays(5)
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_wordpress_blog()
    {
        $user = $this->login(3);

        $response = $this->actingAs($user)->post(route('admin.wordpress-blogs.store'), [
            'wordpress_website_status_id' => 1,
            'wordpress_website_format_id' => 1,
            'wordpress_website_id' => 1,
            'title' => 'Test: wanneer en hoe gebruik je het?',
            'seo_title' => 'Test: wanneer en hoe gebruik je het?',
            'description' => 'Dit is een description',
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'content' => 'dit is content',
            'publication_date' => Carbon::now()->addDays(5)
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_add_wordpress_blog_category() {
        $user = $this->login(1);

        $website = WordpressWebsite::factory()->create();
        $blog = WordpressBlog::factory()->create([
            'wordpress_website_id' => $website->id
        ]);

        $response = $this->actingAs($user)->post(route('admin.wordpress-blogs.store-category', $blog->id), [
            'wordpress_website_status_id' => 1,
            'wordpress_website_format_id' => 1,
            'wordpress_website_id' => 1,
            'title' => 'Test: wanneer en hoe gebruik je het?',
            'seo_title' => 'Test: wanneer en hoe gebruik je het?',
            'description' => 'Dit is een description',
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'content' => 'dit is content',
            'publication_date' => Carbon::now()->addDays(5)
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_wordpress_blog_category()
    {
        $user = $this->login(3);

        $website = WordpressWebsite::factory()->create();
        $blog = WordpressBlog::factory()->create([
            'wordpress_website_id' => $website->id
        ]);

        $response = $this->actingAs($user)->post(route('admin.wordpress-blogs.store-category', $blog->id), [
            'wordpress_blog_category_id' => 1
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_wordpress_blog_admin_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.wordpress-blogs.edit', 1));

        $response->assertStatus(200);
    }

    public function test_edit_wordpress_blog_admin_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.wordpress-blogs.edit', 1));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_wordpress_blog() {
        $user = $this->login(1);

        $website = WordpressBlog::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.wordpress-blogs.update', $website->id), [
            'wordpress_website_status_id' => 1,
            'wordpress_website_format_id' => 1,
            'wordpress_website_id' => 1,
            'title' => 'Test: wanneer en hoe gebruik je het?',
            'seo_title' => 'Test: wanneer en hoe gebruik je het?',
            'description' => 'Dit is een description',
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'content' => 'dit is content',
            'publication_date' => Carbon::now()->addDays(5)
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_wordpress_blog()
    {
        $user = $this->login(3);

        $website = WordpressBlog::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.wordpress-blogs.update', $website->id), [
            'wordpress_website_status_id' => 1,
            'wordpress_website_format_id' => 1,
            'wordpress_website_id' => 1,
            'title' => 'Test: wanneer en hoe gebruik je het?',
            'seo_title' => 'Test: wanneer en hoe gebruik je het?',
            'description' => 'Dit is een description',
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'content' => 'dit is content',
            'publication_date' => Carbon::now()->addDays(5)
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_delete_wordpress_blog() {
        $user = $this->login(1);

        $wordpressBlog = WordpressBlog::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.wordpress-blogs.destroy', [$wordpressBlog->id]));

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_destroy_wordpress_blog() {
        $user = $this->login(3);

        $wordpressBlog = WordpressBlog::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.wordpress-blogs.destroy', [$wordpressBlog->id]));

        $response->assertSessionHasNoErrors();
    }
}
