<?php

namespace Movies\Movies;

use User;

class Movies
{
    /**
     * $movie object.
     */
    protected $movie;
    /**
     * $genre object.
     */
    protected $genre;

    /**
     * Constructor.
     */
    public function __construct(\Movies\Movies\Interfaces\MovieRepositoryInterface $movie,
        \Movies\Movies\Interfaces\GenreRepositoryInterface $genre)
    {
        $this->movie = $movie;
        $this->genre = $genre;
    }

    /**
     * Returns count of movies.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return  0;
    }

    /**
     * Make gadget View
     *
     * @param string $view
     *
     * @param int $count
     *
     * @return View
     */
    public function gadget($view = 'admin.movie.gadget', $count = 10)
    {

        if (User::hasRole('user')) {
            $this->movie->pushCriteria(new \Litepie\Movies\Repositories\Criteria\MovieUserCriteria());
        }

        $movie = $this->movie->scopeQuery(function ($query) use ($count) {
            return $query->orderBy('id', 'DESC')->take($count);
        })->all();

        return view('movies::' . $view, compact('movie'))->render();
    }
    /**
     * Make gadget View
     *
     * @param string $view
     *
     * @param int $count
     *
     * @return View
     */
    public function gadget($view = 'admin.genre.gadget', $count = 10)
    {

        if (User::hasRole('user')) {
            $this->genre->pushCriteria(new \Litepie\Movies\Repositories\Criteria\GenreUserCriteria());
        }

        $genre = $this->genre->scopeQuery(function ($query) use ($count) {
            return $query->orderBy('id', 'DESC')->take($count);
        })->all();

        return view('movies::' . $view, compact('genre'))->render();
    }
}
