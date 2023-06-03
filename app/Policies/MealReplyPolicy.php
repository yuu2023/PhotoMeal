<?php

namespace App\Policies;

use App\Models\MealReply;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MealReplyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MealReply $mealReply): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MealReply $mealReply): bool
    {
        if($user->id === $mealReply->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MealReply $mealReply): bool
    {
        if($user->id === $mealReply->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MealReply $mealReply): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MealReply $mealReply): bool
    {
        return false;
    }
}
