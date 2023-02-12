<div style="padding:0; width: {{ $zone->width }}px;height: {{ $zone->height }}px; background-color: #f7f7f7;display: inline-block;">

    @include('Advert::zones.partials.'.$banner->type, ['zone'=>$zone, 'banner'=>$banner, 'bannerSlug'=>$bannerSlug])

</div>