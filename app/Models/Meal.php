<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'title',
        'introduction',
        'photo',
        'ate_date',
        'visibility',
        'can_others_use'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function goodedUsers()
    {
        return $this->belongsToMany(User::class, 'meal_goods', 'meal_id', 'user_id');
    }

    public function favoritedUsers()
    {
        return $this->belongsToMany(User::class, 'meal_favorites', 'meal_id', 'user_id');
    }

    public function mealComments()
    {
        return $this->hasMany(MealComment::class)->orderBy('updated_at', 'desc');
    }

    public static function myFind(string $mealId)
    {
        return Meal::find($mealId);
    }

    public static function myIndex(&$validated, User $requestUser)
    {
        $query = Meal::query();
        $query->leftjoin('users', 'meals.user_id', '=', 'users.id')
        ->leftjoin('shops', 'meals.shop_id', '=', 'shops.id')
        ->leftJoin('friends as meal_user_friending', 'meals.user_id', '=', 'meal_user_friending.friending_user_id')
        ->leftJoin('friends as meal_user_friended', 'meals.user_id', '=', 'meal_user_friended.friended_user_id')
        ->leftJoin('meal_favorites', 'meals.id', '=', 'meal_favorites.meal_id')
        ->withCount('goodedUsers');

        if(isset($validated['search'])) {
            $spaceConversion = mb_convert_kana($validated['search'], 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value) {
                $query->where(function(Builder $query2) use ($value) {
                    $query2->where('meals.title', 'like', '%'.$value.'%')
                    ->orWhere('meals.introduction', 'like', '%'.$value.'%')
                    ->orWhere('users.name', 'like', '%'.$value.'%')
                    ->orWhere('users.id', $value)
                    ->orWhere('shops.name', 'like', '%'.$value.'%')
                    ->orWhere('shops.address', 'like', '%'.$value.'%');
                });
            }
        } else {
            $validated['search'] = null;
        }

        self::fixFilter($validated, $requestUser);

        switch($validated['filter']) {
            case 'all':
                break;
            case 'own';
                $query->where('meals.user_id', $requestUser->id);
                break;
            case 'friend';
                $query->where('meal_user_friending.friended_user_id', $requestUser->id)
                ->where('meal_user_friended.friending_user_id', $requestUser->id);
                break;
            case 'favorite';
                $query->where('meal_favorites.user_id', $requestUser->id);
                break;
            case 'area';
                $query->Where('shops.address', 'like', '%'.$requestUser->area.'%');
                break;
            case 'near';
                $query->WhereRaw('(6378 * acos(cos(radians(?)) * cos(radians(shops.latitude)) * cos(radians(shops.longitude) - radians(?)) + sin(radians(?)) * sin(radians(shops.latitude)))) < 2', [$validated['latitude'], $validated['longitude'], $validated['latitude']]);
                break;
            default;
                break;
        }

        self::fixSort($validated);

        switch($validated['sort']) {
            case 'register':
                $query->orderBy('meals.created_at', 'desc');
                break;
            case 'good';
                $query->orderBy('gooded_users_count', 'desc')->orderBy('meals.created_at', 'desc');
                break;
            case 'random';
                $query->inRandomOrder();
                break;
            default;
                break;
        }

        self::fixMode($validated);

        // 公開範囲
        //  自分の料理なら表示
        //  publicなら表示
        //  friendsのとき、互いにfriendなら表示。
        $query->where(function(Builder $query3) use ($requestUser) {
            $query3->Where('meals.user_id', $requestUser->id)
            ->orwhere('visibility', 'public')
            ->orWhere(function(Builder $query4) use ($requestUser) {
                $query4->where('visibility', 'friends')
                ->where(function(Builder $query5) use ($requestUser) {
                    $query5->where('meal_user_friending.friended_user_id', $requestUser->id)
                    ->where('meal_user_friended.friending_user_id', $requestUser->id);
                });
            });
        });

        return $query->distinct()->with(['user', 'shop'])->paginate(9);
    }

    public static function myStore(&$validated, User $requestUser)
    {
        $validated['user_id'] = $requestUser->id;
        $exif = exif_read_data($validated['photo_file'], 0, true);
        if($exif !== false && isset($exif['EXIF']['DateTimeOriginal'])) {
            $validated['ate_date'] = $exif['EXIF']['DateTimeOriginal'];
        }

        $meal = Meal::create($validated);

        $file=$validated['photo_file'];
        $fileName = $file->getClientOriginalName();
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $photo = $meal->id.'.'.$extension;
        $meal->photo = $photo;
        $meal->save();

        return $meal;
    }

    public function myUpdate(&$validated)
    {
        if(isset($validated['photo_file'])) {
            $file = $validated['photo_file'];
            $exif = exif_read_data($file, 0, true);
            if($exif !== false && isset($exif['EXIF']['DateTimeOriginal'])) {
                $validated['ate_date'] = $exif['EXIF']['DateTimeOriginal'];
            } else {
                $validated['ate_date'] = null;
            }

            $fileName = $file->getClientOriginalName();
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $photo = $this->id.'.'.$extension;
            $validated['photo'] = $photo;
        }

        if(!isset($validated['shop_id'])) {
            $validated['shop_id'] = null;
        }

        $this->update($validated);
    }

    public function myDestroy()
    {
        $this->delete();
    }

    private static function fixFilter(&$validated, User $requestUser)
    {
        if(!self::checkFilter($validated)) {
            if(empty($requestUser->area)) {
                $validated['filter'] = 'all';
            } else {
                $validated['filter'] = 'area';
            }
        }
    }

    private static function checkFilter($validated): bool
    {
        if(!isset($validated['filter'])) {
            return false;
        }

        if(($validated['filter'] !== 'all' &&
        $validated['filter'] !== 'own' &&
        $validated['filter'] !== 'friend' &&
        $validated['filter'] !== 'favorite' &&
        $validated['filter'] !== 'area' &&
        $validated['filter'] !== 'near')){
            return false;
        }

        if($validated['filter'] === 'near') {
            if(!isset($validated['latitude']) || !isset($validated['longitude'])) {
                return false;
            }

            if(!is_numeric($validated['latitude']) || !is_numeric($validated['longitude'])) {
                return false;
            }
        }

        return true;
    }

    private static function fixSort(&$validated)
    {
        if(!self::checkSort($validated)) {
            $validated['sort'] = 'register';
        }
    }

    private static function checkSort($validated): bool
    {
        if(!isset($validated['sort'])) {
            return false;
        }

        if($validated['sort'] !== 'register' &&
        $validated['sort'] !== 'good' &&
        $validated['sort'] !== 'random') {
            return false;
        }

        return true;
    }

    private static function fixMode(&$validated)
    {
        if(!self::checkMode($validated)) {
            $validated['mode'] = 'grid';
        }
    }

    private static function checkMode($validated): bool
    {
        if(!isset($validated['mode'])) {
            return false;
        }

        if($validated['mode'] !== 'grid' &&
        $validated['mode'] !== 'detail' &&
        $validated['mode'] !== 'map') {
            return false;
        }

        return true;
    }
}
