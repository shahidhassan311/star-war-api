<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MovieApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_movies_list()
    {
        $user = User::factory()->create();

        $token = auth()->tokenById($user->id);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->get(route('movies'));


        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'overview',
                    'release_date',
                    'popularity',
                    'vote_average',
                    'vote_count',
                    'original_language',
                    'poster_path',
                    'backdrop_path',
                    'adult',
                    'video',
                ]
            ]
        ]);

        $response->assertJsonFragment(['message' => 'Popular Movies']);

    }
}

