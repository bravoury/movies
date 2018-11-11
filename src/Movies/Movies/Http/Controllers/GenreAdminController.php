<?php

namespace Movies\Movies\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Movies\Movies\Http\Requests\GenreRequest;
use Movies\Movies\Interfaces\GenreRepositoryInterface;
use Movies\Movies\Models\Genre;

/**
 * Admin web controller class.
 */
class GenreAdminController extends BaseController
{
    // use GenreWorkflow;
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
        parent::__construct();
    }

    /**
     * Display a list of genre.
     *
     * @return Response
     */
    public function index(GenreRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('movies::genre.names').' :: ');
        return $this->theme->of('movies::admin.genre.index')->render();
    }

    /**
     * Display a list of genre.
     *
     * @return Response
     */
    public function getJson(GenreRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $genres  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Movies\\Movies\\Repositories\\Presenter\\GenreListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $genres['recordsTotal']    = $genres['meta']['pagination']['total'];
        $genres['recordsFiltered'] = $genres['meta']['pagination']['total'];
        $genres['request']         = $request->all();
        return response()->json($genres, 200);

    }

    /**
     * Display genre.
     *
     * @param Request $request
     * @param Model   $genre
     *
     * @return Response
     */
    public function show(GenreRequest $request, Genre $genre)
    {
        if (!$genre->exists) {
            return response()->view('movies::admin.genre.new', compact('genre'));
        }

        Form::populate($genre);
        return response()->view('movies::admin.genre.show', compact('genre'));
    }

    /**
     * Show the form for creating a new genre.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(GenreRequest $request)
    {

        $genre = $this->repository->newInstance([]);

        Form::populate($genre);

        return response()->view('movies::admin.genre.create', compact('genre'));

    }

    /**
     * Create new genre.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(GenreRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $genre          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('movies::genre.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/movies/genre/'.$genre->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
        }
    }

    /**
     * Show genre for editing.
     *
     * @param Request $request
     * @param Model   $genre
     *
     * @return Response
     */
    public function edit(GenreRequest $request, Genre $genre)
    {
        Form::populate($genre);
        return  response()->view('movies::admin.genre.edit', compact('genre'));
    }

    /**
     * Update the genre.
     *
     * @param Request $request
     * @param Model   $genre
     *
     * @return Response
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        try {

            $attributes = $request->all();

            $genre->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('movies::genre.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/movies/genre/'.$genre->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/movies/genre/'.$genre->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the genre.
     *
     * @param Model   $genre
     *
     * @return Response
     */
    public function destroy(GenreRequest $request, Genre $genre)
    {

        try {

            $t = $genre->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('movies::genre.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/movies/genre/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/movies/genre/'.$genre->getRouteKey()),
            ], 400);
        }
    }

}
