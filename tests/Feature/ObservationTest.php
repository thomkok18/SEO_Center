<?php

namespace Tests\Feature;

use App\Models\Check;
use App\Models\Observation;
use App\Models\ObservationCheck;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class ObservationTest extends TestCase
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

    public function test_observation_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.observations.index'));

        $response->assertStatus(200);
    }

    public function test_observation_screen_is_not_allowed_to_be_rendered()
    {
        $this->login(1);

        $response = $this->get(route('seo.observations.index'));

        $response->assertStatus(403);
    }

    public function test_add_observation_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.observations.create', 1));

        $response->assertStatus(200);
    }

    public function test_add_observation_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.observations.create', 1));

        $response->assertStatus(403);
    }

    public function test_user_can_add_observation() {
        $user = $this->login(5);

        $response = $this->actingAs($user)->post(route('seo.observations.store', 1), [
            'name_en' => '403 error',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_adding_observation()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->post(route('seo.observations.store', 1), [
            'name_en' => '403 error',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_edit_observation_screen_can_be_rendered()
    {
        $this->login(5);

        $observation = Observation::factory()->create();

        $response = $this->get(route('seo.observations.edit', $observation->id));

        $response->assertStatus(200);
    }

    public function test_edit_observation_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $observation = Observation::factory()->create();

        $response = $this->get(route('seo.observations.edit', $observation->id));

        $response->assertStatus(403);
    }

    public function test_user_can_edit_observation() {
        $user = $this->login(5);

        $response = $this->actingAs($user)->patch(route('seo.observations.update', 1), [
            'name_en' => '404 error',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_editing_observation()
    {
        $user = $this->login(1);

        $response = $this->actingAs($user)->patch(route('seo.observations.update', 1), [
            'name_en' => '404 error',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_user_can_archive_observation() {
        $user = $this->login(5);

        $observation = Observation::factory()->create();

        $response = $this->actingAs($user)->post(route('seo.observations.archive', $observation->id), [
            'name_en' => $observation->name_en,
            'archived' => true
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_user_is_not_allowed_to_archive_observation() {
        $user = $this->login(1);

        $observation = Observation::factory()->create();

        $response = $this->actingAs($user)->post(route('seo.observations.archive', $observation->id), [
            'name_en' => $observation->name_en,
            'archived' => true
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(403);
    }

    public function test_archived_observation_screen_can_be_rendered()
    {
        $this->login(5);

        $response = $this->get(route('seo.observations.archived'));

        $response->assertStatus(200);
    }

    public function test_archived_observation_screen_rendering_is_not_allowed()
    {
        $this->login(1);

        $response = $this->get(route('seo.observations.archived'));

        $response->assertStatus(403);
    }

    public function test_user_can_recover_observation() {
        $user = $this->login(5);

        $observation = Observation::factory()->create([
            'archived' => true
        ]);
        $check = Check::factory()->create();
        ObservationCheck::factory()->create([
            'observation_id' => $observation->id,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->post(route('seo.observations.recover', $observation->id));

        $response->assertStatus(200);
    }

    public function test_user_is_not_allowed_to_recover_observation() {
        $user = $this->login(1);

        $observation = Observation::factory()->create([
            'archived' => true
        ]);
        $check = Check::factory()->create();
        ObservationCheck::factory()->create([
            'observation_id' => $observation->id,
            'check_id' => $check->id
        ]);

        $response = $this->actingAs($user)->post(route('seo.observations.recover', $observation->id));

        $response->assertStatus(403);
    }
}
