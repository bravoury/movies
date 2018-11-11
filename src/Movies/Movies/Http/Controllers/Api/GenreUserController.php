<?php

namespace Movies\Movies\Http\Controllers\Api;

use App\Http\Controllers\Api\UserController as BaseController;
use Movies\Movies\Http\Requests\GenreRequest;
use Movies\Movies\Interfaces\GenreRepositoryInterface;
use Movies\Movies\Models\Genre;

/**
 * User API controller class.
 */
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
     * Display a list of genre.
     *
     * @return json
     */
    public function index(GenreRequest $request)
    {
        $genres  = $this->repository
            ->setPresenter('\\Movies\\Movies\\Repositories\\Presenter\\GenreListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $genres['code'] = 2000;
        return response()->json($genres) 
            ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display genre.
     *
     * @param Request $request
     * @param Model   Genre
     *
     * @return Json
     */
    public function show(GenreRequest $request, Genre $genre)
    {

        if ($genre->exists) {
            $genre         = $genre->presenter();
            $genre['code'] = 2001;
            return response()->json($genre)
                ->setStatusCode(200, 'SHOW_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new genre.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(GenreRequest $request, Genre $genre)
    {
        $genre         = $genre->presenter();
        $genre['code'] = 2002;
        return response()->json($genre)
            ->setStatusCode(200, 'CREATE_SUCCESS');
    }

    /**
     * Create new genre.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(GenreRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $genre          = $this->repository->create($attributes);
            $genre          = $genre->presenter();
            $genre['code']  = 2004;

            return response()->json($genre)
                ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }

    }

    /**
     * Show genre for editing.
     *
     * @param Request $request
     * @param Model   $genre
     *
     * @return json
     */
    public function edit(GenreRequest $request, Genre $genre)
    {
        if ($genre->exists) {
            $genre         = $genre->presenter();
            $genre['code'] = 2003;
            return response()-> json($genre)
                ->setStatusCode(200, 'EDIT_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }
    }

    /**
     * Update the genre.
     *
     * @param Request $request
     * @param Model   $genre
     *
     * @return json
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        try {

            $attributes = $request->all();

            $genre->update($attributes);
            $genre         = $genre->presenter();
            $genre['code'] = 2005;

            return response()->json($genre)
                ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the genre.
     *
     * @param Request $request
     * @param Model   $genre
     *
     * @return json
     */
    public function destroy(GenreRequest $request, Genre $genre)
    {

        try {

            $t = $genre->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('movies::genre.name')]),
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
