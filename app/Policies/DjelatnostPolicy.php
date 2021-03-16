<?php

namespace App\Policies;

use App\Models\Djelatnost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DjelatnostPolicy
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
        return $user->can('view Djelatnost');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Djelatnost  $djelatnost
     * @return mixed
     */
    public function view(User $user, Djelatnost $djelatnost)
    {
        return $user->can('show Djelatnost');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create Djelatnost');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Djelatnost  $djelatnost
     * @return mixed
     */
    public function update(User $user, Djelatnost $djelatnost)
    {
        return $user->can('update Djelatnost');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Djelatnost  $djelatnost
     * @return mixed
     */
    public function delete(User $user, Djelatnost $djelatnost)
    {
        return $user->can('delete Djelatnost');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Djelatnost  $djelatnost
     * @return mixed
     */
    public function restore(User $user, Djelatnost $djelatnost)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Djelatnost  $djelatnost
     * @return mixed
     */
    public function forceDelete(User $user, Djelatnost $djelatnost)
    {
        //
    }
}
