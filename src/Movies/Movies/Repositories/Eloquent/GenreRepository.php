<?php

namespace Movies\Movies\Repositories\Eloquent;

use Movies\Movies\Interfaces\GenreRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class GenreRepository extends BaseRepository implements GenreRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('movies.movies.genre.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('movies.movies.genre.model');
    }
}
