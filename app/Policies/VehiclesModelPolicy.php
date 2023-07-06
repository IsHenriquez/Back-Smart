<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VehiclesModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclesModelPolicy
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
     * @param  \App\Models\VehiclesModel  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, VehiclesModel $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\VehiclesModel  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(VehiclesModel $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VehiclesModel  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, VehiclesModel $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VehiclesModel  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, VehiclesModel $model)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VehiclesModel  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, VehiclesModel $model)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VehiclesModel  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, VehiclesModel $model)
    {
        return true;
    }
}
