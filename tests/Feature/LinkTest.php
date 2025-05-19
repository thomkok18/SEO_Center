<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class LinkTest extends TestCase
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

    public function test_link_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.links.index'));

        $response->assertStatus(200);
    }

    public function test_link_screen_is_not_allowed_to_be_rendered()
    {
        $this->login(3);

        $response = $this->get(route('admin.links.index'));

        $response->assertStatus(403);
    }

    public function test_add_link_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.links.create', 1));

        $response->assertStatus(200);
    }

    public function test_add_link_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.links.create', 1));

        $response->assertStatus(403);
    }

    public function test_user_can_add_link() {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('admin.links.store'), [
            'website' => 'https://www.test@test.com',
            'anchor_text' => 'mywebsite1',
            'anchor_url' => 'https://www.mywebsite1.com',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_link()
    {
        $user = $this->login(3);

        $response = $this->actingAs($user)->post(route('admin.links.store'), [
            'website' => 'https://www.test1@test.com',
            'anchor_text' => 'mywebsite2',
            'anchor_url' => 'https://www.mywebsite2.com',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_link_screen_can_be_rendered()
    {
        $this->login(1);

        $link = Link::factory()->create();

        $response = $this->get(route('admin.links.edit', $link->id));

        $response->assertStatus(200);
    }

    public function test_edit_link_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $link = Link::factory()->create();

        $response = $this->get(route('admin.links.edit', $link->id));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_link() {
        $user = $this->login(1);

        $response = $this->actingAs($user)->patch(route('admin.links.update', 1), [
            'website' => 'https://www.test2@test.com',
            'anchor_text' => 'mywebsite3',
            'anchor_url' => 'https://www.mywebsite3.com',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_link()
    {
        $user = $this->login(3);

        $response = $this->actingAs($user)->patch(route('admin.links.update', 1), [
            'website' => 'https://www.test2@test.com',
            'anchor_text' => 'mywebsite4',
            'anchor_url' => 'https://www.mywebsite4.com',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_delete_link() {
        $user = $this->login(1);

        $link = Link::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.links.destroy', $link->id));

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_destroy_link() {
        $user = $this->login(3);

        $link = Link::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.links.destroy', $link->id));

        $response->assertSessionHasNoErrors();
    }
}
