<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class LinkBuildingTest extends TestCase
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

    public function test_show_link_building_admin_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.link-buildings.index'));

        $response->assertStatus(200);
    }

    public function test_show_link_building_admin_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.link-buildings.index'));

        $response->assertStatus(403);
    }
}
