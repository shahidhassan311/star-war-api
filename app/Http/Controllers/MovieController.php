<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Services\MovieService;

class MovieController extends Controller
{
    protected $movieService;
    protected $token;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
        $this->token = config('services.tmdb.token');
    }

    public function index()
    {
        $popularMovies = $this->movieService->getPopularMovies($this->token);

        if ($popularMovies instanceof \Exception)
            return APIResponse::exception();

        return APIResponse::success("Popular Movies", $popularMovies);
    }
}


