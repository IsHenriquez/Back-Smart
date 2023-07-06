<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VehiclesBrand;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclesBrandPolicy
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
     * @param  \App\Models\VehiclesBrand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, VehiclesBrand $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\VehiclesBrand  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(VehiclesBrand $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VehiclesBrand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, VehiclesBrand $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VehiclesBrand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, VehiclesBrand $model)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VehiclesBrand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, VehiclesBrand $model)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VehiclesBrand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, VehiclesBrand $model)
    {
        return true;
    }
}
