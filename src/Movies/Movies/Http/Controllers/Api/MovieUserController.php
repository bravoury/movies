<?php

namespace Movies\Movies\Http\Controllers\Api;

use App\Http\Controllers\Api\UserController as BaseController;
use Movies\Movies\Http\Requests\MovieRequest;
use Movies\Movies\Interfaces\MovieRepositoryInterface;
use Movies\Movies\Models\Movie;

/**
 * User API controller class.
 */
class MovieUserController extends BaseController
{
    /**
     * Initialize movie controller.
     *
     * @param type MovieRepositoryInterface $movie
     *
     * @return type
     */
    public function __construct(MovieRepositoryInterface $movie)
    {
        $this->repository = $movie;
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Movies\Movies\Repositories\Criteria\MovieUserCriteria());
        parent::__construct();
    }

    /**
     * Display a list of movie.
     *
     * @return json
     */
    public function index(MovieRequest $request)
    {
        $movies  = $this->repository
            ->setPresenter('\\Movies\\Movies\\Repositories\\Presenter\\MovieListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $movies['code'] = 2000;
        return response()->json($movies) 
            ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display movie.
     *
     * @param Request $request
     * @param Model   Movie
     *
     * @return Json
     */
    public function show(MovieRequest $request, Movie $movie)
    {

        if ($movie->exists) {
            $movie         = $movie->presenter();
            $movie['code'] = 2001;
            return response()->json($movie)
                ->setStatusCode(200, 'SHOW_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new movie.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(MovieRequest $request, Movie $movie)
    {
        $movie         = $movie->presenter();
        $movie['code'] = 2002;
        return response()->json($movie)
            ->setStatusCode(200, 'CREATE_SUCCESS');
    }

    /**
     * Create new movie.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(MovieRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $movie          = $this->repository->create($attributes);
            $movie          = $movie->presenter();
            $movie['code']  = 2004;

            return response()->json($movie)
                ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }

    }

    /**
     * Show movie for editing.
     *
     * @param Request $request
     * @param Model   $movie
     *
     * @return json
     */
    public function edit(MovieRequest $request, Movie $movie)
    {
        if ($movie->exists) {
            $movie         = $movie->presenter();
            $movie['code'] = 2003;
            return response()-> json($movie)
                ->setStatusCode(200, 'EDIT_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }
    }

    /**
     * Update the movie.
     *
     * @param Request $request
     * @param Model   $movie
     *
     * @return json
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        try {

            $attributes = $request->all();

            $movie->update($attributes);
            $movie         = $movie->presenter();
            $movie['code'] = 2005;

            return response()->json($movie)
                ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the movie.
     *
     * @param Request $request
     * @param Model   $movie
     *
     * @return json
     */
    public function destroy(MovieRequest $request, Movie $movie)
    {

        try {

            $t = $movie->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('movies::movie.name')]),
                'code'     => 2006
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }
    }
}
