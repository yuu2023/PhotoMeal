<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Meal;
use App\Models\MealComment;
use App\Models\MealReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MealCommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MealComment::class, 'mealComment');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Meal $meal)
    {
        $this->authorize('isArrow', $meal);
        $mealComments = MealComment::myIndex($meal);
        return view('mealComment.index', compact('mealComments', 'meal'));
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
    public function store(CommentRequest $request, Meal $meal)
    {
        $this->authorize('isArrow', $meal);
        $validated = $request->validated();
        $mealComment = MealComment::myStore($validated, $meal, $request->user());

        return Redirect::route('mealComment.show', compact('mealComment'))->with('status', 'comment-store');
    }

    /**
     * Display the specified resource.
     */
    public function show(MealComment $mealComment)
    {
        $meal = $mealComment->meal;
        $this->authorize('isArrow', $meal);
        $mealReplies = MealReply::myIndex($mealComment);
        return view('mealComment.show', compact('mealComment', 'meal', 'mealReplies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MealComment $mealComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, MealComment $mealComment)
    {
        $meal = $mealComment->meal;
        $this->authorize('isArrow', $meal);
        $validated = $request->validated();
        $mealComment->myUpdate($validated);
        return Redirect::route('mealComment.show', compact('mealComment'))->with('status', 'comment-update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MealComment $mealComment)
    {
        $meal = $mealComment->meal;
        $this->authorize('isArrow', $meal);
        $mealComment->myDestroy();

        return Redirect::route('meal.show', compact('meal'))->with('status', 'comment-destroy');
    }
}
