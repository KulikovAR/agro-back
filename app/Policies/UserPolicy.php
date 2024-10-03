<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function before($user, $ability): ?bool
    {
        if ($user->hasRole(RoleEnum::ADMIN->value)) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function createCounteragent(User $user): Response
    {
        if ($user->hasRole(RoleEnum::LOGISTICIAN->value)) {
            return Response::allow();
        }

        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function updateCounteragent(User $user, User $model): Response
    {
        if ($user->hasRole(RoleEnum::LOGISTICIAN->value) && $user->counteragents->contains($model)) {
            return Response::allow();
        }

        if ($model->id == $user->id && $user->hasRole(RoleEnum::CLIENT->value)) {
            return Response::allow();
        }

        return Response::denyAsNotFound();
    }

    public function indexCounteragent(User $user): Response
    {
        if ($user->hasRole(RoleEnum::LOGISTICIAN->value)) {
            return Response::allow();
        }

        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return true;
    }
}
