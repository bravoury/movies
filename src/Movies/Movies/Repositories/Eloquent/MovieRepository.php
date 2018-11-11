<?php

namespace Movies\Movies\Repositories\Eloquent;

use Movies\Movies\Interfaces\MovieRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class MovieRepository extends BaseRepository implements MovieRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('movies.movies.movie.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('movies.movies.movie.model');
    }
}
