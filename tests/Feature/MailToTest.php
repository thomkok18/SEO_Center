<?php

namespace Tests\Feature;

use App\Models\MailToCompany;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class MailToTest extends TestCase
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

    public function test_mailto_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.customers.mailto.index', 3));

        $response->assertStatus(200);
    }

    public function test_mailto_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.customers.mailto.index', 3));

        $response->assertStatus(403);
    }

    public function test_create_mailto_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.customers.mailto.create', 3));

        $response->assertStatus(200);
    }

    public function test_create_mailto_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.customers.mailto.create', 3));

        $response->assertStatus(403);
    }

    public function test_user_can_add_mailto()
    {
        $user = $this->login(5);

        $response = $this->actingAs($user)->post(route('seo.customers.mailto.store', 3), [
            'company_id' => 3,
            'user_id' => 5,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_mailto()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('seo.customers.mailto.store', 3), [
            'company_id' => 3,
            'user_id' => 5,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_mailto_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $mailto = MailToCompany::factory()->create();

        $response = $this->get(route('seo.customers.mailto.edit', $mailto->company_id));

        $response->assertStatus(200);
    }

    public function test_edit_mailto_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $mailto = MailToCompany::factory()->create();

        $response = $this->get(route('seo.customers.mailto.edit', $mailto->company_id));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_mailto() {
        $user = $this->login(3);

        $mailto = MailToCompany::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.mailto.update', $mailto->id), [
            'user_id' => 6,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_mailto()
    {
        $user = $this->login(1);

        $mailto = MailToCompany::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.mailto.update', $mailto->id), [
            'user_id' => 6,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }
}
