<?php

namespace Movies\Movies\Workflow;

use Exception;
use Litepie\Workflow\Exceptions\WorkflowActionNotPerformedException;

use Movies\Movies\Models\Genre;

class GenreAction
{
    /**
     * Perform the complete action.
     *
     * @param Genre $genre
     *
     * @return Genre
     */
    public function complete(Genre $genre)
    {
        try {
            $genre->status = 'complete';
            return $genre->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the verify action.
     *
     * @param Genre $genre
     *
     * @return Genre
     */public function verify(Genre $genre)
    {
        try {
            $genre->status = 'verify';
            return $genre->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the approve action.
     *
     * @param Genre $genre
     *
     * @return Genre
     */public function approve(Genre $genre)
    {
        try {
            $genre->status = 'approve';
            return $genre->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the publish action.
     *
     * @param Genre $genre
     *
     * @return Genre
     */public function publish(Genre $genre)
    {
        try {
            $genre->status = 'publish';
            return $genre->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the archive action.
     *
     * @param Genre $genre
     *
     * @return Genre
     */
    public function archive(Genre $genre)
    {
        try {
            $genre->status = 'archive';
            return $genre->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the unpublish action.
     *
     * @param Genre $genre
     *
     * @return Genre
     */
    public function unpublish(Genre $genre)
    {
        try {
            $genre->status = 'unpublish';
            return $genre->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }
}
