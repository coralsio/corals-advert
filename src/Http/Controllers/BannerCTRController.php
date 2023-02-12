<?php

namespace Corals\Modules\Advert\Http\Controllers;

use Corals\Foundation\Http\Controllers\BaseController;
use Corals\Modules\Advert\DataTables\BannerCTRDataTable;
use Corals\Modules\Advert\Http\Requests\BannerRequest;

class BannerCTRController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('advert.models.banner_ctr.resource_url');

        $this->title = 'Advert::module.banner_ctr.title';
        $this->title_singular = 'Advert::module.banner_ctr.title_singular';

        parent::__construct();
    }

    /**
     * @param BannerRequest $request
     * @param BannerCTRDataTable $dataTable
     * @return mixed
     */
    public function index(BannerRequest $request, BannerCTRDataTable $dataTable)
    {
        return $dataTable->render('Advert::banner_ctr.index');
    }
}
