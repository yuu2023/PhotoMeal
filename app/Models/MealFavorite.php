<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealFavorite extends Model
{
    use HasFactory;

    protected $primaryKey = ['meal_id', 'user_id'];
    public $incrementing = false;
    protected $table = 'meal_favorites';

    protected $fillable = [
        'meal_id',
        'user_id'
    ];

    public static function getMealFavoriteNum(string $mealId)
    {
        return MealFavorite::where('meal_id' , $mealId)->count();
    }

    public static function myStore($validated, User $requestUser)
    {
        $validated['user_id'] = $requestUser->id;
        $mealFavorite = MealFavorite::where('meal_id' , $validated['meal_id'])->where('user_id' , $validated['user_id'])->first();
        if($mealFavorite === null) {
            return MealFavorite::create($validated);
        }

        return $mealFavorite;
    }

    public static function myDestroy(Meal $meal, User $requestUser)
    {
        $meal->favoritedUsers()->detach($requestUser->id);
    }
}
