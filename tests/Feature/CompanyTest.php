<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class CompanyTest extends TestCase
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

    public function test_company_admin_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.companies.index'));

        $response->assertStatus(200);
    }

    public function test_company_admin_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.companies.index'));

        $response->assertStatus(403);
    }

    public function test_create_company_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.companies.create'));

        $response->assertStatus(200);
    }

    public function test_create_company_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.companies.create'));

        $response->assertStatus(403);
    }

    public function test_user_can_add_company() {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('admin.companies.store'), [
            'name' => 'Google',
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_company()
    {
        $user = $this->login(3);

        $response = $this->actingAs($user)->post(route('admin.companies.store'), [
            'name' => 'Google',
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_company_screen_can_be_rendered()
    {
        $this->login(1);

        $company = Company::factory()->create();

        $response = $this->get(route('admin.companies.edit', $company->id));

        $response->assertStatus(200);
    }

    public function test_edit_company_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $company = Company::factory()->create();

        $response = $this->get(route('admin.companies.edit', $company->id));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_company() {
        $user = $this->login(1);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.companies.update', $company->id), [
            'name' => $company->name,
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_company()
    {
        $user = $this->login(3);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.companies.update', $company->id), [
            'name' => $company->name,
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_archive_company() {
        $user = $this->login(1);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.companies.update', $company->id), [
            'name' => $company->name,
            'archived' => true
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_archive_company() {
        $user = $this->login(3);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->patch(route('admin.companies.update', $company->id), [
            'name' => $company->name,
            'archived' => true
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_archived_company_screen_can_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('admin.companies.archived'));

        $response->assertStatus(200);
    }

    public function test_archived_company_screen_rendering_is_not_allowed()
    {
        $this->login(3);

        $response = $this->get(route('admin.companies.archived'));

        $response->assertStatus(403);
    }

    public function test_user_can_recover_company() {
        $user = $this->login(1);

        $company = Company::factory()->create([
            'archived' => true
        ]);

        $response = $this->actingAs($user)->post(route('admin.companies.recover', $company->id));

        $response->assertStatus(200);
    }

    public function test_user_is_not_allowed_to_recover_company() {
        $user = $this->login(3);

        $company = Company::factory()->create([
            'archived' => true
        ]);

        $response = $this->actingAs($user)->post(route('admin.companies.recover', $company->id));

        $response->assertStatus(403);
    }

    public function test_customer_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.customers.index'));

        $response->assertStatus(200);
    }

    public function test_customer_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.customers.index'));

        $response->assertStatus(403);
    }

    public function test_create_customer_seo_employee_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.customers.create'));

        $response->assertStatus(200);
    }

    public function test_create_customer_seo_employee_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.customers.create'));

        $response->assertStatus(403);
    }

    public function test_user_can_add_customer() {
        $user = $this->login(5);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->post(route('seo.customers.store'), [
            'language_id' => 1,
            'name' => 'Google',
            'firstname' => 'Test',
            'inserts' => '',
            'lastname' => 'User',
            'email' => 'test1@example.com',
            'phone' => '06-12345678',
            'password' => 'testen24',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_customer()
    {
        $user = $this->login(1);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->post(route('seo.customers.store'), [
            'language_id' => 1,
            'name' => 'Google',
            'firstname' => 'Test',
            'inserts' => '',
            'lastname' => 'User',
            'email' => 'test2@example.com',
            'phone' => '06-12345678',
            'password' => 'testen24',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_customer_screen_can_be_rendered()
    {
        $this->login(5);

        $company = Company::factory()->create();

        $response = $this->get(route('seo.customers.edit', $company->id));

        $response->assertStatus(200);
    }

    public function test_edit_customer_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $company = Company::factory()->create();

        $response = $this->get(route('seo.customers.edit', $company->id));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_customer() {
        $user = $this->login(5);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.update', $company->id), [
            'name' => $company->name,
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_customer()
    {
        $user = $this->login(1);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.update', $company->id), [
            'name' => $company->name,
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_archive_customer() {
        $user = $this->login(5);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.update', $company->id), [
            'name' => $company->name,
            'archived' => true
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_archive_customer() {
        $user = $this->login(1);

        $company = Company::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.customers.update', $company->id), [
            'name' => $company->name,
            'archived' => true
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_archived_customer_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.customers.archived'));

        $response->assertStatus(200);
    }

    public function test_archived_customer_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.customers.archived'));

        $response->assertStatus(403);
    }

    public function test_user_can_recover_customer() {
        $user = $this->login(5);

        $company = Company::factory()->create([
            'archived' => true
        ]);

        $response = $this->actingAs($user)->post(route('seo.customers.recover', $company->id));

        $response->assertStatus(200);
    }

    public function test_user_is_not_allowed_to_recover_customer() {
        $user = $this->login(1);

        $company = Company::factory()->create([
            'archived' => true
        ]);

        $response = $this->actingAs($user)->post(route('seo.customers.recover', $company->id));

        $response->assertStatus(403);
    }
}
