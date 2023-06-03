<?php

use App\Http\Controllers\API\HotPepperController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\API\YOLPController;
use App\Http\Controllers\MealCommentController;
use App\Http\Controllers\MealFavoriteController;
use App\Http\Controllers\MealGoodController;
use App\Http\Controllers\MealReplyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('meal', MealController::class)->except(['create', 'edit']);
    Route::post('mealGood', [MealGoodController::class, 'store'])->name('mealGood.store');
    Route::delete('mealGood', [MealGoodController::class, 'destroy'])->name('mealGood.destroy');
    Route::post('mealFavorite', [MealFavoriteController::class, 'store'])->name('mealFavorite.store');
    Route::delete('mealFavorite', [MealFavoriteController::class, 'destroy'])->name('mealFavorite.destroy');
    Route::get('meal/{meal}/mealComment', [MealCommentController::class, 'index'])->name('mealComment.index');
    Route::post('meal/{meal}/mealComment', [MealCommentController::class, 'store'])->name('mealComment.store');
    Route::resource('mealComment', MealCommentController::class)->except(['index', 'create', 'store', 'edit']);
    Route::post('mealComment/{mealComment}/mealReply', [MealReplyController::class, 'store'])->name('mealReply.store');
    Route::resource('mealReply', MealReplyController::class)->except(['index', 'create', 'store', 'show', 'edit']);
    Route::post('/hotpepper/getShopsByCoords', [HotPepperController::class, 'getShopsByCoords']);
    Route::post('/hotpepper/getShopsByWord', [HotPepperController::class, 'getShopsByWord']);
});

Route::post('/yolp/getAreaByCoords', [YOLPController::class, 'getAreaByCoords']);
Route::post('/yolp/getAreasByWord', [YOLPController::class, 'getAreasByWord']);

require __DIR__.'/auth.php';
