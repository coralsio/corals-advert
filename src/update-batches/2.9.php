<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

$tables = [
    'advert_banner_zone',
    'advert_imp_visitor_details',
    'advert_impressions',
    'advert_banners',
    'advert_zones',
    'advert_websites',
    'advert_campaigns',
    'advert_advertisers',
];

foreach ($tables as $tableName) {
    if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'properties')) {
        Schema::table($tableName, function (Blueprint $table) {
            $table->text('properties')->nullable();
        });
    }
}
