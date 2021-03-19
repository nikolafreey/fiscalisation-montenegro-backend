<?php

namespace App\Policies;

use App\Models\FizickoLice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FizickoLicePolicy
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
        return $user->can('view FizickoLice');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return mixed
     */
    public function view(User $user, FizickoLice $fizickoLice)
    {
        return $user->can('show FizickoLice');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create FizickoLice');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return mixed
     */
    public function update(User $user, FizickoLice $fizickoLice)
    {
        return $user->can('update FizickoLice');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return mixed
     */
    public function delete(User $user, FizickoLice $fizickoLice)
    {
        return $user->can('delete FizickoLice');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return mixed
     */
    public function restore(User $user, FizickoLice $fizickoLice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return mixed
     */
    public function forceDelete(User $user, FizickoLice $fizickoLice)
    {
        //
    }
}
