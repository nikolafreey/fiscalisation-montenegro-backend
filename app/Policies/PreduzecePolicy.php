<?php

namespace App\Policies;

use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PreduzecePolicy
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
        return $user->can('view Preduzece');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preduzece  $preduzece
     * @return mixed
     */
    public function view(User $user, Preduzece $preduzece)
    {
        return $user->can('show Preduzece') && $user->id === $preduzece->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create Preduzece');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preduzece  $preduzece
     * @return mixed
     */
    public function update(User $user, Preduzece $preduzece)
    {
        return $user->can('update Preduzece') &&
            in_array($preduzece, $user->preduzeca->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preduzece  $preduzece
     * @return mixed
     */
    public function delete(User $user, Preduzece $preduzece)
    {
        return $user->can('delete Preduzece') &&
            in_array($preduzece, $user->preduzeca->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preduzece  $preduzece
     * @return mixed
     */
    public function restore(User $user, Preduzece $preduzece)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preduzece  $preduzece
     * @return mixed
     */
    public function forceDelete(User $user, Preduzece $preduzece)
    {
        //
    }
}
