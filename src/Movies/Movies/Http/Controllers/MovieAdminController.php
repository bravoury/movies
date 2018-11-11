<?php

namespace Movies\Movies\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Movies\Movies\Http\Requests\MovieRequest;
use Movies\Movies\Interfaces\MovieRepositoryInterface;
use Movies\Movies\Models\Movie;

/**
 * Admin web controller class.
 */
class MovieAdminController extends BaseController
{
    // use MovieWorkflow;
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
        parent::__construct();
    }

    /**
     * Display a list of movie.
     *
     * @return Response
     */
    public function index(MovieRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('movies::movie.names').' :: ');
        return $this->theme->of('movies::admin.movie.index')->render();
    }

    /**
     * Display a list of movie.
     *
     * @return Response
     */
    public function getJson(MovieRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $movies  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Movies\\Movies\\Repositories\\Presenter\\MovieListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $movies['recordsTotal']    = $movies['meta']['pagination']['total'];
        $movies['recordsFiltered'] = $movies['meta']['pagination']['total'];
        $movies['request']         = $request->all();
        return response()->json($movies, 200);

    }

    /**
     * Display movie.
     *
     * @param Request $request
     * @param Model   $movie
     *
     * @return Response
     */
    public function show(MovieRequest $request, Movie $movie)
    {
        if (!$movie->exists) {
            return response()->view('movies::admin.movie.new', compact('movie'));
        }

        Form::populate($movie);
        return response()->view('movies::admin.movie.show', compact('movie'));
    }

    /**
     * Show the form for creating a new movie.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MovieRequest $request)
    {

        $movie = $this->repository->newInstance([]);

        Form::populate($movie);

        return response()->view('movies::admin.movie.create', compact('movie'));

    }

    /**
     * Create new movie.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MovieRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $movie          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('movies::movie.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/movies/movie/'.$movie->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
        }
    }

    /**
     * Show movie for editing.
     *
     * @param Request $request
     * @param Model   $movie
     *
     * @return Response
     */
    public function edit(MovieRequest $request, Movie $movie)
    {
        Form::populate($movie);
        return  response()->view('movies::admin.movie.edit', compact('movie'));
    }

    /**
     * Update the movie.
     *
     * @param Request $request
     * @param Model   $movie
     *
     * @return Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        try {

            $attributes = $request->all();

            $movie->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('movies::movie.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/movies/movie/'.$movie->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/movies/movie/'.$movie->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the movie.
     *
     * @param Model   $movie
     *
     * @return Response
     */
    public function destroy(MovieRequest $request, Movie $movie)
    {

        try {

            $t = $movie->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('movies::movie.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/movies/movie/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/movies/movie/'.$movie->getRouteKey()),
            ], 400);
        }
    }

}
