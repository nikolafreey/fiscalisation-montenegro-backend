<?php

namespace App\Policies;

use App\Models\PoslovnaJedinica;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PoslovnaJedinicaPolicy
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
        return $user->canAny(['view all PoslovnaJedinica', 'view owned PoslovnaJedinica']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PoslovnaJedinica  $poslovnaJedinica
     * @return mixed
     */
    public function view(User $user, PoslovnaJedinica $poslovnaJedinica)
    {
        return $user->can('show PoslovnaJedinica');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create PoslovnaJedinica');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PoslovnaJedinica  $poslovnaJedinica
     * @return mixed
     */
    public function update(User $user, PoslovnaJedinica $poslovnaJedinica)
    {
        return $user->can('update PoslovnaJedinica') && $poslovnaJedinica->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PoslovnaJedinica  $poslovnaJedinica
     * @return mixed
     */
    public function delete(User $user, PoslovnaJedinica $poslovnaJedinica)
    {
        return $user->can('delete PoslovnaJedinica') && $poslovnaJedinica->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PoslovnaJedinica  $poslovnaJedinica
     * @return mixed
     */
    public function restore(User $user, PoslovnaJedinica $poslovnaJedinica)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PoslovnaJedinica  $poslovnaJedinica
     * @return mixed
     */
    public function forceDelete(User $user, PoslovnaJedinica $poslovnaJedinica)
    {
        //
    }
}
