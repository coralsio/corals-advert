<?php

namespace Corals\Modules\Advert\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\Modules\Advert\Models\Advertiser;
use Corals\Modules\Advert\Transformers\AdvertiserTransformer;
use Yajra\DataTables\EloquentDataTable;

class AdvertisersDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('advert.models.advertiser.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new AdvertiserTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Advertiser $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Advertiser $model)
    {
        return $model->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['visible' => false],
            'name' => ['title' => trans('Advert::attributes.advertiser.name')],
            'contact' => ['title' => trans('Advert::attributes.advertiser.contact')],
            'email' => ['title' => trans('Advert::attributes.advertiser.email')],
            'notes' => ['title' => trans('Advert::attributes.advertiser.notes')],
            'status' => ['title' => trans('Corals::attributes.status')],
            'updated_at' => ['title' => trans('Corals::attributes.updated_at')],
        ];
    }

    protected function getBulkActions()
    {
        return [
            'delete' => ['title' => trans('Corals::labels.delete'), 'permission' => 'Advert::advertiser.delete', 'confirmation' => trans('Corals::labels.confirmation.title')],
            'active' => ['title' => '<i class="fa fa-check-circle"></i> ' . trans('Advert::attributes.advertiser.status_option.active'), 'permission' => 'Advert::advertiser.update', 'confirmation' => trans('Corals::labels.confirmation.title')],
            'inActive' => ['title' => '<i class="fa fa-check-circle-o"></i> ' . trans('Advert::attributes.advertiser.status_option.inactive'), 'permission' => 'Advert::advertiser.update', 'confirmation' => trans('Corals::labels.confirmation.title')],
        ];
    }

    protected function getOptions()
    {
        $url = url(config('advert.models.advertiser.resource_url'));
        return ['resource_url' => $url];
    }
}
