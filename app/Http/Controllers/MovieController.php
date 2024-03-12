<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Services\MovieService;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $popularMovies = $this->movieService->getPopularMovies();

        if ($popularMovies instanceof \Exception)
            return APIResponse::exception();

        $this->movieService->storeMovies($popularMovies);

        return APIResponse::success("Popular Movies", $popularMovies);
    }
}


