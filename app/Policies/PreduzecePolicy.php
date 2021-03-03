<?php

namespace App\Policies;

use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PreduzecePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->tip_korisnika->first()->naziv === 'SuperAdmin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
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
        return false;
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
        return false;
    }
}
