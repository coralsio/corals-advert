<?php

namespace Corals\Modules\Advert\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Modules\Advert\Models\Zone;

class ZoneTransformer extends BaseTransformer
{
    public function __construct($extras = [])
    {
        $this->resource_url = config('advert.models.zone.resource_url');

        parent::__construct($extras);
    }

    /**
     * @param Zone $zone
     * @return array
     * @throws \Throwable
     */
    public function transform(Zone $zone)
    {
        $show_url = url($this->resource_url . '/' . $zone->hashed_id);

        $website_show_url = url(config('advert.models.website.resource_url') . '/' . $zone->website->hashed_id);

        $transformedArray = [
            'id' => $zone->id,
            'name' => '<a href="' . $show_url . '">' . \Str::limit($zone->name, 50) . '</a>',
            'dimension' => $zone->dimension,
            'website' => '<a href="' . $website_show_url . '">' . \Str::limit($zone->website->name, 50) . '</a>',
            'key' => generateCopyToClipBoard($zone->hashed_id, "@zone({$zone->key})"),
            'notes' => generatePopover($zone->notes),
            'status' => formatStatusAsLabels($zone->status),
            'created_at' => format_date($zone->created_at),
            'updated_at' => format_date($zone->updated_at),
            'action' => $this->actions($zone)
        ];

        return parent::transformResponse($transformedArray);
    }
}
