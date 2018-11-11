<?php

namespace Movies\Movies\Workflow;

use Exception;
use Litepie\Workflow\Exceptions\WorkflowActionNotPerformedException;

use Movies\Movies\Models\Movie;

class MovieAction
{
    /**
     * Perform the complete action.
     *
     * @param Movie $movie
     *
     * @return Movie
     */
    public function complete(Movie $movie)
    {
        try {
            $movie->status = 'complete';
            return $movie->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the verify action.
     *
     * @param Movie $movie
     *
     * @return Movie
     */public function verify(Movie $movie)
    {
        try {
            $movie->status = 'verify';
            return $movie->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the approve action.
     *
     * @param Movie $movie
     *
     * @return Movie
     */public function approve(Movie $movie)
    {
        try {
            $movie->status = 'approve';
            return $movie->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the publish action.
     *
     * @param Movie $movie
     *
     * @return Movie
     */public function publish(Movie $movie)
    {
        try {
            $movie->status = 'publish';
            return $movie->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the archive action.
     *
     * @param Movie $movie
     *
     * @return Movie
     */
    public function archive(Movie $movie)
    {
        try {
            $movie->status = 'archive';
            return $movie->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the unpublish action.
     *
     * @param Movie $movie
     *
     * @return Movie
     */
    public function unpublish(Movie $movie)
    {
        try {
            $movie->status = 'unpublish';
            return $movie->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }
}
