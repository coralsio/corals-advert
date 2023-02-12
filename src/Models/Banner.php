<?php

namespace Corals\Modules\Advert\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Transformers\PresentableTrait;
use Corals\Modules\Advert\Traits\DimensionModelTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Banner extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, InteractsWithMedia , DimensionModelTrait;

    protected $table = 'advert_banners';

    public $mediaCollectionName = 'advert-banner-media';
    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'advert.models.banner';

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|null|string
     * @throws \Spatie\MediaLibrary\Exceptions\InvalidConversion
     */
    public function getObjectUrlAttribute()
    {
        $media = $this->getFirstMedia($this->mediaCollectionName);

        if ($media) {
            return $media->getFullUrl();
        }

        return null;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function zones()
    {
        return $this->belongsToMany(Zone::class, 'advert_banner_zone');
    }

}
