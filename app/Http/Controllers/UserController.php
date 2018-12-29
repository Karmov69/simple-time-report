<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Role as RoleConst;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::get();
        $usersCount = count($users);
        for ($i=0; $i < $usersCount; $i++) {
            $users[$i]->role = $users[$i]->getRoleNames()[0];
        }

        return view('users.index', compact('users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('users.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::create(
            [
                'name' => $request['name'],
                'lastname' => $request['lastname'],
                'plane_hours' => $request['plane_hours'],
                'week_hours' => $request['week_hours'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]
        );

        if ($request['role'] === RoleConst::ROLE_ADMIN) {
            $user->assignRole(RoleConst::ROLE_ADMIN);
        } else {
            $user->assignRole(RoleConst::ROLE_USER);
        }

        $user->save();

        return redirect(route('users.index'))
            ->with('status', 'Пользователь успешно создан');
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $user = User::findOrFail($id);
        $role = preg_replace('/[^a-z_]/i', '', $user->getRoleNames());

        return view('users.edit', compact('user','role'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $oldRole = preg_replace('/[^a-z_]/i', '', $user->getRoleNames());

        $user->name   = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->plane_hours = $request->input('plane_hours');
        $user->week_hours = $request->input('week_hours');
        $user->removeRole($oldRole);
        $user->assignRole($request->input('role'));
        if ($request->password !== null) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect(route('users.index'))->with('status', 'Пользователь успешно обновлен');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(route('users.index'))->with('status', 'Пользователь удален');
    }
}