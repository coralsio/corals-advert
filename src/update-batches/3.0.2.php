<?php

$Advert_menu_id = \DB::table('menus')->where('key', 'advert')->first()->id;

\DB::table('menus')->insert([
    [
        'parent_id' => $Advert_menu_id,
        'key' => 'banner-ctr',
        'url' => config('advert.models.banner_ctr.resource_url'),
        'active_menu_url' => config('advert.models.banner_ctr.resource_url') . '*',
        'name' => 'Banners CTR',
        'description' => 'Banners CTR Report',
        'icon' => 'fa fa-list',
        'target' => null, 'roles' => '["1"]',
        'order' => 0
    ],
]);
