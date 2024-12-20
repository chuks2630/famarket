<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('user_profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {   $userId = Auth::id();
        $user =User::findOrFail($userId);
        request()->validate([
            "firstname" => "required|max:255",
            "lastname" => "required|max:255",
            "phone" => "required|max:20",
            "profile-pic" => "nullable|file|mimes:png,jpg,jpeg|max:2048",
        ]);
        $user->fill([
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "phone" =>$request->phone
        ]);

        if(request()->hasFile('profile-pic') && request()->file('profile-pic')->isValid()){
            $filepath = request()->file('profile-pic')->store('uploads', 'public');
            $user->profile_pic = $filepath;
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
