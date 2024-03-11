<?php

namespace App\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class MovieService
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'https://api.themoviedb.org/3/';
    }

    public function getPopularMovies($token)
    {
        $response = Http::withToken($token)
            ->get($this->baseUrl . 'movie/popular')
            ->json()['results'];

        return $response;
    }
}
