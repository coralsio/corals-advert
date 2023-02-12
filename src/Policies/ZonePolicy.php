<?php

namespace Corals\Modules\Advert\Policies;

use Corals\Foundation\Policies\BasePolicy;
use Corals\User\Models\User;
use Corals\Modules\Advert\Models\Zone;

class ZonePolicy extends BasePolicy
{
    protected $administrationPermission = 'Administrations::admin.advertiser';

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Advert::zone.view')) {
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
        return $user->can('Advert::zone.create');
    }

    /**
     * @param User $user
     * @param Zone $zone
     * @return bool
     */
    public function update(User $user, Zone $zone)
    {
        if ($user->can('Advert::zone.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Zone $zone
     * @return bool
     */
    public function destroy(User $user, Zone $zone)
    {
        if ($user->can('Advert::zone.delete')) {
            return true;
        }
        return false;
    }
}
