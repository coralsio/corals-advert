<?php


namespace Corals\Modules\Advert\Http\Controllers\API;

use Corals\Foundation\Http\Controllers\APIPublicController;
use Corals\Modules\Advert\Models\Zone;
use Illuminate\Http\Request;

class ZonesPublicController extends APIPublicController
{
    /**
     * @param Request $request
     * @param $key
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function render(Request $request, $key)
    {
        $view = 'Advert::zones.render';

        $zone = Zone::query()->where('key', $key)->active()->first();

        return view()->make($view)->with(['zone' => $zone, 'zone_key' => $key])->render();
    }
}
