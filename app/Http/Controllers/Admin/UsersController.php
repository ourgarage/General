<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Notifications;

class UsersController extends Controller
{
    private $user;

    public function __construct()
    {
        \Title::prepend(trans('dashboard.title.prepend'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $admins = $user->orderBy('updated_at', 'desc')->paginate(20);

        \Title::append(trans('users.title.index'));

        return view('admin.dashboard.users.index', ['user' => Auth::user(), 'admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Title::append(trans('users.title.create'));

        return view('admin.dashboard.users.create', ['user' => Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AdministratorCreationRequest $errors, User $user)
    {
        $user->create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
        ]);

        Notifications::success(trans('users.notification.user-created-success'), 'top');

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, User $user)
    {
        $admin = $user->find($id);

        \Title::append(trans('users.title.edit'));

        return view('admin.dashboard.users.edit', ['user' => Auth::user(), 'admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, User $user)
    {
        $user = $user->where('id', $id);

        $update = [
            'name' => request('name'),
            'email' => request('email')
        ];

        if (request()->has('change_password')) {
            $update = array_add($update, 'password', request('password'));
        }

        $user->update($update);

        Notifications::success(trans('users.notification.user-update'), 'top');

        return redirect()->route('admin.users.index');
    }

    public function updateStatus($id, User $user)
    {
        $user = $user->find($id);

        $user->update([
            'status' => $user->status == User::STATUS_ACTIVE ? User::STATUS_INACTIVE : User::STATUS_ACTIVE,
        ]);

        Notifications::success(trans('users.notification.status-change-update'), 'top');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        Notifications::success(trans('users.notification.user-delete'), 'top');

        return redirect()->back();
    }

    public function searchUsers(User $user)
    {
        if (!is_null(request('email'))) {
            $admins = $user->where('email', 'LIKE', '%' . e(request('email')) . '%')
                ->paginate(20);
        }

        \Title::append(trans('users.title.search'));

        return view('admin.dashboard.users.search', [
            'user' => Auth::user(),
            'admins' => $admins,
            'searchValue' => request('email')
        ]);
    }
}
