<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\Http;

class MovieService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->token = config('services.tmdb.token');
        $this->baseUrl = 'https://api.themoviedb.org/3/';
    }

    public function getPopularMovies()
    {
        $response = Http::withToken($this->token )
            ->get($this->baseUrl . 'movie/popular')
            ->json()['results'];

        return $response;
    }

    public function storeMovies($moviesData)
    {
        try {
            foreach ($moviesData as $movieData) {
                $existingMovie = Movie::where('external_id', $movieData['id'])->first();

                if (!$existingMovie) {
                    Movie::create([
                        'external_id' => $movieData['id'],
                        'title' => $movieData['title'],
                        'overview' => $movieData['overview'],
                        'release_date' => $movieData['release_date'],
                        'popularity' => $movieData['popularity'],
                        'vote_average' => $movieData['vote_average'],
                        'vote_count' => $movieData['vote_count'],
                        'original_language' => $movieData['original_language'],
                        'poster_path' => $movieData['poster_path'],
                        'backdrop_path' => $movieData['backdrop_path'],
                        'adult' => $movieData['adult'],
                        'video' => $movieData['video'],
                        'user_id' => auth()->id(),
                    ]);
                }
            }

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
