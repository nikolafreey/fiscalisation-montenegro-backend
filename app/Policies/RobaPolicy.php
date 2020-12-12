<?php

namespace App\Policies;

use App\Models\Roba;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class RobaPolicy
{
    use HandlesAuthorization;

    private function getDozvole(User $user, Request $request)
    {
        return $user->dozvole($request->preduzece_id)->where('model', 'robe')->first();
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Request $request)
    {
        return $this->getDozvole($user, $request)->can_read;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roba  $roba
     * @return mixed
     */
    public function view(User $user, Roba $roba, Request $request)
    {
        return $this->getDozvole($user, $request)->can_read || $roba->user_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user, Request $request)
    {
        return $this->getDozvole($user, $request)->can_create;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roba  $roba
     * @return mixed
     */
    public function update(User $user, Roba $roba, Request $request)
    {
        return $this->getDozvole($user, $request)->can_edit;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roba  $roba
     * @return mixed
     */
    public function delete(User $user, Roba $roba, Request $request)
    {
        return $this->getDozvole($user, $request)->can_delete;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roba  $roba
     * @return mixed
     */
    public function restore(User $user, Roba $roba)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roba  $roba
     * @return mixed
     */
    public function forceDelete(User $user, Roba $roba)
    {
        return false;
    }
}
