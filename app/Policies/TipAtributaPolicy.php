<?php

namespace App\Policies;

use App\Models\TipAtributa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipAtributaPolicy
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
        return $user->can('view TipAtributa');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TipAtributa  $tipAtributa
     * @return mixed
     */
    public function view(User $user, TipAtributa $tipAtributa)
    {
        return $user->can('show TipAtributa');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create TipAtributa');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TipAtributa  $tipAtributa
     * @return mixed
     */
    public function update(User $user, TipAtributa $tipAtributa)
    {
        return $user->can('update TipAtributa') && $tipAtributa->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TipAtributa  $tipAtributa
     * @return mixed
     */
    public function delete(User $user, TipAtributa $tipAtributa)
    {
        return $user->can('delete TipAtributa') && $tipAtributa->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TipAtributa  $tipAtributa
     * @return mixed
     */
    public function restore(User $user, TipAtributa $tipAtributa)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TipAtributa  $tipAtributa
     * @return mixed
     */
    public function forceDelete(User $user, TipAtributa $tipAtributa)
    {
        //
    }
}
