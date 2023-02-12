<?php

namespace Corals\Modules\Advert\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\Modules\Advert\Models\Banner;
use Corals\Modules\Advert\Models\Impression;
use Corals\Modules\Advert\Models\Zone;
use Corals\Modules\Advert\Transformers\BannerCTRTransformer;
use Yajra\DataTables\EloquentDataTable;

class BannerCTRDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('advert.models.banner_ctr.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new BannerCTRTransformer());
    }

    /**
     * @param Impression $model
     * @return mixed
     */
    public function query(Impression $model)
    {
        return $model->fromSub(function ($query) {
            $query->selectRaw("advert_impressions.banner_id,advert_impressions.page_slug,zone_id,sum(advert_impressions.clicked) as number_of_clicks,sum(advert_impressions.id) as number_of_views,advert_impressions.id as id")
                ->from('advert_impressions')
                ->groupBy('banner_id', 'zone_id', 'page_slug');
        }, 'totals')
            ->with('banner', 'zone')
            ->selectRaw('totals.id,totals.page_slug,totals.banner_id,totals.zone_id,totals.number_of_views,totals.number_of_clicks,(totals.number_of_clicks/totals.number_of_views) * 100 as ctr');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['visible' => false, 'searchable' => false],
            'banner_id' => ['title' => trans('Advert::attributes.banner_ctr.banner'), 'searchable' => false],
            'zone_id' => ['title' => trans('Advert::attributes.banner_ctr.zone'), 'searchable' => false],
            'page_slug' => ['title' => trans('Advert::attributes.impression.page_slug'), 'searchable' => false],
            'number_of_clicks' => ['title' => trans('Advert::attributes.banner_ctr.clicks'), 'searchable' => false],
            'number_of_views' => ['title' => trans('Advert::attributes.banner_ctr.impressions'), 'searchable' => false],
            'ctr' => ['title' => trans('Advert::attributes.banner_ctr.ctr'), 'searchable' => false],
        ];
    }

    public function getFilters()
    {
        return [
            'totals.banner_id' => [
                'title' => trans('Advert::attributes.banner_ctr.banner'),
                'class' => 'col-md-3',
                'type' => 'select2',
                'options' => Banner::pluck('name', 'id'),
                'active' => true,
            ],
            'totals.zone_id' => [
                'title' => trans('Advert::attributes.banner_ctr.zone'),
                'class' => 'col-md-3',
                'type' => 'select2',
                'options' => Zone::pluck('name', 'id'),
                'active' => true,
            ],
            'totals.page_slug' => [
                'title' => trans('Advert::attributes.impression.page_slug'),
                'class' => 'col-md-3',
                'type' => 'text',
                'condition' => 'like',
                'active' => true,
            ],
        ];
    }

    protected function getOptions()
    {
        return [
            'has_action' => false,
        ];
    }

    protected function getBuilderParameters(): array
    {
        return ["dom" => "Blrtip",];
    }
}
