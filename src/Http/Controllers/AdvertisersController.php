<?php

namespace Corals\Modules\Advert\Http\Controllers;

use Corals\Foundation\Http\Controllers\BaseController;
use Corals\Foundation\Http\Requests\BulkRequest;
use Corals\Modules\Advert\DataTables\AdvertisersDataTable;
use Corals\Modules\Advert\Http\Requests\AdvertiserRequest;
use Corals\Modules\Advert\Models\Advertiser;

class AdvertisersController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('advert.models.advertiser.resource_url');

        $this->resource_model = new Advertiser();

        $this->title = 'Advert::module.advertiser.title';
        $this->title_singular = 'Advert::module.advertiser.title_singular';

        parent::__construct();
    }

    /**
     * @param AdvertiserRequest $request
     * @param AdvertisersDataTable $dataTable
     * @return mixed
     */
    public function index(AdvertiserRequest $request, AdvertisersDataTable $dataTable)
    {
        return $dataTable->render('Advert::advertisers.index');
    }

    /**
     * @param AdvertiserRequest $request
     * @return $this
     */
    public function create(AdvertiserRequest $request)
    {
        $advertiser = new Advertiser();

        $this->setViewSharedData(['title_singular' => trans('Corals::labels.create_title', ['title' => $this->title_singular])]);

        return view('Advert::advertisers.create_edit')->with(compact('advertiser'));
    }

    /**
     * @param AdvertiserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AdvertiserRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $advertiser = Advertiser::create($data);

            flash(trans('Corals::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Advertiser::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param AdvertiserRequest $request
     * @param Advertiser $advertiser
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(AdvertiserRequest $request, Advertiser $advertiser)
    {
        $this->setViewSharedData(['title_singular' => trans('Corals::labels.show_title', ['title' => $advertiser->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $advertiser->hashed_id . '/edit']);

        return view('Advert::advertisers.show')->with(compact('advertiser'));
    }

    /**
     * @param AdvertiserRequest $request
     * @param Advertiser $advertiser
     * @return $this
     */
    public function edit(AdvertiserRequest $request, Advertiser $advertiser)
    {
        $this->setViewSharedData(['title_singular' => trans('Corals::labels.update_title', ['title' => $advertiser->name])]);

        return view('Advert::advertisers.create_edit')->with(compact('advertiser'));
    }

    /**
     * @param AdvertiserRequest $request
     * @param Advertiser $advertiser
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AdvertiserRequest $request, Advertiser $advertiser)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $advertiser->update($data);

            flash(trans('Corals::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Advertiser::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    public function bulkAction(BulkRequest $request)
    {
        try {
            $action = $request->input('action');
            $selection = json_decode($request->input('selection'), true);
            switch ($action) {
                case 'delete':
                    foreach ($selection as $selection_id) {
                        $Advertiser = Advertiser::findByHash($selection_id);
                        $Advertiser_request = new AdvertiserRequest();
                        $Advertiser_request->setMethod('DELETE');
                        $this->destroy($Advertiser_request, $Advertiser);
                    }
                    $message = ['level' => 'success', 'message' => trans('Corals::messages.success.deleted', ['item' => $this->title_singular])];

                    break;
                case 'active':
                    foreach ($selection as $selection_id) {
                        $Advertiser = Advertiser::findByHash($selection_id);
                        if (user()->can('Advert::advertiser.update')) {
                            $Advertiser->update([
                                'status' => 'active',
                            ]);
                            $Advertiser->save();
                            $message = ['level' => 'success', 'message' => trans('Advert::attributes.update_status', ['item' => $this->title_singular])];
                        } else {
                            $message = ['level' => 'error', 'message' => trans('Advert::attributes.no_permission', ['item' => $this->title_singular])];
                        }
                    }

                    break;
                case 'inActive':
                    foreach ($selection as $selection_id) {
                        $Advertiser = Advertiser::findByHash($selection_id);
                        if (user()->can('Advert::advertiser.update')) {
                            $Advertiser->update([
                                'status' => 'inactive',
                            ]);
                            $Advertiser->save();
                            $message = ['level' => 'success', 'message' => trans('Advert::attributes.update_status', ['item' => $this->title_singular])];
                        } else {
                            $message = ['level' => 'error', 'message' => trans('Advert::attributes.no_permission', ['item' => $this->title_singular])];
                        }
                    }

                    break;
            }
        } catch (\Exception $exception) {
            log_exception($exception, Advertiser::class, 'bulkAction');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

    /**
     * @param AdvertiserRequest $request
     * @param Advertiser $advertiser
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AdvertiserRequest $request, Advertiser $advertiser)
    {
        try {
            $advertiser->delete();

            $message = ['level' => 'success', 'message' => trans('Corals::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Advertiser::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}
