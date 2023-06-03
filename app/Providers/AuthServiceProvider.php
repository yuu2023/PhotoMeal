<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Meal;
use App\Models\MealComment;
use App\Models\MealReply;
use App\Policies\MealCommentPolicy;
use App\Policies\MealPolicy;
use App\Policies\MealReplyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Meal::class => MealPolicy::class,
        MealComment::class => MealCommentPolicy::class,
        MealReply::class => MealReplyPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
