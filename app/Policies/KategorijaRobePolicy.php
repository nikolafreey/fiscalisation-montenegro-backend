<?php

namespace App\Policies;

use App\Models\KategorijaRobe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategorijaRobePolicy
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
        return $user->can('view KategorijaRobe');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return mixed
     */
    public function view(User $user, KategorijaRobe $kategorijaRobe)
    {
        return $user->can('show KategorijaRobe');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create KategorijaRobe');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return mixed
     */
    public function update(User $user, KategorijaRobe $kategorijaRobe)
    {
        return $user->can('update KategorijaRobe') && $kategorijaRobe->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return mixed
     */
    public function delete(User $user, KategorijaRobe $kategorijaRobe)
    {
        return $user->can('delete KategorijaRobe') && $kategorijaRobe->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return mixed
     */
    public function restore(User $user, KategorijaRobe $kategorijaRobe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return mixed
     */
    public function forceDelete(User $user, KategorijaRobe $kategorijaRobe)
    {
        //
    }
}
