<?php

namespace App\Policies;

use App\Models\Ovlascenolice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OvlascenoLicePolicy
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
        return $user->can('view OvlascenoLice');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ovlascenolice  $ovlascenolice
     * @return mixed
     */
    public function view(User $user, Ovlascenolice $ovlascenolice)
    {
        return $user->can('show OvlascenoLice');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create OvlascenoLice');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ovlascenolice  $ovlascenolice
     * @return mixed
     */
    public function update(User $user, Ovlascenolice $ovlascenolice)
    {
        return $user->can('update OvlascenoLice');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ovlascenolice  $ovlascenolice
     * @return mixed
     */
    public function delete(User $user, Ovlascenolice $ovlascenolice)
    {
        return $user->can('delete OvlascenoLice');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ovlascenolice  $ovlascenolice
     * @return mixed
     */
    public function restore(User $user, Ovlascenolice $ovlascenolice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ovlascenolice  $ovlascenolice
     * @return mixed
     */
    public function forceDelete(User $user, Ovlascenolice $ovlascenolice)
    {
        //
    }
}
