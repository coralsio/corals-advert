<?php

Route::group(['prefix' => 'adverts'], function () {
    Route::get('{zone}/embed', 'EmbedController@embed');
    Route::get('ads/{slug}', 'ImpressionsController@click');
    Route::resource('impressions', 'ImpressionsController', ['only' => ['index']]);
    Route::post('advertisers/bulk-action', 'AdvertisersController@bulkAction');
    Route::post('campaigns/bulk-action', 'CampaignsController@bulkAction');
    Route::post('banners/bulk-action', 'BannersController@bulkAction');
    Route::post('websites/bulk-action', 'WebsitesController@bulkAction');
    Route::post('zones/bulk-action', 'ZonesController@bulkAction');
    Route::resource('websites', 'WebsitesController');
    Route::resource('zones', 'ZonesController');
    Route::resource('banners', 'BannersController');
    Route::resource('advertisers', 'AdvertisersController');
    Route::resource('campaigns', 'CampaignsController');
    Route::get('banner-ctr', 'BannerCTRController@index');
});