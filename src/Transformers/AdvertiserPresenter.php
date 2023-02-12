<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class AdvertiserPresenter extends FractalPresenter
{

    /**
     * @param array $extras
     * @return AdvertiserTransformer|\League\Fractal\TransformerAbstract
     */
    public function getTransformer($extras = [])
    {
        return new AdvertiserTransformer($extras);
    }
}
