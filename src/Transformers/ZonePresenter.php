<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class ZonePresenter extends FractalPresenter
{

    /**
     * @param array $extras
     * @return ZoneTransformer|\League\Fractal\TransformerAbstract
     */
    public function getTransformer($extras = [])
    {
        return new ZoneTransformer($extras);
    }
}
