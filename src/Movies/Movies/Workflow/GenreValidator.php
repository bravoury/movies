<?php

namespace Movies\Movies\Workflow;

use Movies\Movies\Models\Genre;
use Validator;

class GenreValidator
{

    /**
     * Determine if the given genre is valid for complete status.
     *
     * @param Genre $genre
     *
     * @return bool / Validator
     */
    public function complete(Genre $genre)
    {
        return Validator::make($genre->toArray(), [
            'title' => 'required|min:15',
        ]);
    }

    /**
     * Determine if the given genre is valid for verify status.
     *
     * @param Genre $genre
     *
     * @return bool / Validator
     */
    public function verify(Genre $genre)
    {
        return Validator::make($genre->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:complete',
        ]);
    }

    /**
     * Determine if the given genre is valid for approve status.
     *
     * @param Genre $genre
     *
     * @return bool / Validator
     */
    public function approve(Genre $genre)
    {
        return Validator::make($genre->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:verify',
        ]);

    }

    /**
     * Determine if the given genre is valid for publish status.
     *
     * @param Genre $genre
     *
     * @return bool / Validator
     */
    public function publish(Genre $genre)
    {
        return Validator::make($genre->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,archive,unpublish',
        ]);

    }

    /**
     * Determine if the given genre is valid for archive status.
     *
     * @param Genre $genre
     *
     * @return bool / Validator
     */
    public function archive(Genre $genre)
    {
        return Validator::make($genre->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,publish,unpublish',
        ]);

    }

    /**
     * Determine if the given genre is valid for unpublish status.
     *
     * @param Genre $genre
     *
     * @return bool / Validator
     */
    public function unpublish(Genre $genre)
    {
        return Validator::make($genre->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:publish',
        ]);

    }
}
