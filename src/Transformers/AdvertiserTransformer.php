<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Modules\Advert\Models\Advertiser;

class AdvertiserTransformer extends BaseTransformer
{
    public function __construct($extras = [])
    {
        $this->resource_url = config('advert.models.advertiser.resource_url');

        parent::__construct($extras);
    }

    /**
     * @param Advertiser $advertiser
     * @return array
     * @throws \Throwable
     */
    public function transform(Advertiser $advertiser)
    {
        $show_url = url($this->resource_url . '/' . $advertiser->hashed_id);

        $transformedArray = [
            'id' => $advertiser->id,
            'checkbox' => $this->generateCheckboxElement($advertiser),
            'name' => '<a href="' . $show_url . '">' . \Str::limit($advertiser->name, 50) . '</a>',
            'contact' => $advertiser->contact,
            'email' => $advertiser->email,
            'notes' => generatePopover($advertiser->notes),
            'status' => formatStatusAsLabels($advertiser->status),
            'created_at' => format_date($advertiser->created_at),
            'updated_at' => format_date($advertiser->updated_at),
            'action' => $this->actions($advertiser)
        ];

        return parent::transformResponse($transformedArray);
    }
}
