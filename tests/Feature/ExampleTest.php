<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('movies.index'));
    }

    public function test_movies_page_loads(): void
    {
        $response = $this->get(route('movies.index'));

        $response->assertStatus(200);
    }

    public function test_can_view_movie_details(): void
    {
        $movie = \App\Models\Movie::factory()->create();

        $response = $this->get(route('movies.show', $movie));

        $response->assertStatus(200);
        $response->assertSee($movie->title);
    }

    public function test_can_view_seat_selection(): void
    {
        $movie = \App\Models\Movie::factory()->create();
        $show = \App\Models\Show::factory()->create(['movie_id' => $movie->id]);

        $response = $this->get(route('shows.seats', $show));

        $response->assertStatus(200);
    }

    public function test_reservation_lookup_page_loads(): void
    {
        $response = $this->get(route('reservations.lookup'));

        $response->assertStatus(200);
    }

    public function test_login_page_loads(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function test_register_page_loads(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    public function test_user_can_register(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('movies.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    public function test_regular_user_cannot_access_admin(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(302);
    }
}
