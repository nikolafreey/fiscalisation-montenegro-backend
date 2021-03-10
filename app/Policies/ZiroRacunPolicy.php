<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ZiroRacun;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZiroRacunPolicy
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
        return $user->can('view ZiroRacun');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ZiroRacun  $ziroRacun
     * @return mixed
     */
    public function view(User $user, ZiroRacun $ziroRacun)
    {
        return $user->can('show ZiroRacun');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create ZiroRacun');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ZiroRacun  $ziroRacun
     * @return mixed
     */
    public function update(User $user, ZiroRacun $ziroRacun)
    {
        return $user->can('update ZiroRacun');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ZiroRacun  $ziroRacun
     * @return mixed
     */
    public function delete(User $user, ZiroRacun $ziroRacun)
    {
        return $user->can('delete ZiroRacun');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ZiroRacun  $ziroRacun
     * @return mixed
     */
    public function restore(User $user, ZiroRacun $ziroRacun)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ZiroRacun  $ziroRacun
     * @return mixed
     */
    public function forceDelete(User $user, ZiroRacun $ziroRacun)
    {
        //
    }
}
