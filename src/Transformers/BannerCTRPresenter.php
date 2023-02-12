<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class BannerCTRPresenter extends FractalPresenter
{

    /**
     * @param array $extras
     * @return BannerCTRTransformer|\League\Fractal\TransformerAbstract
     */
    public function getTransformer($extras = [])
    {
        return new BannerCTRTransformer($extras);
    }
}
