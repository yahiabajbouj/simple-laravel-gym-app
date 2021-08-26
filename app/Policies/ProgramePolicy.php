<?php

namespace App\Policies;

use App\Models\Programe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramePolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Programe  $programe
     * @return mixed
     */
    public function view(User $user, Programe $programe)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Programe  $programe
     * @return mixed
     */
    public function update(User $user, Programe $programe)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Programe  $programe
     * @return mixed
     */
    public function delete(User $user, Programe $programe)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Programe  $programe
     * @return mixed
     */
    public function restore(User $user, Programe $programe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Programe  $programe
     * @return mixed
     */
    public function forceDelete(User $user, Programe $programe)
    {
        //
    }
}
