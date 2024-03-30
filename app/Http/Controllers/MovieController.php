<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Services\MovieService;
use Illuminate\Http\Request;

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

        $movie = $this->movieService->storeMovies($popularMovies);

        if ($movie instanceof \Exception)
            return APIResponse::exception();

        return APIResponse::success("Popular Movies", $popularMovies);
    }

    public function getMovie($id)
    {
        $movie = $this->movieService->findMovie($id);

        if ($movie instanceof \Exception)
            return APIResponse::exception();

        return APIResponse::success("Movie", $movie->toArray());

    }

    public function store(MovieStoreRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['external_id'] = mt_rand(100000, 999999);

        $movie = $this->movieService->store($validatedData);

        if ($movie instanceof \Exception)
            return APIResponse::exception();

        return APIResponse::success("Movies Store Successfully", $movie->toArray());

    }

    public function update(MovieUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();

        $movie = $this->movieService->update($validatedData, $id);

        if ($movie instanceof \Exception)
            return APIResponse::exception();

        return APIResponse::success("Movie updated successfully", $movie->toArray());
    }

    public function destroy($id)
    {
        $movie = $this->movieService->delete($id);

        if ($movie instanceof \Exception)
            return APIResponse::exception();

        return APIResponse::success("Movie deleted successfully");
    }

    public function filter(Request $request)
    {
        $movie = $this->movieService->filter($request);

        if ($movie instanceof \Exception)
            return APIResponse::exception();

        return APIResponse::success("Movie List", $movie->toArray());

    }

}


