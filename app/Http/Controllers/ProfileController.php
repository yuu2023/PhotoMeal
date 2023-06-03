<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileDestroyRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = $request->user();
        $oldIcon = $user->icon;
        $user->myUpdate($validated);

        if($validated['icon_change_flag'] === '1') {
            if(!empty($oldIcon)) {
                Storage::delete('./public/images/icons/'.$oldIcon);
            }

            if(isset($validated['icon_file'])) {
                $validated['icon_file']->move('storage/images/icons', $user->icon);
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(ProfileDestroyRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = $request->user();
        Auth::logout();

        // アイコンの画像を削除
        if(!empty($user->icon)) {
            Storage::delete('./public/images/icons/'.$user->icon);
        }

        // 料理の画像を削除
        foreach($user->meals as $meal) {
            Storage::delete('./public/images/meals/'.$meal->photo);
        }

        $user->myDestroy();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login?status=profile-destroyed');
    }
}
