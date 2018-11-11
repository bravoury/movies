<?php

namespace Movies\Movies\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class MovieItemTransformer extends TransformerAbstract
{
    public function transform(\Movies\Movies\Models\Movie $movie)
    {
        return [
            'id'                => $movie->getRouteKey(),
            'id'                => $movie->id,
            'title'             => $movie->title,
            'status'            => trans('app.'.$movie->status),
            'created_at'        => format_date($movie->created_at),
            'updated_at'        => format_date($movie->updated_at),
        ];
    }
}