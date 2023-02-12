<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class ImpressionPresenter extends FractalPresenter
{

    /**
     * @param array $extras
     * @return ImpressionTransformer|\League\Fractal\TransformerAbstract
     */
    public function getTransformer($extras = [])
    {
        return new ImpressionTransformer($extras);
    }
}
