<?php

namespace Corals\Modules\Advert\Policies;

use Corals\Foundation\Policies\BasePolicy;
use Corals\User\Models\User;
use Corals\Modules\Advert\Models\Website;

class WebsitePolicy extends BasePolicy
{
    protected $administrationPermission = 'Administrations::admin.advertiser';

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Advert::website.view')) {
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
        return $user->can('Advert::website.create');
    }

    /**
     * @param User $user
     * @param Website $website
     * @return bool
     */
    public function update(User $user, Website $website)
    {
        if ($user->can('Advert::website.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Website $website
     * @return bool
     */
    public function destroy(User $user, Website $website)
    {
        if ($user->can('Advert::website.delete')) {
            return true;
        }
        return false;
    }

}
