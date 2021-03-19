<?php

namespace App\Policies;

use App\Models\Modul;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulPolicy
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
        return $user->can('view Modul');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Modul  $modul
     * @return mixed
     */
    public function view(User $user, Modul $modul)
    {
        return $user->can('show Modul');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create Modul');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Modul  $modul
     * @return mixed
     */
    public function update(User $user, Modul $modul)
    {
        return $user->can('update Modul') &&
            in_array($modul, $user->moduli->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Modul  $modul
     * @return mixed
     */
    public function delete(User $user, Modul $modul)
    {
        return $user->can('delete Modul') &&
            in_array($modul, $user->moduli->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Modul  $modul
     * @return mixed
     */
    public function restore(User $user, Modul $modul)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Modul  $modul
     * @return mixed
     */
    public function forceDelete(User $user, Modul $modul)
    {
        //
    }
}
