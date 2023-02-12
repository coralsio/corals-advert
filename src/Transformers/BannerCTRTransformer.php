<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Modules\Advert\Models\Impression;
use Illuminate\Support\Str;

class BannerCTRTransformer extends BaseTransformer
{
    public function __construct($extras = [])
    {
        $this->resource_url = config('advert.models.banner_ctr.resource_url');

        parent::__construct($extras);
    }

    /**
     * @param Impression $impression
     * @return array
     */
    public function transform(Impression $impression)
    {
        $transformedArray = [
            'id' => $impression->id,
            'banner_id' => $impression->banner->present('name'),
            'zone_id' => $impression->zone->present('name'),
            'number_of_clicks' => number_format($impression->number_of_clicks ?? 0),
            'number_of_views' => number_format($impression->number_of_views ?? 0),
            'page_slug' => strlen($impression->page_slug) > 60 ? generatePopover($impression->page_slug,
                Str::limit($impression->page_slug, 60)) : $impression->page_slug,
            'ctr' => $impression->ctr ? (number_format($impression->ctr ?? 0, 2) . '%') : 0,
            'created_at' => format_date($impression->created_at),
            'updated_at' => format_date($impression->updated_at) ?? '-',
        ];

        return parent::transformResponse($transformedArray);
    }
}
