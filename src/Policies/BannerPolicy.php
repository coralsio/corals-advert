<?php

namespace Corals\Modules\Advert\Policies;

use Corals\Foundation\Policies\BasePolicy;
use Corals\Modules\Advert\Models\Banner;
use Corals\User\Models\User;

class BannerPolicy extends BasePolicy
{
    protected $administrationPermission = 'Administrations::admin.advertiser';

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Advert::banner.view')) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('Advert::banner.create');
    }

    /**
     * @param User $user
     * @param Banner $banner
     * @return bool
     */
    public function update(User $user, Banner $banner)
    {
        if ($user->can('Advert::banner.update')) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @param Banner $banner
     * @return bool
     */
    public function destroy(User $user, Banner $banner)
    {
        if ($user->can('Advert::banner.delete')) {
            return true;
        }

        return false;
    }
}
