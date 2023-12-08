<?php

namespace Corals\Modules\Advert\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdvertSampleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('advert_advertisers')->insert([
            'name' => 'Corals',
            'contact' => 'Saeed',
            'email' => 'saeed@corals.io',
        ]);

        \DB::table('advert_campaigns')->insert([
            'name' => Carbon::now()->format('F-Y') . ' corals campaign',
            'starts_at' => Carbon::now()->firstOfMonth(),
            'ends_at' => Carbon::now()->endOfMonth(),
            'weight' => 10,
            'advertiser_id' => 1,
        ]);


        \DB::table('advert_banners')->insert([
            0 =>
                [
                    'name' => 'Red',
                    'dimension' => '300x250',
                    'type' => 'link',
                    'content' => 'http://via.placeholder.com/300x250/f00/fff',
                    'weight' => 20,
                    'url' => null,
                    'notes' => null,
                    'status' => 'active',
                    'campaign_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'deleted_at' => null,
                    'created_at' => '2018-03-29 13:26:33',
                    'updated_at' => '2018-03-29 15:02:45',
                ],
            1 =>
                [
                    'name' => 'Blue',
                    'dimension' => '300x250',
                    'type' => 'link',
                    'content' => 'http://via.placeholder.com/300x250/00f/fff',
                    'weight' => 10,
                    'url' => null,
                    'notes' => null,
                    'status' => 'active',
                    'campaign_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'deleted_at' => null,
                    'created_at' => '2018-03-29 13:27:04',
                    'updated_at' => '2018-03-29 13:27:04',
                ],
            2 =>
                [
                    'name' => 'Green',
                    'dimension' => '300x250',
                    'type' => 'link',
                    'content' => 'http://via.placeholder.com/300x250/0f0/fff',
                    'weight' => 15,
                    'url' => null,
                    'notes' => null,
                    'status' => 'active',
                    'campaign_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'deleted_at' => null,
                    'created_at' => '2018-03-29 13:27:38',
                    'updated_at' => '2018-03-29 13:27:38',
                ],
            3 =>
                [
                    'name' => 'Yellow',
                    'dimension' => '120x600',
                    'type' => 'link',
                    'content' => 'http://via.placeholder.com/120x600/ff0/000',
                    'weight' => 10,
                    'url' => null,
                    'notes' => null,
                    'status' => 'active',
                    'campaign_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'deleted_at' => null,
                    'created_at' => '2018-03-29 15:08:05',
                    'updated_at' => '2018-03-29 15:08:05',
                ],
            4 =>
                [
                    'name' => 'Purple',
                    'dimension' => '120x600',
                    'type' => 'link',
                    'content' => 'http://via.placeholder.com/120x600/f0f/000',
                    'weight' => 15,
                    'url' => null,
                    'notes' => null,
                    'status' => 'active',
                    'campaign_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'deleted_at' => null,
                    'created_at' => '2018-03-29 15:08:52',
                    'updated_at' => '2018-03-29 15:08:52',
                ],
            5 =>
                [
                    'name' => 'Sky Blue',
                    'dimension' => '120x600',
                    'type' => 'link',
                    'content' => 'http://via.placeholder.com/120x600/0ff/000',
                    'weight' => 25,
                    'url' => null,
                    'notes' => null,
                    'status' => 'active',
                    'campaign_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'deleted_at' => null,
                    'created_at' => '2018-03-29 15:10:13',
                    'updated_at' => '2018-03-29 15:10:13',
                ],
        ]);

        \DB::table('advert_websites')->insert([
            'url' => 'https://www.corals.io/',
            'name' => 'Corals.io website',
            'contact' => 'Corals',
            'email' => 'info@corals.io',
        ]);

        \DB::table('advert_zones')->insert([
            0 =>
                [
                    'name' => 'Skyscraper',
                    'key' => 'skyscraper',
                    'dimension' => '120x600',
                    'notes' => null,
                    'status' => 'active',
                    'website_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'deleted_at' => null,
                    'created_at' => '2018-03-29 13:17:21',
                    'updated_at' => '2018-03-29 13:17:21',
                ],
            1 =>
                [
                    'name' => 'Sidebar Top',
                    'key' => 'sidebar-top',
                    'dimension' => '300x250',
                    'notes' => null,
                    'status' => 'active',
                    'website_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'deleted_at' => null,
                    'created_at' => '2018-03-29 13:17:48',
                    'updated_at' => '2018-03-29 13:17:48',
                ],
        ]);

        \DB::table('advert_banner_zone')->insert([
            0 =>
                [
                    'banner_id' => 1,
                    'zone_id' => 2,
                ],
            1 =>
                [
                    'banner_id' => 3,
                    'zone_id' => 2,
                ],
            2 =>
                [
                    'banner_id' => 2,
                    'zone_id' => 2,
                ],
            3 =>
                [
                    'banner_id' => 4,
                    'zone_id' => 1,
                ],
            4 =>
                [
                    'banner_id' => 5,
                    'zone_id' => 1,
                ],
            5 =>
                [
                    'banner_id' => 6,
                    'zone_id' => 1,
                ],
        ]);
    }
}
