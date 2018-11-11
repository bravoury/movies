<?php

namespace Movies\Movies\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Movies\Movies\Http\Requests\GenreRequest;
use Movies\Movies\Interfaces\GenreRepositoryInterface;
use Movies\Movies\Models\Genre;

class GenreUserController extends BaseController
{
    /**
     * Initialize genre controller.
     *
     * @param type GenreRepositoryInterface $genre
     *
     * @return type
     */
    public function __construct(GenreRepositoryInterface $genre)
    {
        $this->repository = $genre;
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Movies\Movies\Repositories\Criteria\GenreUserCriteria());
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(GenreRequest $request)
    {
        $genres = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('movies::genre.names'));

        return $this->theme->of('movies::user.genre.index', compact('genres'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Genre $genre
     *
     * @return Response
     */
    public function show(GenreRequest $request, Genre $genre)
    {
        Form::populate($genre);

        return $this->theme->of('movies::user.genre.show', compact('genre'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(GenreRequest $request)
    {

        $genre = $this->repository->newInstance([]);
        Form::populate($genre);

        $this->theme->prependTitle(trans('movies::genre.names'));
        return $this->theme->of('movies::user.genre.create', compact('genre'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(GenreRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $genre = $this->repository->create($attributes);

            return redirect(trans_url('/user/movies/genre'))
                -> with('message', trans('messages.success.created', ['Module' => trans('movies::genre.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Genre $genre
     *
     * @return Response
     */
    public function edit(GenreRequest $request, Genre $genre)
    {

        Form::populate($genre);
        $this->theme->prependTitle(trans('movies::genre.names'));

        return $this->theme->of('movies::user.genre.edit', compact('genre'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Genre $genre
     *
     * @return Response
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        try {
            $this->repository->update($request->all(), $genre->getRouteKey());

            return redirect(trans_url('/user/movies/genre'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('movies::genre.name')]))
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
    public function destroy(GenreRequest $request, Genre $genre)
    {
        try {
            $this->repository->delete($genre->getRouteKey());
            return redirect(trans_url('/user/movies/genre'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('movies::genre.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
