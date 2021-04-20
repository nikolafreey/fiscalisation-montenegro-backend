<?php

namespace App\Policies;

use App\Models\Grupa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GrupaPolicy
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
        return $user->canAny(['view all Grupa', 'view owned Grupa']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grupa  $grupa
     * @return mixed
     */
    public function view(User $user, Grupa $grupa)
    {
        return $user->can('show Grupa');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create Grupa');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grupa  $grupa
     * @return mixed
     */
    public function update(User $user, Grupa $grupa)
    {
        return $user->can('update Grupa');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grupa  $grupa
     * @return mixed
     */
    public function delete(User $user, Grupa $grupa)
    {
        return $user->can('delete Grupa');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grupa  $grupa
     * @return mixed
     */
    public function restore(User $user, Grupa $grupa)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grupa  $grupa
     * @return mixed
     */
    public function forceDelete(User $user, Grupa $grupa)
    {
        //
    }
}
