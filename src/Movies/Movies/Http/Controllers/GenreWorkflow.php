<?php

namespace Movies\Movies\Http\Controllers;
use Litepie\Movies\Http\Requests\GenreRequest;
use Litepie\Movies\Models\Genre;

trait GenreWorkflow {
	
    /**
     * Workflow controller function for genre.
     *
     * @param Model   $genre
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function putWorkflow(GenreRequest $request, Genre $genre, $step)
    {

        try {

            $genre->updateWorkflow($step);

            return response()->json([
                'message'  => trans('messages.success.changed', ['Module' => trans('movies::genre.name'), 'status' => trans("app.{$step}")]),
                'code'     => 204,
                'redirect' => trans_url('/admin/genre/genre/' . $genre->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/genre/genre/' . $genre->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Workflow controller function for genre.
     *
     * @param Model   $genre
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
    */

    public function getWorkflow(Genre $genre, $step, $user)
    {
        try {
            $user_id = decrypt($user);

            Auth::onceUsingId($user_id);

            $genre->updateWorkflow($step);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('movies::genre.name'), 'status' => trans("app.{$step}")]),
                'status'  => 'success',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('movies::admin.genre.message', $data)->render();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('movies::admin.genre.message', $data)->render();

        } catch (Exception $e) {

            $data = [
                'message' => '<b>' . $e->getMessage(). '</b>',
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('movies::admin.genre.message', $data)->render();

        }

    }
}