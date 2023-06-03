<?php

namespace App\Policies;

use App\Models\Meal;
use App\Models\MealComment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MealCommentPolicy
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
    public function view(User $user, MealComment $mealComment): bool
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
    public function update(User $user, MealComment $mealComment): bool
    {
        if($user->id === $mealComment->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MealComment $mealComment): bool
    {
        if($user->id === $mealComment->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MealComment $mealComment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MealComment $mealComment): bool
    {
        return false;
    }
}
