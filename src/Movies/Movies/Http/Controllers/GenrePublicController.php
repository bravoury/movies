<?php

namespace Movies\Movies\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Movies\Movies\Interfaces\GenreRepositoryInterface;

class GenrePublicController extends BaseController
{
    // use GenreWorkflow;

    /**
     * Constructor.
     *
     * @param type \Movies\Genre\Interfaces\GenreRepositoryInterface $genre
     *
     * @return type
     */
    public function __construct(GenreRepositoryInterface $genre)
    {
        $this->repository = $genre;
        parent::__construct();
    }

    /**
     * Show genre's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $genres = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        return $this->theme->of('movies::public.genre.index', compact('genres'))->render();
    }

    /**
     * Show genre.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $genre = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('movies::public.genre.show', compact('genre'))->render();
    }

}
