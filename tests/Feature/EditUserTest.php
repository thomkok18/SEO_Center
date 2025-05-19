<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class EditUserTest extends TestCase
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

    public function test_edit_user_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('users.edit', 1));

        $response->assertStatus(200);
    }

    public function test_edit_user_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('users.edit', 1));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_user() {
        $user = $this->login(1);

        $response = $this->actingAs($user)->patch(route('users.update', $user->id), [
            'role_id' => 1,
            'language_id' => 1,
            'status_id' => 1,
            'company_id' => 1,
            'firstname' => 'Test',
            'inserts' => '',
            'lastname' => 'User',
            'email' => 'test1@company.com',
            'phone' => '1234567890',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_user()
    {
        $user = $this->login(3);

        $response = $this->actingAs($user)->patch(route('users.update', $user->id), [
            'role_id' => 1,
            'language_id' => 1,
            'status_id' => 1,
            'company_id' => 1,
            'firstname' => 'Test',
            'inserts' => '',
            'lastname' => 'User',
            'email' => 'test2@company.com',
            'phone' => '1234567890',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_profile_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('profile'));

        $response->assertStatus(200);
    }

    public function test_profile_user_can_edit() {
        $user = $this->login(1);

        $response = $this->actingAs($user)->patch(route('user.info.update'), [
            'firstname' => 'Test',
            'inserts' => '',
            'lastname' => 'User',
            'phone' => '06-12345678',
            'email' => 'test@newcompany.com',
            'language_id' => 1,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_can_edit_user_password() {
        $user = $this->login(1);

        $response = $this->actingAs($user)->patch(route('user.password.update'), [
            'current_password' => 'testen24',
            'password' => 'testen24',
            'repeat_password' => 'testen24',
        ]);

        $response->assertSessionHasNoErrors();
    }
}
