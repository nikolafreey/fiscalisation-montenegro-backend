<?php

namespace App\Policies;

use App\Models\CijenaRobe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CijenaRobePolicy
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
        return $user->canAny(['view all CijenaRobe', 'view owned CijenaRobe']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return mixed
     */
    public function view(User $user, CijenaRobe $cijenaRobe)
    {
        return $user->can('show CijenaRobe');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create CijenaRobe');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return mixed
     */
    public function update(User $user, CijenaRobe $cijenaRobe)
    {
        return $user->can('update CijenaRobe') && $cijenaRobe->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return mixed
     */
    public function delete(User $user, CijenaRobe $cijenaRobe)
    {
        return $user->can('delete CijenaRobe') && $cijenaRobe->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return mixed
     */
    public function restore(User $user, CijenaRobe $cijenaRobe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return mixed
     */
    public function forceDelete(User $user, CijenaRobe $cijenaRobe)
    {
        //
    }
}
