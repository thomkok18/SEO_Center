<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class RegistrationTest extends TestCase
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

    public function test_registration_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('users.create'));

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('users.store'), [
            'role_id' => 1,
            'language_id' => 1,
            'status_id' => 1,
            'company_id' => 1,
            'firstname' => 'Test',
            'inserts' => '',
            'lastname' => 'User',
            'email' => 'test@example.com',
            'phone' => '06-12345678',
            'password' => 'testen24',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
