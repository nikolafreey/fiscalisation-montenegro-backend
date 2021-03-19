<?php

namespace App\Policies;

use App\Models\ProizvodjacRobe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProizvodjacRobePolicy
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
        return $user->can('view ProizvodjacRobe');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProizvodjacRobe  $proizvodjacRobe
     * @return mixed
     */
    public function view(User $user, ProizvodjacRobe $proizvodjacRobe)
    {
        return $user->can('show ProizvodjacRobe');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create ProizvodjacRobe');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProizvodjacRobe  $proizvodjacRobe
     * @return mixed
     */
    public function update(User $user, ProizvodjacRobe $proizvodjacRobe)
    {
        return $user->can('update ProizvodjacRobe') && $proizvodjacRobe->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProizvodjacRobe  $proizvodjacRobe
     * @return mixed
     */
    public function delete(User $user, ProizvodjacRobe $proizvodjacRobe)
    {
        return $user->can('delete ProizvodjacRobe') && $proizvodjacRobe->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProizvodjacRobe  $proizvodjacRobe
     * @return mixed
     */
    public function restore(User $user, ProizvodjacRobe $proizvodjacRobe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProizvodjacRobe  $proizvodjacRobe
     * @return mixed
     */
    public function forceDelete(User $user, ProizvodjacRobe $proizvodjacRobe)
    {
        //
    }
}
