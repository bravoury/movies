<?php

namespace Movies\Movies\Workflow;

use Movies\Movies\Models\Genre;
use Movies\Movies\Notifications\Genre as GenreNotifyer;
use Notification;

class GenreNotification
{

    /**
     * Send the notification to the users after complete.
     *
     * @param Genre $genre
     *
     * @return void
     */
    public function complete(Genre $genre)
    {
        return Notification::send($genre->user, new GenreNotifyer($genre, 'complete'));;
    }

    /**
     * Send the notification to the users after verify.
     *
     * @param Genre $genre
     *
     * @return void
     */
    public function verify(Genre $genre)
    {
        return Notification::send($genre->user, new GenreNotifyer($genre, 'verify'));;
    }

    /**
     * Send the notification to the users after approve.
     *
     * @param Genre $genre
     *
     * @return void
     */
    public function approve(Genre $genre)
    {
        return Notification::send($genre->user, new GenreNotifyer($genre, 'approve'));;

    }

    /**
     * Send the notification to the users after publish.
     *
     * @param Genre $genre
     *
     * @return void
     */
    public function publish(Genre $genre)
    {
        return Notification::send($genre->user, new GenreNotifyer($genre, 'publish'));;
    }

    /**
     * Send the notification to the users after archive.
     *
     * @param Genre $genre
     *
     * @return void
     */
    public function archive(Genre $genre)
    {
        return Notification::send($genre->user, new GenreNotifyer($genre, 'archive'));;

    }

    /**
     * Send the notification to the users after unpublish.
     *
     * @param Genre $genre
     *
     * @return void
     */
    public function unpublish(Genre $genre)
    {
        return Notification::send($genre->user, new GenreNotifyer($genre, 'unpublish'));;

    }
}
