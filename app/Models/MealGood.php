<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealGood extends Model
{
    use HasFactory;

    protected $primaryKey = ['meal_id', 'user_id'];
    public $incrementing = false;
    protected $table = 'meal_goods';

    protected $fillable = [
        'meal_id',
        'user_id'
    ];

    public static function getMealGoodNum(string $mealId)
    {
        return MealGood::where('meal_id' , $mealId)->count();
    }

    public static function myStore($validated, User $requestUser)
    {
        $validated['user_id'] = $requestUser->id;
        $mealGood = MealGood::where('meal_id' , $validated['meal_id'])->where('user_id' , $validated['user_id'])->first();
        if($mealGood === null) {
            return MealGood::create($validated);
        }

        return $mealGood;
    }

    public static function myDestroy(Meal $meal, User $requestUser)
    {
        $meal->goodedUsers()->detach($requestUser->id);
    }
}
