<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-31
 * Time: 17:46
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\User;
use ExamenEducacionMedia\UserFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use MediaSuperior\Http\Requests\StoreUser;
use MediaSuperior\Http\Requests\UpdateUser;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request, UserFilter $filters)
    {
        $users = User::query()
            ->with('roles')
            ->notSeeMe()
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'aspirante');

                if ( ! \Auth::user()->hasRole('supermario')) {
                    $query->orWhere('name', 'supermario');
                }
            })
            ->filterBy($filters, $request->only([ 'role', 'search' ]))
            ->paginate(50);

        $users->appends($request->only([ 'role', 'search' ]));

        $roles = $this->getRolesToCreateUsers();

        return view('administracion.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        return $this->form('administracion.users.create', new User);
    }

    public function store(StoreUser $request)
    {
        User::createUser($request->input(), $request->input('roles'));

        flash('El usuario se creó correctamente')->success();

        return back();
    }

    public function edit(User $user)
    {
        return $this->form('administracion.users.edit', $user, false);
    }

    public function update(UpdateUser $request, User $user)
    {
        $user->update($request->validated());
        $user->syncRoles($request->input('roles'));

        flash('El usuario se actualizó correctamente')->success();

        return back();
    }

    protected function getRolesToCreateUsers(): array
    {
        $roles = [ 'cordinador', 'departamento', 'subsistema', 'plantel' ];

        if (get_user_roles()->contains('supermario')) {
            array_push($roles, 'supermario');
        }

        return $roles;
    }

    protected function form($view, User $user, $isCreate = true)
    {
        return view($view, [
            'roles'    => $this->getRolesToCreateUsers(),
            'user'     => $user,
            'isCreate' => $isCreate,
        ]);
    }
}
