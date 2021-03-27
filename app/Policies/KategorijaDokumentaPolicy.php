<?php

namespace App\Policies;

use App\Models\Kategorija;
use App\Models\KategorijaDokumenta;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategorijaDokumentaPolicy
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
        return $user->can('view KategorijaDokumenta');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaDokumenta  $kategorijaDokumenta
     * @return mixed
     */
    public function view(User $user, KategorijaDokumenta $kategorijaDokumenta)
    {
        return $user->can('show KategorijaDokumenta');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create KategorijaDokumenta');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaDokumenta  $kategorijaDokumenta
     * @return mixed
     */
    public function update(User $user, KategorijaDokumenta $kategorijaDokumenta)
    {
        return $user->can('update KategorijaDokumenta');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaDokumenta  $kategorijaDokumenta
     * @return mixed
     */
    public function delete(User $user, KategorijaDokumenta $kategorijaDokumenta)
    {
        return $user->can('delete KategorijaDokumenta');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaDokumenta  $kategorijaDokumenta
     * @return mixed
     */
    public function restore(User $user, KategorijaDokumenta $kategorijaDokumenta)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KategorijaDokumenta  $kategorijaDokumenta
     * @return mixed
     */
    public function forceDelete(User $user, KategorijaDokumenta $kategorijaDokumenta)
    {
        //
    }
}
