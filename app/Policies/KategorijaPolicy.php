<?php

namespace App\Policies;

use App\Models\Kategorija;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategorijaPolicy
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
        return $user->can('view Kategorija');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategorija  $kategorija
     * @return mixed
     */
    public function view(User $user, Kategorija $kategorija)
    {
        return $user->can('show Kategorija');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create Kategorija');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategorija  $kategorija
     * @return mixed
     */
    public function update(User $user, Kategorija $kategorija)
    {
        return $user->can('update Kategorija');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategorija  $kategorija
     * @return mixed
     */
    public function delete(User $user, Kategorija $kategorija)
    {
        return $user->can('delete Kategorija');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategorija  $kategorija
     * @return mixed
     */
    public function restore(User $user, Kategorija $kategorija)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategorija  $kategorija
     * @return mixed
     */
    public function forceDelete(User $user, Kategorija $kategorija)
    {
        //
    }
}
