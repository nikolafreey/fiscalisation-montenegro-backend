<?php

namespace App\Policies;

use App\Models\Ulazniracun;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UlazniRacunPolicy
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
        return $user->can('view UlazniRacun');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ulazniracun  $ulazniracun
     * @return mixed
     */
    public function view(User $user, Ulazniracun $ulazniracun)
    {
        return $user->can('show UlazniRacun');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create UlazniRacun');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ulazniracun  $ulazniracun
     * @return mixed
     */
    public function update(User $user, Ulazniracun $ulazniracun)
    {
        return $user->can('update UlazniRacun');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ulazniracun  $ulazniracun
     * @return mixed
     */
    public function delete(User $user, Ulazniracun $ulazniracun)
    {
        return $user->can('delete UlazniRacun');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ulazniracun  $ulazniracun
     * @return mixed
     */
    public function restore(User $user, Ulazniracun $ulazniracun)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ulazniracun  $ulazniracun
     * @return mixed
     */
    public function forceDelete(User $user, Ulazniracun $ulazniracun)
    {
        //
    }
}
