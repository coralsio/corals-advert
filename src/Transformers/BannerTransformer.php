<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Modules\Advert\Models\Banner;

class BannerTransformer extends BaseTransformer
{
    public function __construct($extras = [])
    {
        $this->resource_url = config('advert.models.banner.resource_url');

        parent::__construct($extras);
    }

    /**
     * @param Banner $banner
     * @return array
     * @throws \Throwable
     */
    public function transform(Banner $banner)
    {
        $show_url = url($this->resource_url . '/' . $banner->hashed_id);

        $campaign_show_url = url(config('advert.models.campaign.resource_url') . '/' . $banner->campaign->hashed_id);

        $transformedArray = [
            'id' => $banner->id,
            'checkbox' => $this->generateCheckboxElement($banner),
            'name' => '<a href="' . $show_url . '">' . \Str::limit($banner->name, 50) . '</a>',
            'dimension' => $banner->dimension,
            'campaign' => '<a href="' . $campaign_show_url . '">' . \Str::limit($banner->campaign->name, 50) . '</a>',
            'type' => ucfirst($banner->type),
            'weight' => $banner->weight,
            'notes' => generatePopover($banner->notes),
            'url' => $banner->url ? '<a href="' . $banner->url . '" target="_blank">' . $banner->url . '</a>' : '-',
            'status' => formatStatusAsLabels($banner->status),
            'created_at' => format_date($banner->created_at),
            'updated_at' => format_date($banner->updated_at),
            'action' => $this->actions($banner)
        ];

        return parent::transformResponse($transformedArray);
    }
}
