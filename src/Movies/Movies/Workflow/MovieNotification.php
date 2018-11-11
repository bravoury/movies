<?php

namespace Movies\Movies\Workflow;

use Movies\Movies\Models\Movie;
use Movies\Movies\Notifications\Movie as MovieNotifyer;
use Notification;

class MovieNotification
{

    /**
     * Send the notification to the users after complete.
     *
     * @param Movie $movie
     *
     * @return void
     */
    public function complete(Movie $movie)
    {
        return Notification::send($movie->user, new MovieNotifyer($movie, 'complete'));;
    }

    /**
     * Send the notification to the users after verify.
     *
     * @param Movie $movie
     *
     * @return void
     */
    public function verify(Movie $movie)
    {
        return Notification::send($movie->user, new MovieNotifyer($movie, 'verify'));;
    }

    /**
     * Send the notification to the users after approve.
     *
     * @param Movie $movie
     *
     * @return void
     */
    public function approve(Movie $movie)
    {
        return Notification::send($movie->user, new MovieNotifyer($movie, 'approve'));;

    }

    /**
     * Send the notification to the users after publish.
     *
     * @param Movie $movie
     *
     * @return void
     */
    public function publish(Movie $movie)
    {
        return Notification::send($movie->user, new MovieNotifyer($movie, 'publish'));;
    }

    /**
     * Send the notification to the users after archive.
     *
     * @param Movie $movie
     *
     * @return void
     */
    public function archive(Movie $movie)
    {
        return Notification::send($movie->user, new MovieNotifyer($movie, 'archive'));;

    }

    /**
     * Send the notification to the users after unpublish.
     *
     * @param Movie $movie
     *
     * @return void
     */
    public function unpublish(Movie $movie)
    {
        return Notification::send($movie->user, new MovieNotifyer($movie, 'unpublish'));;

    }
}
