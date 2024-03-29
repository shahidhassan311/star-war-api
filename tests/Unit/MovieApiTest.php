<?php

namespace Tests\Unit;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class MovieApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_movie_star_war_api_and_store()
    {
        $user = User::factory()->create();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get(route('movie.star.war'));

        $response->assertStatus(200);

        $response->assertJsonFragment(['message' => 'Popular Movies']);
    }

    public function test_movie_get()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create(['user_id' => $user->id]);

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get("/api/movie/{$movie->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Movie',
                'data' => $movie->toArray(),
            ]);
    }

    public function test_store_movie()
    {
        $user = User::factory()->create();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->postJson('/api/movie-store', [
            'external_id' => mt_rand(100000, 999999),
            'title' => 'Test Movie',
            'overview' => 'This is a test movie',
            'release_date' => '2024-04-01',
            'popularity' => 7.5,
            'vote_average' => 8.0,
            'vote_count' => 1000,
            'original_language' => 'en',
            'poster_path' => '/path/to/poster',
            'backdrop_path' => '/path/to/backdrop',
            'adult' => false,
            'video' => true,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Movies Store Successfully',
            ]);
    }

    public function test_update_movie()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create(['user_id' => $user->id]);

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->putJson("/api/movie-update/{$movie->id}", [
            'title' => 'Updated Test Movie',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Movie updated successfully',
            ]);
    }

    public function test_delete_movie()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create(['user_id' => $user->id]);

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->delete("/api/movie-delete/{$movie->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Movie deleted successfully',
            ]);
    }

    public function test_movie_filter()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create(['user_id' => $user->id]);

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get("/api/movie-filter?title=" . urlencode($movie->title)); // Pass the movie title as the query parameter

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => $movie->title]);
    }

}

