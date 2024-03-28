<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Gender;
use App\Models\Language;
use App\Models\User;
use App\Models\User_description;
use App\Notifications\FeedbackNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('client.pages.dashboard');
    }

    /**
     * @return View
     */
    public function orders(): View
    {
        return view('client.pages.orders');
    }

    /**
     * @return View
     */
    public function history(): View
    {
        return view('client.pages.history');
    }

    /**
     * @return View
     */
    public function messages(): View
    {
        return view('client.pages.messages');
    }

    /**
     * @return View
     */
    public function profile(): View
    {
        $user = User::find(Auth::user()->getAuthIdentifier());
        $description = $user->user_descriptions->first();

        $description = !is_null($description)?$description->toArray():[];

        $genders = Gender::all();
        $lang = Language::getStatus();

        return view('client.pages.profile',
            [
                'user' => $user,
                'description' => $description,
                'genders' => $genders,
                'lang' => $lang,
            ]);
    }

    /**
     * @return View
     */
    public function feedback(): View
    {
        $user = Auth::user()->email;

        return view('client.user.feedback', ['client' => $user]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function send_feedback(Request $request): RedirectResponse
    {
        $request->validate([
            'message' => 'required|string',
            'client' => 'required|string',
        ]);

        $admin = User::where('email', env('MAIL_FROM_ADDRESS'))->first();
        $admin->notify(new FeedbackNotification($request->client, $request->message));

        return Redirect::back();
    }

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
        $id = $request->user()->id;
        $data = $request->validated();
        User::set_update($id, $data);
        User_description::set_update($id, $data);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::back();
    }

    /**
     * Delete the user's account.
     * @param Request $request
     * @return RedirectResponse
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
