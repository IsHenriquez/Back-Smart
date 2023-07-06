<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicles  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vehicles $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Vehicles  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Vehicles $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicles  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vehicles $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicles  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vehicles $model)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicles  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vehicles $model)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehicles  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vehicles $model)
    {
        return true;
    }
}
