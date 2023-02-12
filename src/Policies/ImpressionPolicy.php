<?php

namespace Corals\Modules\Advert\Policies;

use Corals\Foundation\Policies\BasePolicy;
use Corals\User\Models\User;

class ImpressionPolicy extends BasePolicy
{
    protected $administrationPermission = 'Administrations::admin.advertiser';

    protected $skippedAbilities = ['create'];
    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Advert::impression.view')) {
            return true;
        }
        return false;
    }

}
