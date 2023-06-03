<?php

namespace App\Http\Controllers;

use App\Http\Requests\MealGoodRequest;
use App\Models\Meal;
use App\Models\MealGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealGoodController extends Controller
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
    public function store(MealGoodRequest $request)
    {
        $validated = $request->validated();
        $meal = Meal::myFind($validated['meal_id']);
        $this->authorize('isArrow', $meal);

        $mealFavorite = MealGood::myStore($validated, $request->user());
        $good_num = MealGood::getMealGoodNum($mealFavorite->meal_id);

        header('Content-type: application/json');
        echo json_encode(['good_num' => $good_num]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MealGood $mealGood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MealGood $mealGood)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MealGood $mealGood)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MealGoodRequest $request)
    {
        $validated = $request->validated();
        $meal = Meal::myFind($validated['meal_id']);
        $this->authorize('isArrow', $meal);

        MealGood::myDestroy($meal, $request->user());
        $good_num = MealGood::getMealGoodNum($meal->id);

        header('Content-type: application/json');
        echo json_encode(['good_num' => $good_num]);
    }
}
