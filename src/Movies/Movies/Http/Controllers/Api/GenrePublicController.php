<?php

namespace Movies\Movies\Http\Controllers\Api;

use App\Http\Controllers\Api\PublicController as BaseController;
use Movies\Movies\Interfaces\GenreRepositoryInterface;
use Movies\Movies\Repositories\Presenter\GenreItemTransformer;

/**
 * Pubic API controller class.
 */
class GenrePublicController extends BaseController
{
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
            ->setPresenter('\\Movies\\Movies\\Repositories\\Presenter\\GenreListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $genres['code'] = 2000;
        return response()->json($genres)
                ->setStatusCode(200, 'INDEX_SUCCESS');
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
        $genre = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($genre)) {
            $genre         = $this->itemPresenter($module, new GenreItemTransformer);
            $genre['code'] = 2001;
            return response()->json($genre)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
