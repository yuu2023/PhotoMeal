<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'introduction',
        'icon',
        'area',
        'area_visibility',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function goodingMeals()
    {
        return $this->belongsToMany(Meal::class, 'meal_goods', 'user_id', 'meal_id');
    }

    public function isGoodingMeal(Meal $meal) : bool
    {
        foreach ($this->goodingMeals as $goodingMeal) {
            if($goodingMeal->id === $meal->id) {
                return true;
            }
        }
        return false;
    }

    public function favoritingMeals()
    {
        return $this->belongsToMany(Meal::class, 'meal_favorites', 'user_id', 'meal_id');
    }

    public function isFavoritingingMeal(Meal $meal) : bool {
        foreach ($this->favoritingMeals as $favoritingMeal) {
            if($favoritingMeal->id === $meal->id) {
                return true;
            }
        }
        return false;
    }

    public function friendingUsers()
    {
        return $this->belongsToMany(User::class, 'friends', 'friending_user_id', 'friended_user_id');
    }

    public function friendedUsers()
    {
        return $this->belongsToMany(User::class, 'friends', 'friended_user_id', 'friending_user_id');
    }

    public function mealComments()
    {
        return $this->hasMany(MealComment::class);
    }

    public function mealReplies()
    {
        return $this->hasMany(MealReply::class);
    }

    public static function myStore(&$validated)
    {
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        if(isset($validated['icon_file'])) {
            $file=$validated['icon_file'];
            $fileName=$file->getClientOriginalName();
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $user->icon = $user->id.'.'.$extension;
            $user->save();
        }

        return $user;
    }

    public function myUpdate(&$validated)
    {
        if($validated['icon_change_flag'] === '1') {
            if(isset($validated['icon_file'])) {
                $file=$validated['icon_file']->getClientOriginalName();
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $validated['icon'] = $this->id.'.'.$extension;
            } else {
                $validated['icon'] = null;
            }
        }

        if(!isset($validated['area'])) {
            $validated['area_visibility'] = "private";
        }

        $this->update($validated);
    }

    public function myDestroy()
    {
        $this->delete();
    }
}
