<?php

namespace App\Policies;

use App\Models\Racun;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RacunPolicy
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
        return $user->can('view Racun');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Racun  $racun
     * @return mixed
     */
    public function view(User $user, Racun $racun)
    {
        return $user->can('show Racun');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create Racun');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Racun  $racun
     * @return mixed
     */
    public function update(User $user, Racun $racun)
    {
        return $user->can('update Racun') && $racun->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Racun  $racun
     * @return mixed
     */
    public function delete(User $user, Racun $racun)
    {
        return $user->can('delete Racun') && $racun->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Racun  $racun
     * @return mixed
     */
    public function restore(User $user, Racun $racun)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Racun  $racun
     * @return mixed
     */
    public function forceDelete(User $user, Racun $racun)
    {
        //
    }
}
