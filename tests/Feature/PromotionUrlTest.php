<?php

namespace Tests\Feature;

use App\Models\Check;
use App\Models\ConclusionType;
use App\Models\PromotionUrl;
use App\Models\PromotionUrlCheck;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class PromotionUrlTest extends TestCase
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

    public function test_promotion_urls_supplier_screen_can_be_rendered()
    {
        $this->login(3);

        $response = $this->get(route('supplier.promotion-urls.index'));

        $response->assertStatus(200);
    }

    public function test_promotion_urls_supplier_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('supplier.promotion-urls.index'));

        $response->assertStatus(403);
    }

    public function test_create_promotion_url_screen_can_be_rendered()
    {
        $this->login(3);

        $response = $this->get(route('supplier.promotion-urls.create'));

        $response->assertStatus(200);
    }

    public function test_create_promotion_url_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('supplier.promotion-urls.create'));

        $response->assertStatus(403);
    }

    public function test_user_can_add_promotion_url()
    {
        $user = $this->login(3);

        $response = $this->actingAs($user)->post(route('supplier.promotion-urls.store'), [
            'customer_id' => 1,
            'url_type_id' => 1,
            'website_id' => 3,
            'promotion_url' => 'https://www.test.com',
            'custom_price' => 5.50,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_promotion_url()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('supplier.promotion-urls.store'), [
            'customer_id' => 1,
            'url_type_id' => 1,
            'website_id' => 3,
            'promotion_url' => 'https://www.test.com',
            'custom_price' => 5.50,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_promotion_url_screen_can_be_rendered()
    {
        $this->login(3);

        $promotionUrl = PromotionUrl::factory()->create();

        $response = $this->get(route('supplier.promotion-urls.edit', $promotionUrl->id));

        $response->assertStatus(200);
    }

    public function test_edit_promotion_url_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create();

        $response = $this->get(route('supplier.promotion-urls.edit', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_promotion_url() {
        $user = $this->login(3);

        $promotionUrl = PromotionUrl::factory()->create();

        $response = $this->actingAs($user)->patch(route('supplier.promotion-urls.update', $promotionUrl->id), [
            'customer_id' => $promotionUrl->customer_id,
            'url_type_id' => $promotionUrl->url_type_id,
            'price_type_id' => $promotionUrl->price_type_id,
            'website_id' => 3,
            'promotion_url' => $promotionUrl->promotion_url,
            'custom_price' => $promotionUrl->custom_price,
            'archived' => false,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_promotion_url()
    {
        $user = $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create();

        $response = $this->actingAs($user)->patch(route('supplier.promotion-urls.update', $promotionUrl->id), [
            'customer_id' => $promotionUrl->customer_id,
            'url_type_id' => $promotionUrl->url_type_id,
            'price_type_id' => $promotionUrl->price_type_id,
            'website_id' => 3,
            'promotion_url' => $promotionUrl->promotion_url,
            'custom_price' => $promotionUrl->custom_price,
            'archived' => false,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_archive_promotion_url() {
        $user = $this->login(3);

        $promotionUrl = PromotionUrl::factory()->create();
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->post(route('supplier.promotion-urls.archive', $promotionUrl->id));

        $response->assertStatus(200);
    }

    public function test_user_is_not_allowed_to_archive_promotion_url() {
        $user = $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create();
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->post(route('supplier.promotion-urls.archive', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_promotion_url_can_not_be_archived() {
        $user = $this->login(3);

        $promotionUrl = PromotionUrl::factory()->create();
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => 1,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->post(route('supplier.promotion-urls.archive', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_user_can_delete_promotion_url() {
        $user = $this->login(3);

        $promotionUrl = PromotionUrl::factory()->create();
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => 1,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->delete(route('supplier.promotion-urls.destroy', $promotionUrl->id));

        $response->assertStatus(200);
    }

    public function test_user_is_not_allowed_to_destroy_promotion_url() {
        $user = $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create();
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => 1,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->delete(route('supplier.promotion-urls.destroy', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_promotion_url_can_not_be_deleted() {
        $user = $this->login(3);

        $promotionUrl = PromotionUrl::factory()->create();
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->delete(route('supplier.promotion-urls.destroy', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_archived_promotion_url_screen_can_be_rendered()
    {
        $this->login(3);

        $response = $this->get(route('supplier.promotion-urls.archived'));

        $response->assertStatus(200);
    }

    public function test_archived_promotion_url_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('supplier.promotion-urls.archived'));

        $response->assertStatus(403);
    }

    public function test_user_can_recover_promotion_url() {
        $user = $this->login(3);

        $promotionUrl = PromotionUrl::factory()->create([
            'archived' => true
        ]);
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->post(route('supplier.promotion-urls.recover', $promotionUrl->id));

        $response->assertStatus(200);
    }

    public function test_user_is_not_allowed_to_recover_promotion_url() {
        $user = $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create([
            'archived' => true
        ]);
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->post(route('supplier.promotion-urls.recover', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_show_promotion_url_screen_can_be_rendered()
    {
        $this->login(3);

        $promotionUrl = PromotionUrl::factory()->create();
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->get(route('supplier.promotion-urls.show', $promotionUrl->id));

        $response->assertStatus(200);
    }

    public function test_show_promotion_url_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create();
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->get(route('supplier.promotion-urls.show', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_check_pending_promotion_url_screen_can_be_rendered()
    {
        $this->login(5);

        $promotionUrl = PromotionUrl::factory()->create([
            'conclusion_id' => ConclusionType::PENDING,
        ]);
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->get(route('seo.promotion-urls.check', $promotionUrl->id));

        $response->assertStatus(200);
    }

    public function test_check_pending_promotion_url_screen_can_not_be_rendered()
    {
        $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create([
            'conclusion_id' => ConclusionType::PENDING,
        ]);
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->get(route('seo.promotion-urls.check', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_check_accepted_promotion_url_screen_can_be_rendered()
    {
        $this->login(5);

        $promotionUrl = PromotionUrl::factory()->create([
            'conclusion_id' => ConclusionType::ACCEPTED,
        ]);
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->get(route('seo.promotion-urls.check', $promotionUrl->id));

        $response->assertStatus(200);
    }

    public function test_check_accepted_promotion_url_screen_can_not_be_rendered()
    {
        $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create([
            'conclusion_id' => ConclusionType::ACCEPTED,
        ]);
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->get(route('seo.promotion-urls.check', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_check_denied_promotion_url_screen_can_be_rendered()
    {
        $this->login(5);

        $promotionUrl = PromotionUrl::factory()->create([
            'conclusion_id' => ConclusionType::DENIED,
        ]);
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->get(route('seo.promotion-urls.check', $promotionUrl->id));

        $response->assertStatus(200);
    }

    public function test_check_denied_promotion_url_screen_can_not_be_rendered()
    {
        $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create([
            'conclusion_id' => ConclusionType::DENIED,
        ]);
        $check = Check::factory()->create();
        PromotionUrlCheck::factory()->create([
            'promotion_url_id' => $promotionUrl->id,
            'check_id' => $check->id
        ]);

        $response = $this->get(route('seo.promotion-urls.check', $promotionUrl->id));

        $response->assertStatus(403);
    }

    public function test_user_can_check_promotion_url()
    {
        $this->login(5);

        $promotionUrl = PromotionUrl::factory()->create();

        $response = $this->get(route('seo.promotion-urls.checking', $promotionUrl->id));

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_checking_the_promotion_url()
    {
        $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create();

        $response = $this->get(route('seo.promotion-urls.checking', $promotionUrl->id));

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_evaluate_promotion_url() {
        $user = $this->login(5);

        $promotionUrl = PromotionUrl::factory()->create();

        $url = parse_url($promotionUrl->promotion_url);

        $response = $this->actingAs($user)->post(route('seo.promotion-urls.assessment', $promotionUrl->id), [
            'moz_indexed_at' => now(),
            'majestic_indexed_at' => now(),
            'domain_authority' => 0,
            'citation_flow' => 0,
            'trust_flow' => 0,
            'domain_name' => $url['scheme'] . '://' . $url['host'],
            'server_ip' => null,
            'http_status' => null,
            'page_language' => null,
            'page_title' => null,
            'page_description' => null,
            'commentary' => null,
            'measured_at' => now(),
            'latest_scan' => null,
            'latest_scan_update' => null,
            'follow_customer_backlinks' => null,
            'no_follow_customer_backlinks' => null,
            'follow_external_links' => null,
            'no_follow_external_links' => null,
            'follow_social_links' => null,
            'no_follow_socials' => null,
            'follow_internal_links' => null,
            'no_follow_internal_links' => null,
            'image_count' => null,
            'observationCheckboxes' => null,
            'conclusionRadios' => ConclusionType::DENIED,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_evaluate_promotion_url() {
        $user = $this->login(1);

        $promotionUrl = PromotionUrl::factory()->create();

        $url = parse_url($promotionUrl->promotion_url);

        $response = $this->actingAs($user)->post(route('seo.promotion-urls.assessment', $promotionUrl->id), [
            'moz_indexed_at' => now(),
            'majestic_indexed_at' => now(),
            'domain_authority' => 0,
            'citation_flow' => 0,
            'trust_flow' => 0,
            'domain_name' => $url['scheme'] . '://' . $url['host'],
            'server_ip' => null,
            'http_status' => null,
            'page_language' => null,
            'page_title' => null,
            'page_description' => null,
            'commentary' => null,
            'measured_at' => now(),
            'latest_scan' => null,
            'latest_scan_update' => null,
            'follow_customer_backlinks' => null,
            'no_follow_customer_backlinks' => null,
            'follow_external_links' => null,
            'no_follow_external_links' => null,
            'follow_social_links' => null,
            'no_follow_socials' => null,
            'follow_internal_links' => null,
            'no_follow_internal_links' => null,
            'image_count' => null,
            'observationCheckboxes' => null,
            'conclusionRadios' => ConclusionType::DENIED,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_website_promotion_url_screen_can_be_rendered()
    {
        $this->login(8);

        $response = $this->get(route('customer.promotion-urls', 1));

        $response->assertStatus(200);
    }

    public function test_website_promotion_url_screen_can_not_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('customer.promotion-urls', 1));

        $response->assertStatus(403);
    }

    public function test_website_score_history_screen_can_be_rendered()
    {
        $this->login(8);

        $response = $this->get(route('customer.website-score', 1));

        $response->assertStatus(200);
    }

    public function test_website_score_history_screen_can_not_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('customer.website-score', 1));

        $response->assertStatus(403);
    }
}
