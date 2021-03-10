<?php

namespace App\Policies;

use App\Models\Porez;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PorezPolicy
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
        return $user->can('view Porez');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Porez  $porez
     * @return mixed
     */
    public function view(User $user, Porez $porez)
    {
        return $user->can('show Porez');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create Porez');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Porez  $porez
     * @return mixed
     */
    public function update(User $user, Porez $porez)
    {
        return $user->can('update Porez');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Porez  $porez
     * @return mixed
     */
    public function delete(User $user, Porez $porez)
    {
        return $user->can('delete Porez');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Porez  $porez
     * @return mixed
     */
    public function restore(User $user, Porez $porez)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Porez  $porez
     * @return mixed
     */
    public function forceDelete(User $user, Porez $porez)
    {
        //
    }
}
