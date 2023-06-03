<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_id',
        'user_id',
        'text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function mealReplies()
    {
        return $this->hasMany(MealReply::class)->orderBy('updated_at', 'desc');
    }

    public static function myIndex(Meal $meal)
    {
        return MealComment::Where('meal_id', $meal->id)->orderBy('updated_at', 'desc')->with(['user'])->paginate(10);
    }

    public static function myStore($validated, Meal $meal, User $requestUser)
    {
        $validated['user_id'] = $requestUser->id;
        $validated['meal_id'] = $meal->id;
        return MealComment::create($validated);
    }

    public function myUpdate($validated)
    {
        $this->update($validated);
        $this->touch();
    }

    public function myDestroy()
    {
        $this->delete();
    }
}
