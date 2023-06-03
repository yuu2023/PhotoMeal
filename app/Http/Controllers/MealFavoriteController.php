<?php

namespace App\Http\Controllers;

use App\Http\Requests\MealFavoriteRequest;
use App\Models\Meal;
use App\Models\MealFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealFavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MealFavoriteRequest $request)
    {
        $validated = $request->validated();
        $meal = Meal::myFind($validated['meal_id']);
        $this->authorize('isArrow', $meal);

        $mealFavorite = MealFavorite::myStore($validated, $request->user());
        $favorite_num = MealFavorite::getMealFavoriteNum($mealFavorite->meal_id);

        header('Content-type: application/json');
        echo json_encode(['favorite_num' => $favorite_num]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MealFavorite $mealFavorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MealFavorite $mealFavorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MealFavorite $mealFavorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MealFavoriteRequest $request)
    {
        $validated = $request->validated();
        $meal = Meal::myFind($validated['meal_id']);
        $this->authorize('isArrow', $meal);

        MealFavorite::myDestroy($meal, $request->user());
        $favorite_num = MealFavorite::getMealFavoriteNum($meal->id);

        header('Content-type: application/json');
        echo json_encode(['favorite_num' => $favorite_num]);
    }
}
