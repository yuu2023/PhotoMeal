<?php

namespace App\Http\Controllers;


use App\Http\Requests\MealIndexRequest;
use App\Http\Requests\MealStoreRequest;
use App\Http\Requests\MealUpdateRequest;
use App\Models\Meal;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Meal::class, 'meal');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(MealIndexRequest $request)
    {
        $validated = $request->validated();
        $meals = Meal::myIndex($validated, $request->user());
        $search = $validated["search"];
        $filter = $validated["filter"];
        $sort = $validated["sort"];
        $mode = $validated["mode"];

        return view('meal.index', compact('meals', 'search', 'filter', 'sort', 'mode'));
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
    public function store(MealStoreRequest $request)
    {
        $validated = $request->validated();
        $meal = Meal::myStore($validated, $request->user());
        $validated['photo_file']->move('storage/images/meals', $meal->photo);

        // showで実行されるため省略
        // Shop::mySave($meal);

        return Redirect::route('meal.show', compact('meal'))->with('status', 'meal-store');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meal $meal)
    {
        Shop::mySave($meal);
        return view('meal.show', compact('meal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meal $meal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MealUpdateRequest $request, Meal $meal)
    {
        $validated = $request->validated();
        $oldPhoto = $meal->photo;
        $meal->myUpdate($validated);

        if(isset($validated['photo_file'])) {
            Storage::delete('./public/images/meals/'.$oldPhoto);
            $validated['photo_file']->move('storage/images/meals', $meal->photo);
        }

        // //showで実行されるため省略
        // Shop::mySave($meal);

        return Redirect::route('meal.show', compact('meal'))->with('status', 'meal-update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        Storage::delete('./public/images/meals/'.$meal->photo);
        $meal->myDestroy();

        return Redirect::route('meal.index')->with('status', 'meal-destroy');
    }
}
