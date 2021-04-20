<?php

namespace App\Policies;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->canAny(['view all Partner', 'view owned Partner']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Partner  $partner
     * @return mixed
     */
    public function view(User $user, Partner $partner)
    {
        return $user->can('show Partner');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create Partner');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Partner  $partner
     * @return mixed
     */
    public function update(User $user, Partner $partner)
    {
        return $user->can('update Partner');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Partner  $partner
     * @return mixed
     */
    public function delete(User $user, Partner $partner)
    {
        return $user->can('delete Partner');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Partner  $partner
     * @return mixed
     */
    public function restore(User $user, Partner $partner)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Partner  $partner
     * @return mixed
     */
    public function forceDelete(User $user, Partner $partner)
    {
        //
    }
}
