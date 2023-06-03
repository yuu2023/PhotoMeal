<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\API\HotPepperController;
use DateTime;

class Shop extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'address',
        'open',
        'latitude',
        'longitude'
    ];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public static function mySave(Meal $meal)
    {
        if(empty($meal->shop_id)) {
            return;
        }

        $shop = Shop::find($meal->shop_id);
        if(is_null($shop)) {
            //店がデータベースに登録されていないとき

            $shopInfo = HotPepperController::getShopById($meal->shop_id);
            if(!empty($shopInfo)) {
                Shop::create($shopInfo);
            } else {
                $meal->shop_id = null;
                $meal->save();
            }
        } else {
            //店がデータベースに登録されているとき

            $now = new DateTime();
            $interval = $shop->updated_at->diff($now);

            if ($interval->d > 7) {
                // 一週間更新されていないとき

                $shopInfo = HotPepperController::getShopById($meal->shop_id);
                if(!empty($shopInfo)) {
                    $shop->save($shopInfo);
                    $shop->touch();
                } else {
                    // ホットペッパーからお店の情報が消えているときは、そのままデータベースの情報を使う。アップデート日時だけ更新する。
                    $shop->touch();
                }
            }
        }
    }
}
