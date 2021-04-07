<?php

namespace App\Policies;

use App\Models\PodKategorijaRobe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PodKategorijaRobePolicy
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
        return $user->can('view PodKategorijaRobe');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PodKategorijaRobe  $podKategorijaRobe
     * @return mixed
     */
    public function view(User $user, PodKategorijaRobe $podKategorijaRobe)
    {
        return $user->can('show PodKategorijaRobe');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create PodKategorijaRobe');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PodKategorijaRobe  $podKategorijaRobe
     * @return mixed
     */
    public function update(User $user, PodKategorijaRobe $podKategorijaRobe)
    {
        return $user->can('update PodKategorijaRobe') && $podKategorijaRobe->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PodKategorijaRobe  $podKategorijaRobe
     * @return mixed
     */
    public function delete(User $user, PodKategorijaRobe $podKategorijaRobe)
    {
        return $user->can('delete PodKategorijaRobe') && $podKategorijaRobe->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PodKategorijaRobe  $podKategorijaRobe
     * @return mixed
     */
    public function restore(User $user, PodKategorijaRobe $podKategorijaRobe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PodKategorijaRobe  $podKategorijaRobe
     * @return mixed
     */
    public function forceDelete(User $user, PodKategorijaRobe $podKategorijaRobe)
    {
        //
    }
}
