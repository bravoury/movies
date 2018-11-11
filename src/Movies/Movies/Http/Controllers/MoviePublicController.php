<?php

namespace Movies\Movies\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Movies\Movies\Interfaces\MovieRepositoryInterface;

class MoviePublicController extends BaseController
{
    // use MovieWorkflow;

    /**
     * Constructor.
     *
     * @param type \Movies\Movie\Interfaces\MovieRepositoryInterface $movie
     *
     * @return type
     */
    public function __construct(MovieRepositoryInterface $movie)
    {
        $this->repository = $movie;
        parent::__construct();
    }

    /**
     * Show movie's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $movies = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        return $this->theme->of('movies::public.movie.index', compact('movies'))->render();
    }

    /**
     * Show movie.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $movie = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('movies::public.movie.show', compact('movie'))->render();
    }

}
