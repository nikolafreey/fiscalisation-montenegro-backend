<?php

namespace App\Policies;

use App\Models\JedinicaMjere;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JedinicaMjerePolicy
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
        return $user->can('view JedinicaMjere');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JedinicaMjere  $jedinicaMjere
     * @return mixed
     */
    public function view(User $user, JedinicaMjere $jedinicaMjere)
    {
        return $user->can('show JedinicaMjere');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create JedinicaMjere');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JedinicaMjere  $jedinicaMjere
     * @return mixed
     */
    public function update(User $user, JedinicaMjere $jedinicaMjere)
    {
        return $user->can('update JedinicaMjere');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JedinicaMjere  $jedinicaMjere
     * @return mixed
     */
    public function delete(User $user, JedinicaMjere $jedinicaMjere)
    {
        return $user->can('delete JedinicaMjere');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JedinicaMjere  $jedinicaMjere
     * @return mixed
     */
    public function restore(User $user, JedinicaMjere $jedinicaMjere)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JedinicaMjere  $jedinicaMjere
     * @return mixed
     */
    public function forceDelete(User $user, JedinicaMjere $jedinicaMjere)
    {
        //
    }
}
