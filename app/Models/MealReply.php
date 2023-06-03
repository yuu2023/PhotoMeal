<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_comment_id',
        'user_id',
        'text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mealComment()
    {
        return $this->belongsTo(MealComment::class);
    }

    public static function myIndex(MealComment $mealComment)
    {
        return MealReply::Where('meal_comment_id', $mealComment->id)->orderBy('updated_at', 'desc')->with(['user'])->paginate(10);
    }

    public static function myStore($validated, $mealComment, $requestUser)
    {
        $validated['user_id'] = $requestUser->id;
        $validated['meal_comment_id'] = $mealComment->id;
        MealReply::create($validated);
        $mealComment->touch();
    }

    public function myUpdate($validated)
    {
        $this->update($validated);
        $this->touch();
        $this->mealComment->touch();
    }

    public function myDestroy()
    {
        $this->delete();
    }
}
