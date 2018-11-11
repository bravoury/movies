<?php

namespace Movies\Movies\Policies;

use App\User;
use Movies\Movies\Models\Genre;

class GenrePolicy
{

    /**
     * Determine if the given user can view the genre.
     *
     * @param User $user
     * @param Genre $genre
     *
     * @return bool
     */
    public function view(User $user, Genre $genre)
    {
        if ($user->canDo('movies.genre.view') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.view') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $genre->user_id;
    }

    /**
     * Determine if the given user can create a genre.
     *
     * @param User $user
     * @param Genre $genre
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('movies.genre.create');
    }

    /**
     * Determine if the given user can update the given genre.
     *
     * @param User $user
     * @param Genre $genre
     *
     * @return bool
     */
    public function update(User $user, Genre $genre)
    {
        if ($user->canDo('movies.genre.update') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.update') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $genre->user_id;
    }

    /**
     * Determine if the given user can delete the given genre.
     *
     * @param User $user
     * @param Genre $genre
     *
     * @return bool
     */
    public function destroy(User $user, Genre $genre)
    {
        if ($user->canDo('movies.genre.delete') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.delete') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $genre->user_id;
    }

    /**
     * Determine if the given user can verify the given genre.
     *
     * @param User $user
     * @param Genre $genre
     *
     * @return bool
     */
    public function verify(User $user, Genre $genre)
    {
        if ($user->canDo('movies.genre.verify') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('movies.genre.verify') 
        && $user->is('manager')
        && $genre->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given genre.
     *
     * @param User $user
     * @param Genre $genre
     *
     * @return bool
     */
    public function approve(User $user, Genre $genre)
    {
        if ($user->canDo('movies.genre.approve') && $user->is('admin')) {
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
