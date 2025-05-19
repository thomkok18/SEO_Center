<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Company;
use App\Models\User;
use App\Models\Website;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class BudgetTest extends TestCase
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

    public function test_website_budgets_supplier_screen_can_be_rendered()
    {
        $this->login(3);

        $website = Website::factory()->create();
        Budget::factory()->count(3)->create([
            'website_id' => $website->id,
        ]);

        $response = $this->get(route('supplier.websites.budgets.index', $website->id));

        $response->assertStatus(200);
    }

    public function test_website_budgets_supplier_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $website = Website::factory()->create();
        Budget::factory()->count(3)->create([
            'website_id' => $website->id,
        ]);

        $response = $this->get(route('supplier.websites.budgets.index', $website->id));

        $response->assertStatus(403);
    }

    public function test_customer_websites_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.customers.websites.index', 1));

        $response->assertStatus(200);
    }

    public function test_customer_websites_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.customers.websites.index', 1));

        $response->assertStatus(403);
    }

    public function test_create_customer_websites_budget_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();

        $response = $this->get(route('seo.customers.websites.budgets.create', [$customer->id, $website->id]));

        $response->assertStatus(200);
    }

    public function test_create_customer_websites_budget_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();

        $response = $this->get(route('seo.customers.websites.budgets.create', [$customer->id, $website->id]));

        $response->assertStatus(403);
    }

    public function test_user_can_add_budget() {
        $user = $this->login(5);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();

        $response = $this->actingAs($user)->post(route('seo.customers.websites.budgets.store', [$customer->id, $website->id]), [
            'startdate' => '2030-01-01',
            'enddate' => '2030-02-01',
            'amount' => 450,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_budget()
    {
        $user = $this->login(1);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();

        $response = $this->actingAs($user)->post(route('seo.customers.websites.budgets.store', [$customer->id, $website->id]), [
            'startdate' => '2030-01-01',
            'enddate' => '2030-02-01',
            'amount' => 450,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_customer_websites_budget_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();
        $budget = Budget::factory()->create();

        $response = $this->get(route('seo.customers.websites.budgets.edit', [$customer->id, $website->id, $budget->id]));

        $response->assertStatus(200);
    }

    public function test_edit_customer_websites_budget_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();
        $budget = Budget::factory()->create();

        $response = $this->get(route('seo.customers.websites.budgets.edit', [$customer->id, $website->id, $budget->id]));

        $response->assertStatus(403);
    }

    public function test_user_can_update_budget()
    {
        $user = $this->login(5);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();
        $budget = Budget::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.websites.budgets.update', [$customer->id, $website->id, $budget->id]), [
            'amount' => 650,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_updating_budget()
    {
        $user = $this->login(1);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();
        $budget = Budget::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.websites.budgets.update', [$customer->id, $website->id, $budget->id]), [
            'amount' => 650,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_delete_budget() {
        $user = $this->login(5);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();
        $budget = Budget::factory()->create();

        $response = $this->actingAs($user)->delete(route('seo.customers.websites.budgets.destroy', [$customer->id, $website->id, $budget->id]));

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_destroy_budget() {
        $user = $this->login(1);

        $customer = Company::factory()->create();
        $website = Website::factory()->create();
        $budget = Budget::factory()->create();

        $response = $this->actingAs($user)->delete(route('seo.customers.websites.budgets.destroy', [$customer->id, $website->id, $budget->id]));

        $response->assertSessionHasNoErrors();
    }
}
