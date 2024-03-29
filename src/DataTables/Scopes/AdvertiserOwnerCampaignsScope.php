<?php

namespace Corals\Modules\Advert\DataTables\Scopes;

use Corals\Foundation\Contracts\CoralsScope;

class AdvertiserOwnerCampaignsScope implements CoralsScope
{
    protected $owner;

    public function __construct($owner)
    {
        $this->owner = $owner;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query, $extras = [])
    {
        if (! isJoined($query, 'advert_advertisers')) {
            $query->join('advert_advertisers', 'advert_campaigns.advertiser_id', '=', 'advert_advertisers.id');
        }
        $query->where('advert_advertisers.owner_id', $this->owner->id)->where('advert_advertisers.owner_type', get_class($this->owner));
    }
}
