<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Http\Requests\ReplyStoreRequest;
use App\Http\Requests\ReplyUpdateRequest;
use App\Models\Meal;
use App\Models\MealComment;
use App\Models\MealReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MealReplyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MealReply::class, 'mealReply');
    }

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
    public function store(ReplyStoreRequest $request, MealComment $mealComment)
    {
        $meal = $mealComment->meal;
        $this->authorize('isArrow', $meal);
        $validated = $request->validated();

        MealReply::myStore($validated, $mealComment, $request->user());

        return Redirect::route('mealComment.show', compact('mealComment'))->with('status', 'reply-store');
    }

    /**
     * Display the specified resource.
     */
    public function show(MealReply $mealReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MealReply $mealReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReplyUpdateRequest $request, MealReply $mealReply)
    {
        $mealComment = $mealReply->mealComment;
        $meal = $mealComment->meal;
        $this->authorize('isArrow', $meal);
        $validated = $request->validated();

        $mealReply->myUpdate($validated);

        return Redirect::route('mealComment.show', compact('mealComment'))->with('status', 'reply-update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MealReply $mealReply)
    {
        $mealComment = $mealReply->mealComment;
        $meal = $mealComment->meal;
        $this->authorize('isArrow', $meal);

        $mealReply->myDestroy();

        return Redirect::route('mealComment.show', compact('mealComment'))->with('status', 'reply-delete');
    }
}
