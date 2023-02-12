<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class BannerPresenter extends FractalPresenter
{

    /**
     * @param array $extras
     * @return BannerTransformer|\League\Fractal\TransformerAbstract
     */
    public function getTransformer($extras = [])
    {
        return new BannerTransformer($extras);
    }
}
