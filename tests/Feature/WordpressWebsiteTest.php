<?php

namespace Tests\Feature;

use App\Models\User;
use gmu\wpBlogBuilder\Models\WordpressWebsite;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class WordpressWebsiteTest extends TestCase
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

    public function test_create_wordpress_website_admin_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.wordpress-websites.create'));

        $response->assertStatus(200);
    }

    public function test_create_wordpress_website_admin_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.wordpress-websites.create'));

        $response->assertStatus(403);
    }

    public function test_user_can_add_wordpress_website()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('admin.wordpress-websites.store'), [
            'url' => 'https://www.ditisgezond1/wp-json/wp/v2',
            'username' => 'testuser123',
            'token' => 'valid-token',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_wordpress_website()
    {
        $user = $this->login(3);

        $response = $this->actingAs($user)->post(route('admin.wordpress-websites.store'), [
            'url' => 'https://www.ditisgezond2/wp-json/wp/v2',
            'username' => 'testuser123',
            'token' => 'valid-token',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_wordpress_website_admin_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.wordpress-websites.edit', 1));

        $response->assertStatus(200);
    }

    public function test_edit_wordpress_website_admin_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.wordpress-websites.edit', 1));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_wordpress_website() {
        $user = $this->login(1);

        $website = WordpressWebsite::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.wordpress-websites.update', $website->id), [
            'url' => 'https://www.test-website1/wp-json/wp/v2',
            'username' => 'test12345',
            'token' => 'valid-token',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_wordpress_website()
    {
        $user = $this->login(3);

        $website = WordpressWebsite::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.wordpress-websites.update', $website->id), [
            'url' => 'https://www.test-website2/wp-json/wp/v2',
            'username' => 'test12345',
            'token' => 'valid-token',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_delete_wordpress_website() {
        $user = $this->login(1);

        $wordpressWebsite = WordpressWebsite::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.wordpress-websites.destroy', [$wordpressWebsite->id]));

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_destroy_wordpress_website() {
        $user = $this->login(3);

        $wordpressWebsite = WordpressWebsite::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.wordpress-websites.destroy', [$wordpressWebsite->id]));

        $response->assertSessionHasNoErrors();
    }
}
