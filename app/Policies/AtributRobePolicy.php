<?php

namespace App\Policies;

use App\Models\AtributRobe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AtributRobePolicy
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
        return $user->can('view AtributRobe');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AtributRobe  $atributRobe
     * @return mixed
     */
    public function view(User $user, AtributRobe $atributRobe)
    {
        return $user->can('show AtributRobe');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create AtributRobe');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AtributRobe  $atributRobe
     * @return mixed
     */
    public function update(User $user, AtributRobe $atributRobe)
    {
        return $user->can('update AtributRobe') && $atributRobe->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AtributRobe  $atributRobe
     * @return mixed
     */
    public function delete(User $user, AtributRobe $atributRobe)
    {
        return $user->can('delete AtributRobe') && $atributRobe->user_id === $user->id;;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AtributRobe  $atributRobe
     * @return mixed
     */
    public function restore(User $user, AtributRobe $atributRobe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AtributRobe  $atributRobe
     * @return mixed
     */
    public function forceDelete(User $user, AtributRobe $atributRobe)
    {
        //
    }
}
