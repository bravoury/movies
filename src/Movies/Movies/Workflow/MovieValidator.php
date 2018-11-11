<?php

namespace Movies\Movies\Workflow;

use Movies\Movies\Models\Movie;
use Validator;

class MovieValidator
{

    /**
     * Determine if the given movie is valid for complete status.
     *
     * @param Movie $movie
     *
     * @return bool / Validator
     */
    public function complete(Movie $movie)
    {
        return Validator::make($movie->toArray(), [
            'title' => 'required|min:15',
        ]);
    }

    /**
     * Determine if the given movie is valid for verify status.
     *
     * @param Movie $movie
     *
     * @return bool / Validator
     */
    public function verify(Movie $movie)
    {
        return Validator::make($movie->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:complete',
        ]);
    }

    /**
     * Determine if the given movie is valid for approve status.
     *
     * @param Movie $movie
     *
     * @return bool / Validator
     */
    public function approve(Movie $movie)
    {
        return Validator::make($movie->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:verify',
        ]);

    }

    /**
     * Determine if the given movie is valid for publish status.
     *
     * @param Movie $movie
     *
     * @return bool / Validator
     */
    public function publish(Movie $movie)
    {
        return Validator::make($movie->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,archive,unpublish',
        ]);

    }

    /**
     * Determine if the given movie is valid for archive status.
     *
     * @param Movie $movie
     *
     * @return bool / Validator
     */
    public function archive(Movie $movie)
    {
        return Validator::make($movie->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,publish,unpublish',
        ]);

    }

    /**
     * Determine if the given movie is valid for unpublish status.
     *
     * @param Movie $movie
     *
     * @return bool / Validator
     */
    public function unpublish(Movie $movie)
    {
        return Validator::make($movie->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:publish',
        ]);

    }
}
