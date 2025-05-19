<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Company;
use App\Models\User;
use App\Models\Website;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class WebsiteTest extends TestCase
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

    public function test_create_website_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.customers.websites.create', 3));

        $response->assertStatus(200);
    }

    public function test_create_website_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.customers.websites.create', 3));

        $response->assertStatus(403);
    }

    public function test_show_customer_website_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();

        $response = $this->get(route('seo.customers.websites.show', [$customer->id, $website->id]));

        $response->assertStatus(200);
    }

    public function test_show_customer_website_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();

        $response = $this->get(route('seo.customers.websites.show', [$customer->id, $website->id]));

        $response->assertStatus(403);
    }

    public function test_user_can_add_website()
    {
        $user = $this->login(5);

        $response = $this->actingAs($user)->post(route('seo.customers.websites.store', 3), [
            'url' => 'https://www.ditisgezond1.nl',
            'company_id' => 3,
            'startdate' => '2025-04-01',
            'enddate' => '2025-05-01',
            'amount' => 1400,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_website()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('seo.customers.websites.store', 3), [
            'url' => 'https://www.ditisgezond2.nl',
            'company_id' => 3,
            'startdate' => '2025-04-01',
            'enddate' => '2025-05-01',
            'amount' => 1400,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_website_screen_can_be_rendered()
    {
        $this->login(5);

        $customer = Company::find(3);
        $website = Website::factory()->create();

        Budget::factory()->create([
            'website_id' => $website->id,
        ]);

        $response = $this->get(route('seo.customers.websites.edit', [$customer->id, $website->id]));

        $response->assertStatus(200);
    }

    public function test_edit_website_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $customer = Company::find(3);
        $website = Website::factory()->create();

        Budget::factory()->create([
            'website_id' => $website->id,
        ]);

        $response = $this->get(route('seo.customers.websites.edit', [$customer->id, $website->id]));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_website() {
        $user = $this->login(5);

        $customer = Company::find(3);
        $website = Website::factory()->create();

        Budget::factory()->create([
            'website_id' => $website->id,
        ]);

        $response = $this->actingAs($user)->patch(route('seo.customers.websites.update', [$customer->id, $website->id]), [
            'url' => 'https://www.test-website1.com',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_website()
    {
        $user = $this->login(1);

        $customer = Company::find(3);
        $website = Website::factory()->create();

        Budget::factory()->create([
            'website_id' => $website->id,
        ]);

        $response = $this->actingAs($user)->patch(route('seo.customers.websites.update', [$customer->id, $website->id]), [
            'url' => 'https://www.test-website2.com',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_archive_website() {
        $user = $this->login(5);

        $website = Website::factory()->create();

        Budget::factory()->create([
            'website_id' => $website->id,
        ]);

        $response = $this->actingAs($user)->post(route('seo.customers.websites.archive', $website->id), [
            'archived' => true,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_archive_website() {
        $user = $this->login(1);

        $website = Website::factory()->create();

        Budget::factory()->create([
            'website_id' => $website->id,
        ]);

        $response = $this->actingAs($user)->post(route('seo.customers.websites.archive', $website->id), [
            'archived' => true,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_archived_website_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.customers.websites.archived', 3));

        $response->assertStatus(200);
    }

    public function test_archived_website_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.customers.websites.archived', 3));

        $response->assertStatus(403);
    }

    public function test_user_can_recover_website() {
        $user = $this->login(5);

        $website = Website::factory()->create([
            'archived' => true
        ]);

        Budget::factory()->create([
            'website_id' => $website->id,
        ]);

        $response = $this->actingAs($user)->post(route('seo.customers.websites.recover', $website->id));

        $response->assertStatus(200);
    }

    public function test_user_is_not_allowed_to_recover_website() {
        $user = $this->login(1);

        $website = Website::factory()->create([
            'archived' => true
        ]);

        Budget::factory()->create([
            'website_id' => $website->id,
        ]);

        $response = $this->actingAs($user)->post(route('seo.customers.websites.recover', $website->id));

        $response->assertStatus(403);
    }
}
