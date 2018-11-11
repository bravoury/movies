<?php

namespace Movies\Movies\Http\Controllers;
use Litepie\Movies\Http\Requests\MovieRequest;
use Litepie\Movies\Models\Movie;

trait MovieWorkflow {
	
    /**
     * Workflow controller function for movie.
     *
     * @param Model   $movie
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function putWorkflow(MovieRequest $request, Movie $movie, $step)
    {

        try {

            $movie->updateWorkflow($step);

            return response()->json([
                'message'  => trans('messages.success.changed', ['Module' => trans('movies::movie.name'), 'status' => trans("app.{$step}")]),
                'code'     => 204,
                'redirect' => trans_url('/admin/movie/movie/' . $movie->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/movie/movie/' . $movie->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Workflow controller function for movie.
     *
     * @param Model   $movie
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
    */

    public function getWorkflow(Movie $movie, $step, $user)
    {
        try {
            $user_id = decrypt($user);

            Auth::onceUsingId($user_id);

            $movie->updateWorkflow($step);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('movies::movie.name'), 'status' => trans("app.{$step}")]),
                'status'  => 'success',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('movies::admin.movie.message', $data)->render();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('movies::admin.movie.message', $data)->render();

        } catch (Exception $e) {

            $data = [
                'message' => '<b>' . $e->getMessage(). '</b>',
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('movies::admin.movie.message', $data)->render();

        }

    }
}