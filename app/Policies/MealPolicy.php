<?php

namespace App\Policies;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MealPolicy
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
    public function view(User $user, Meal $meal): bool
    {
        return $this->isArrow($user, $meal);
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
    public function update(User $user, Meal $meal): bool
    {
        if($user->id === $meal->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Meal $meal): bool
    {
        if($user->id === $meal->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Meal $meal): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Meal $meal): bool
    {
        return false;
    }

    public function isArrow(User $user, Meal $meal): bool
    {
        if($user->id === $meal->user_id) {
            return true;
        }

        if($meal->visibility === 'public') {
            return true;
        }

        if($meal->visibility === 'friends') {
            foreach($user->friendingUsers as $friendingUser) {
                if($friendingUser->id === $meal->user_id) {
                    foreach($user->friendedUsers as $friendedUser) {
                        if($friendedUser->id === $meal->user_id) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }
}
