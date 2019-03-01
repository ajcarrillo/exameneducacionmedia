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
use MediaSuperior\Http\Requests\StoreUser;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request, UserFilter $filters)
    {
        $users = User::query()
            ->with('roles')
            ->where('id', '!=', \Auth::user()->id)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'aspirante')
                    ->orWhere('name', 'supermario');
            })
            ->filterBy($filters, $request->only([ 'role', 'search' ]))
            ->paginate(50);

        $users->appends($request->only([ 'role', 'search' ]));

        $roles = $this->getRoles();

        return view('administracion.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = [ 'cordinador', 'departamento', 'subsistema', 'plantel', 'aspirante' ];

        return view('administracion.users.create', compact('roles'));
    }

    public function store(StoreUser $request)
    {
        User::createUser($request->input(), $request->input('roles'));

        flash('El usuario se creó correctamente')->success();

        return back();
    }

    protected function getRoles()
    {
        return Role::pluck('name');
    }
}
