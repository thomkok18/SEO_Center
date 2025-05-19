<?php

namespace Tests\Feature;

use App\Models\PriceType;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class PriceTypeTest extends TestCase
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

    public function test_promotion_url_price_type_seo_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.price-types.index'));

        $response->assertStatus(200);
    }

    public function test_promotion_url_price_type_seo_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.price-types.index'));

        $response->assertStatus(403);
    }

    public function test_create_promotion_url_price_type_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.price-types.create'));

        $response->assertStatus(200);
    }

    public function test_create_promotion_url_price_type_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.price-types.create'));

        $response->assertStatus(403);
    }

    public function test_user_can_add_promotion_url_price_type() {
        $user = $this->login(5);

        $response = $this->actingAs($user)->post(route('seo.price-types.store'), [
            'name_en' => 'test price',
            'name_nl' => 'test price',
            'price' => 12.34,
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_promotion_url_price_type()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('seo.price-types.store'), [
            'name_en' => 'test price',
            'name_nl' => 'test price',
            'price' => 12.34,
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_promotion_url_price_type_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.price-types.edit', 1));

        $response->assertStatus(200);
    }

    public function test_edit_promotion_url_price_type_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.price-types.edit', 1));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_promotion_url_price_type() {
        $user = $this->login(5);

        $priceType = PriceType::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.price-types.update', $priceType->id), [
            'name_en' => $priceType->name_en,
            'name_nl' => $priceType->name_nl,
            'price' => $priceType->price,
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_promotion_url_price_type()
    {
        $user = $this->login(1);

        $priceType = PriceType::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.price-types.update', $priceType->id), [
            'name_en' => $priceType->name_en,
            'name_nl' => $priceType->name_nl,
            'price' => $priceType->price,
            'archived' => false
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_archive_promotion_url_price_type() {
        $user = $this->login(5);

        $priceType = PriceType::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.price-types.update', $priceType->id), [
            'name_en' => $priceType->name_en,
            'name_nl' => $priceType->name_nl,
            'price' => $priceType->price,
            'archived' => true
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_archive_promotion_url_price_type() {
        $user = $this->login(1);

        $priceType = PriceType::factory()->create();

        $response = $this->actingAs($user)->patch(route('seo.price-types.update', $priceType->id), [
            'name_en' => $priceType->name_en,
            'name_nl' => $priceType->name_nl,
            'price' => $priceType->price,
            'archived' => true
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_archived_promotion_url_price_type_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.price-types.archived'));

        $response->assertStatus(200);
    }

    public function test_archived_promotion_url_price_type_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.price-types.archived'));

        $response->assertStatus(403);
    }

    public function test_user_can_recover_promotion_url_price_type() {
        $user = $this->login(5);

        $priceType = PriceType::factory()->create([
            'archived' => true
        ]);

        $response = $this->actingAs($user)->post(route('seo.price-types.recover', $priceType->id));

        $response->assertStatus(200);
    }

    public function test_user_is_not_allowed_to_recover_promotion_url_price_type() {
        $user = $this->login(1);

        $priceType = PriceType::factory()->create([
            'archived' => true
        ]);

        $response = $this->actingAs($user)->post(route('seo.price-types.recover', $priceType->id));

        $response->assertStatus(403);
    }
}
