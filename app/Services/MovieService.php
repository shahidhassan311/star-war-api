<?php

namespace App\Services;

use App\Models\Movie;
use App\Services\Admin\AgentServices;
use Illuminate\Support\Facades\Http;

class MovieService
{
    protected $baseUrl, $token;

    private static $instance;

    private $movieModel;

    public function __construct()
    {
        $this->token = config('services.tmdb.token');
        $this->baseUrl = 'https://api.themoviedb.org/3/';
        $this->movieModel = new Movie();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new MovieService();
        }
        return self::$instance;
    }

    public function getPopularMovies()
    {
        try {
            $response = Http::withToken($this->token)
                ->get($this->baseUrl . 'movie/popular');

            if ($response->successful()) {
                return $response->json()['results'];
            } else {
                throw new \Exception('Error fetching popular movies: ' . $response->status());
            }
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function findMovie($id)
    {
        try {

            $user = auth()->user();
            $movie =  $this->movieModel->where('user_id', $user->id)->findOrFail($id);

            return $movie;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function storeMovies($moviesData)
    {
        try {
            $chunkedMovies = array_chunk($moviesData, 50);

            foreach ($chunkedMovies as $chunk) {
                $this->processChunk($chunk);
            }

            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }

    private function processChunk($moviesChunk)
    {
        foreach ($moviesChunk as $movieData) {
            $existingMovie = $this->movieModel->where('external_id', $movieData['id'])->first();

            if (!$existingMovie) {
                $user = auth()->user();
                $user->movies()->create([
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
                ]);
            }
        }
    }

    public function store($validatedData)
    {
        try {

            $user = auth()->user();
            $movie = $user->movies()->create($validatedData);

            return $movie;

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update($validatedData, $id)
    {
        try {
            $user = auth()->user();
            $movie = $this->movieModel->where('user_id', $user->id)->findOrFail($id);

            $movie->update($validatedData);

            return $movie;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function delete($id)
    {
        try {

            $user = auth()->user();
            $movie =  $this->movieModel->where('user_id', $user->id)->findOrFail($id);
            $movie->delete();

            return $movie;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function filter($request)
    {
        try {

            $query = $this->movieModel->query();

            if ($request->has('title')) {
                $title = trim($request->input('title'));
                $title = mb_strtolower($title, 'UTF-8');
                $query->whereRaw('LOWER(title) LIKE ?', ["%$title%"]);
            }

            $movies = $query->get();

            return $movies;
        } catch (\Exception $e) {
            return $e;
        }
    }

}
