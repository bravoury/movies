<?php

namespace Movies\Movies\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class GenreListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GenreListTransformer();
    }
}