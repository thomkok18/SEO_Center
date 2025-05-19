<?php

namespace Tests\Feature;

use App\Models\MailtoLink;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class CrawlerTest extends TestCase
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

    public function test_admin_mailto_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.mailto_link.index', 3));

        $response->assertStatus(200);
    }

    public function test_admin_mailto_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.mailto_link.index', 3));

        $response->assertStatus(403);
    }

    public function test_create_admin_mailto__screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.mailto_link.create'));

        $response->assertStatus(200);
    }

    public function test_create_admin_mailto_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.mailto_link.create'));

        $response->assertStatus(403);
    }

    public function test_user_can_add_admin_mailto()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('admin.mailto_link.store'), [
            'firstname' => 'test1',
            'inserts' => 'test1',
            'lastname' => 'test1',
            'email' => 'test1@test.com',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_mailto()
    {
        $user = $this->login(3);

        $response = $this->actingAs($user)->post(route('admin.mailto_link.store'), [
            'firstname' => 'test2',
            'inserts' => 'test2',
            'lastname' => 'test2',
            'email' => 'test2@test.com',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_admin_mailto_screen_can_be_rendered()
    {
        $this->login(1);

        $mailto = MailtoLink::factory()->create();

        $response = $this->get(route('admin.mailto_link.edit', $mailto->id));

        $response->assertStatus(200);
    }

    public function test_edit_admin_mailto_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $mailto = MailtoLink::factory()->create();

        $response = $this->get(route('admin.mailto_link.edit', $mailto->id));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_admin_mailto() {
        $user = $this->login(1);

        $mailto = MailtoLink::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.mailto_link.update', $mailto->id), [
            'firstname' => 'test3',
            'inserts' => 'test3',
            'lastname' => 'test3',
            'email' => 'test3@test.com',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_admin_mailto()
    {
        $user = $this->login(3);

        $mailto = MailtoLink::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.mailto_link.update', $mailto->id), [
            'firstname' => 'test4',
            'inserts' => 'test4',
            'lastname' => 'test4',
            'email' => 'test4@test.com',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_delete_admin_mailto() {
        $user = $this->login(1);

        $mailto = MailtoLink::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.mailto_link.destroy', [$mailto->id]));

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_destroy_admin_mailto() {
        $user = $this->login(3);

        $mailto = MailtoLink::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.mailto_link.destroy', [$mailto->id]));

        $response->assertSessionHasNoErrors();
    }
}
