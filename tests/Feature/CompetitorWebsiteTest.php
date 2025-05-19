<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\CompetitorWebsite;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class CompetitorWebsiteTest extends TestCase
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

    public function test_competitor_screen_can_be_rendered()
    {
        $this->login(5);

        $company = Company::factory()->create();

        $response = $this->get(route('seo.customers.competitors.index', $company->id));

        $response->assertStatus(200);
    }

    public function test_competitor_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $company = Company::factory()->create();

        $response = $this->get(route('seo.customers.competitors.index', $company->id));

        $response->assertStatus(403);
    }

    public function test_create_competitor_screen_can_be_rendered()
    {
        $this->login(5);

        $company = Company::factory()->create();

        $response = $this->get(route('seo.customers.competitors.create', $company->id));

        $response->assertStatus(200);
    }

    public function test_create_competitor_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $company = Company::factory()->create();

        $response = $this->get(route('seo.customers.competitors.create', $company->id));

        $response->assertStatus(403);
    }

    public function test_user_can_add_competitor() {
        $user = $this->login(5);

        $company = Company::factory()->create();

        $competitor = CompetitorWebsite::factory()->create();

        $response = $this->actingAs($user)->post(route('seo.customers.competitors.store', $company->id), [
            'customer_id' => $company->id,
            'url' => $competitor->url
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_competitor()
    {
        $user = $this->login(1);

        $company = Company::factory()->create();

        $competitor = CompetitorWebsite::factory()->create();

        $response = $this->actingAs($user)->post(route('seo.customers.competitors.store', $company->id), [
            'customer_id' => $company->id,
            'url' => $competitor->url
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_competitor_screen_can_be_rendered()
    {
        $this->login(5);

        $customer = Company::find(3);
        $competitor = CompetitorWebsite::factory()->create();

        $response = $this->get(route('seo.customers.competitors.edit', [$customer->id, $competitor->id]));

        $response->assertStatus(200);
    }

    public function test_edit_competitor_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $customer = Company::find(3);
        $competitor = CompetitorWebsite::factory()->create();

        $response = $this->get(route('seo.customers.competitors.edit', [$customer->id, $competitor->id]));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_competitor() {
        $user = $this->login(5);

        $customer = Company::find(3);
        $competitor = CompetitorWebsite::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.competitors.update', [$customer->id, $competitor->id]), [
            'url' => $competitor->url
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_competitor()
    {
        $user = $this->login(1);

        $customer = Company::find(3);
        $competitor = CompetitorWebsite::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.competitors.update', [$customer->id, $competitor->id]), [
            'url' => $competitor->url
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_customer_competitors_screen_can_be_rendered()
    {
        $this->login(8);

        $response = $this->get(route('customer.competitors.index'));

        $response->assertStatus(200);
    }

    public function test_customer_competitors_screen_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('customer.competitors.index'));

        $response->assertStatus(403);
    }

    public function test_show_competitor_screen_can_be_rendered()
    {
        $this->login(8);

        $competitor = CompetitorWebsite::factory()->create();

        $response = $this->get(route('customer.competitors.show', $competitor->id));

        $response->assertStatus(200);
    }

    public function test_show_competitor_screen_is_not_allowed()
    {
        $this->login(1);

        $competitor = CompetitorWebsite::factory()->create();

        $response = $this->get(route('customer.competitors.show', $competitor->id));

        $response->assertStatus(403);
    }
}
