<?php
/**
 * MyClass File Doc Comment
 * php version 7.2
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Pugofka <info@pugofka.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */
namespace App\Http\Controllers;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Role as RoleConst;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @package  MyPackage
 * @author   Pugofka <info@pugofka.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */
class UserController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::get();

        return view('users.index', compact('users'));
    }

    /**
     * Сreation of users by the administrator
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::query()
            ->select('id', 'name')
            ->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Store of users by the administrator
     *
     * @param Request $request Request for create single user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::create(
            [
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'plane_hours' => $request->input('plane_hours'),
                'week_hours' => $request->input('week_hours'),
                'email' => $request->input('email'),
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
     * Editin of users by the administrator
     *
     * @param int $id The user id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role = $user->roles->first()->name ?? RoleConst::ROLE_USER;
        $roles = Role::query()
            ->select('id', 'name')
            ->get();

        return view('users.edit', compact('user', 'role', 'roles'));
    }

    /**
     * Updating of users by the administrator
     *
     * @param int     $id      The user id
     * @param Request $request Request for update single user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $oldRole = $user->roles->first()->name;
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->plane_hours = $request->input('plane_hours');
        $user->week_hours = $request->input('week_hours');

        if ($oldRole !== $request->input('role')) {
            $user->removeRole($oldRole);
            $user->assignRole($request->input('role'));
        }
        if ($request->password !== null) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect(route('users.index'))
            ->with('status', 'Пользователь успешно обновлен');
    }

    /**
     * Destroy of users by the administrator
     *
     * @param int $id The user id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(
            route('users.index')
        )->with('status', 'Пользователь успешно удален');
    }
}