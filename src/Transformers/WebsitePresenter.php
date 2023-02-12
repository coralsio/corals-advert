<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class WebsitePresenter extends FractalPresenter
{

    /**
     * @param array $extras
     * @return WebsiteTransformer|\League\Fractal\TransformerAbstract
     */
    public function getTransformer($extras = [])
    {
        return new WebsiteTransformer($extras);
    }
}
