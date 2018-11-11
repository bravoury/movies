<?php

namespace Movies\Movies\Http\Controllers\Api;

use App\Http\Controllers\Api\PublicController as BaseController;
use Movies\Movies\Interfaces\MovieRepositoryInterface;
use Movies\Movies\Repositories\Presenter\MovieItemTransformer;

/**
 * Pubic API controller class.
 */
class MoviePublicController extends BaseController
{
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
            ->setPresenter('\\Movies\\Movies\\Repositories\\Presenter\\MovieListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $movies['code'] = 2000;
        return response()->json($movies)
                ->setStatusCode(200, 'INDEX_SUCCESS');
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
        $movie = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($movie)) {
            $movie         = $this->itemPresenter($module, new MovieItemTransformer);
            $movie['code'] = 2001;
            return response()->json($movie)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
