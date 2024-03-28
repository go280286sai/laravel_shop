<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Language;
use App\Models\User;
use App\Models\User_comment;
use App\Models\User_description;
use App\Notifications\SendEmailUserNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')
            ->select('users.id as id', 'users.name', 'user_descriptions.last_name',
                'user_descriptions.phone', 'users.email', 'users.status')
            ->get();

        return view('client.admin.users.index', ['users' => $users]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {

        $user = User::join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')
            ->select('users.id as id', 'user_descriptions.id as user_description_id', 'users.name', 'user_descriptions.last_name',
                'user_descriptions.phone', 'user_descriptions.birthday', 'users.email', 'user_descriptions.gender_id')
            ->where('users.id', $id)
            ->first();
        $genders = Gender::all();
        $lang = Language::getStatus();

        return view('client.admin.users.edit', ['user' => $user, 'genders' => $genders, 'lang' => $lang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $data = $request->all();
        $data['new_password'] = null;
        User::set_update($id, $data);
        User_description::set_update($data['user_description_id'], $data);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        User::remove($id);

        return Redirect::back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function status(int $id): RedirectResponse
    {
        User::status($id);

        return Redirect::back();
    }

    /**
     * @return View
     */
    public function soft_deletes(): View
    {
        $users = User::onlyTrashed()->get();

        return view('client.admin.users.soft_deletes', ['users' => $users]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function soft_delete_user(Request $request): RedirectResponse
    {
        $id = $request->get('user_id');
        $target = $request->get('target');
        match (true) {
            $target == 'remove_user' => User::soft_remove($id),
            $target == 'recover_user' => User::soft_recovery($id),
            $target == 'remove_all' => self::delete_all(User::onlyTrashed()->get('id')),
            $target == 'recover_all' => self::recovery_all(User::onlyTrashed()->get('id')),
            default => null
        };

        return Redirect::back();
    }

    /**
     * @param object $data
     * @return void
     */
    public static function delete_all(object $data): void
    {
        foreach ($data as $item) {
            User::soft_remove($item->id);
        }
    }

    /**
     * @param object $data
     * @return void
     */
    public static function recovery_all(object $data): void
    {
        foreach ($data as $item) {
            User::soft_recovery($item->id);
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add_comment(Request $request): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string',
            'id' => 'required|integer',
        ]);
        User_comment::add_comment($request->all());

        return Redirect::back();
    }

    /**
     * @param int $id
     * @return View
     */
    public function comment(int $id): View
    {
        $user = User::find($id);
        $comment = User_comment::where('user_id', $id)->first();

        return view('client.admin.users.comment', ['user' => $user, 'comment' => $comment]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function email(int $id): View
    {
        $user = User::find($id);

        return view('client.admin.users.email', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function send_email(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'id' => 'required|integer',
        ]);
        $data = $request->all();
        $user = User::find($data['id']);
        $user->notify(new SendEmailUserNotification($data['content'], $data['title']));

        return Redirect::back();
    }
}
