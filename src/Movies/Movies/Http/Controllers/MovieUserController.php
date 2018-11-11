<?php

namespace Movies\Movies\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Movies\Movies\Http\Requests\MovieRequest;
use Movies\Movies\Interfaces\MovieRepositoryInterface;
use Movies\Movies\Models\Movie;

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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(MovieRequest $request)
    {
        $movies = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('movies::movie.names'));

        return $this->theme->of('movies::user.movie.index', compact('movies'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Movie $movie
     *
     * @return Response
     */
    public function show(MovieRequest $request, Movie $movie)
    {
        Form::populate($movie);

        return $this->theme->of('movies::user.movie.show', compact('movie'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MovieRequest $request)
    {

        $movie = $this->repository->newInstance([]);
        Form::populate($movie);

        $this->theme->prependTitle(trans('movies::movie.names'));
        return $this->theme->of('movies::user.movie.create', compact('movie'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MovieRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $movie = $this->repository->create($attributes);

            return redirect(trans_url('/user/movies/movie'))
                -> with('message', trans('messages.success.created', ['Module' => trans('movies::movie.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Movie $movie
     *
     * @return Response
     */
    public function edit(MovieRequest $request, Movie $movie)
    {

        Form::populate($movie);
        $this->theme->prependTitle(trans('movies::movie.names'));

        return $this->theme->of('movies::user.movie.edit', compact('movie'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Movie $movie
     *
     * @return Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        try {
            $this->repository->update($request->all(), $movie->getRouteKey());

            return redirect(trans_url('/user/movies/movie'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('movies::movie.name')]))
                ->with('code', 204);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(MovieRequest $request, Movie $movie)
    {
        try {
            $this->repository->delete($movie->getRouteKey());
            return redirect(trans_url('/user/movies/movie'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('movies::movie.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
