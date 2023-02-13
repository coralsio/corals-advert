<?php

namespace Corals\Modules\Advert\Http\Controllers;

use Corals\Foundation\Http\Controllers\BaseController;
use Corals\Foundation\Http\Requests\BulkRequest;
use Corals\Modules\Advert\DataTables\CampaignsDataTable;
use Corals\Modules\Advert\Http\Requests\CampaignRequest;
use Corals\Modules\Advert\Models\Campaign;

class CampaignsController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('advert.models.campaign.resource_url');

        $this->resource_model = new Campaign();

        $this->title = 'Advert::module.campaign.title';
        $this->title_singular = 'Advert::module.campaign.title_singular';

        parent::__construct();
    }

    /**
     * @param CampaignRequest $request
     * @param CampaignsDataTable $dataTable
     * @return mixed
     */
    public function index(CampaignRequest $request, CampaignsDataTable $dataTable)
    {
        return $dataTable->setResourceUrl(url($this->resource_url))->render('Advert::campaigns.index');
    }

    /**
     * @param CampaignRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CampaignRequest $request)
    {
        $campaign = new Campaign();

        $this->setViewSharedData(['title_singular' => trans('Corals::labels.create_title', ['title' => $this->title_singular])]);

        return view('Advert::campaigns.create_edit')->with(compact('campaign'));
    }

    /**
     * @param CampaignRequest $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|mixed
     */
    public function store(CampaignRequest $request)
    {
        try {
            $data = $request->except('link');


            $campaign = Campaign::create($data);

            flash(trans('Corals::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Campaign::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CampaignRequest $request
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(CampaignRequest $request, Campaign $campaign)
    {
        $this->setViewSharedData(['title_singular' => trans('Corals::labels.show_title', ['title' => $campaign->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $campaign->hashed_id . '/edit']);

        $advertiser = $campaign->advertiser;

        return view('Advert::campaigns.show')->with(compact('campaign', 'advertiser'));
    }

    /**
     * @param CampaignRequest $request
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CampaignRequest $request, Campaign $campaign)
    {
        $this->setViewSharedData(['title_singular' => trans('Corals::labels.update_title', ['title' => $campaign->name])]);

        $advertiser = $campaign->advertiser;

        return view('Advert::campaigns.create_edit')->with(compact('campaign', 'advertiser'));
    }

    /**
     * @param CampaignRequest $request
     * @param Campaign $campaign
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|mixed
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {
        try {
            $data = $request->except('link');

            $campaign->update($data);

            flash(trans('Corals::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Campaign::class, 'update');
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
                        $campaign = Campaign::findByHash($selection_id);
                        $campaign_request = new CampaignRequest();
                        $campaign_request->setMethod('DELETE');
                        $this->destroy($campaign_request, $campaign);
                    }
                    $message = ['level' => 'success', 'message' => trans('Corals::messages.success.deleted', ['item' => $this->title_singular])];

                    break;
                case 'active':
                    foreach ($selection as $selection_id) {
                        $campaign = Campaign::findByHash($selection_id);
                        if (user()->can('Advert::campaign.update')) {
                            $campaign->update([
                                'status' => 'active',
                            ]);
                            $campaign->save();
                            $message = ['level' => 'success', 'message' => trans('Advert::attributes.update_status', ['item' => $this->title_singular])];
                        } else {
                            $message = ['level' => 'error', 'message' => trans('Advert::attributes.no_permission', ['item' => $this->title_singular])];
                        }
                    }

                    break;
                case 'inActive':
                    foreach ($selection as $selection_id) {
                        $campaign = Campaign::findByHash($selection_id);
                        if (user()->can('Advert::campaign.update')) {
                            $campaign->update([
                                'status' => 'inactive',
                            ]);
                            $campaign->save();
                            $message = ['level' => 'success', 'message' => trans('Advert::attributes.update_status', ['item' => $this->title_singular])];
                        } else {
                            $message = ['level' => 'error', 'message' => trans('Advert::attributes.no_permission', ['item' => $this->title_singular])];
                        }
                    }

                    break;
            }
        } catch (\Exception $exception) {
            log_exception($exception, Campaign::class, 'bulkAction');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

    /**
     * @param CampaignRequest $request
     * @param Campaign $campaign
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CampaignRequest $request, Campaign $campaign)
    {
        try {
            $campaign->delete();

            $message = ['level' => 'success', 'message' => trans('Corals::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Campaign::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}
