<?php

namespace Tests\Feature;

use App\Models\Broker;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_access_user_route_with_authentication(): void
    {
        $user = User::factory()->create();

        $this->assertAuthenticatedAs($user, 'sanctum')
            ->getJson('/api/user')
            ->assertSuccessful()
            ->assertJson(['id' => $user->id]);
    }

    /** @test */
    public function it_can_login(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = 'password')]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertSuccessful();

    }

    /** @test */
    public function it_can_register(): void
    {
        $faker = \Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;
        $password = $faker->password;

        $response = $this->postJson('/api/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'data' => [
                    'user' => [
                        'name' => $name,
                        'email' => $email,
                    ],
                    'token' => true,
                ],
                'message' => null,
            ]);
    }

    /** @test */
    public function it_can_access_public_brokers_routes(): void
    {
        $broker = Broker::factory()->create();

        $response = $this->getJson('/api/brokers');
        $response->assertSuccessful();

        $response = $this->getJson("/api/brokers/{$broker->id}");
        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_access_public_properties_routes(): void
    {
        $property = Property::factory()->create();

        $response = $this->getJson('/api/properties');
        $response->assertSuccessful();

        $response = $this->getJson("/api/properties/{$property->id}");
        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_access_protected_brokers_routes_with_authentication(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user->fresh(), 'sanctum');

        $broker = Broker::factory()->make();

        $response = $this->postJson('/api/brokers', $broker->toArray());
        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_access_protected_properties_routes_with_authentication(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum');

        $property = Property::factory()->make();

        $response = $this->postJson('/api/properties', $property->toArray());
        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/logout');
        $response->assertSuccessful();
    }
}
