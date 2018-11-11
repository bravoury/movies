<?php

namespace Movies\Movies\Policies;

use App\User;
use Movies\Movies\Models\Movie;

class MoviePolicy
{

    /**
     * Determine if the given user can view the movie.
     *
     * @param User $user
     * @param Movie $movie
     *
     * @return bool
     */
    public function view(User $user, Movie $movie)
    {
        if ($user->canDo('movies.movie.view') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.view') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $movie->user_id;
    }

    /**
     * Determine if the given user can create a movie.
     *
     * @param User $user
     * @param Movie $movie
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('movies.movie.create');
    }

    /**
     * Determine if the given user can update the given movie.
     *
     * @param User $user
     * @param Movie $movie
     *
     * @return bool
     */
    public function update(User $user, Movie $movie)
    {
        if ($user->canDo('movies.movie.update') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.update') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $movie->user_id;
    }

    /**
     * Determine if the given user can delete the given movie.
     *
     * @param User $user
     * @param Movie $movie
     *
     * @return bool
     */
    public function destroy(User $user, Movie $movie)
    {
        if ($user->canDo('movies.movie.delete') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.delete') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $movie->user_id;
    }

    /**
     * Determine if the given user can verify the given movie.
     *
     * @param User $user
     * @param Movie $movie
     *
     * @return bool
     */
    public function verify(User $user, Movie $movie)
    {
        if ($user->canDo('movies.movie.verify') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('movies.movie.verify') 
        && $user->is('manager')
        && $movie->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given movie.
     *
     * @param User $user
     * @param Movie $movie
     *
     * @return bool
     */
    public function approve(User $user, Movie $movie)
    {
        if ($user->canDo('movies.movie.approve') && $user->is('admin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $user    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before($user, $ability)
    {
        if ($user->isSuperUser()) {
            return true;
        }
    }
}
