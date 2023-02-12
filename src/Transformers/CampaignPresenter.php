<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class CampaignPresenter extends FractalPresenter
{

    /**
     * @param array $extras
     * @return CampaignTransformer|\League\Fractal\TransformerAbstract
     */
    public function getTransformer($extras = [])
    {
        return new CampaignTransformer($extras);
    }
}
