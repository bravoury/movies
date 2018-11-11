<?php

namespace Movies\Movies\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class GenreItemTransformer extends TransformerAbstract
{
    public function transform(\Movies\Movies\Models\Genre $genre)
    {
        return [
            'id'                => $genre->getRouteKey(),
            'id'                => $genre->id,
            'movie_id'          => $genre->movie_id,
            'status'            => trans('app.'.$genre->status),
            'created_at'        => format_date($genre->created_at),
            'updated_at'        => format_date($genre->updated_at),
        ];
    }
}