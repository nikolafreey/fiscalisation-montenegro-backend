<?php

namespace App\Policies;

use App\Models\Dokument;
use App\Models\OvlascenoLice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DokumentPolicy
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
        return $user->can('view Dokument');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dokument  $dokument
     * @return mixed
     */
    public function view(User $user, Dokument $dokument)
    {
        return $user->can('show Dokument');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create Dokument');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dokument  $dokument
     * @return mixed
     */
    public function update(User $user, Dokument $dokument)
    {
        return $user->can('update Dokument');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dokument  $dokument
     * @return mixed
     */
    public function delete(User $user, Dokument $dokument)
    {
        return $user->can('delete Dokument');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dokument  $dokument
     * @return mixed
     */
    public function restore(User $user, Dokument $dokument)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dokument  $dokument
     * @return mixed
     */
    public function forceDelete(User $user, Dokument $dokument)
    {
        //
    }
}
