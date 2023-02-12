<?php

namespace Corals\Modules\Advert\Policies;

use Corals\Foundation\Policies\BasePolicy;
use Corals\User\Models\User;
use Corals\Modules\Advert\Models\Advertiser;

class AdvertiserPolicy extends BasePolicy
{
    protected $administrationPermission = 'Administrations::admin.advertiser';

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Advert::advertiser.view')) {
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
        return $user->can('Advert::advertiser.create');
    }

    /**
     * @param User $user
     * @param Advertiser $advertiser
     * @return bool
     */
    public function update(User $user, Advertiser $advertiser)
    {
        if ($user->can('Advert::advertiser.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Advertiser $advertiser
     * @return bool
     */
    public function destroy(User $user, Advertiser $advertiser)
    {
        if ($user->can('Advert::advertiser.delete')) {
            return true;
        }
        return false;
    }
}
