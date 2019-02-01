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
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __invoke(Request $request, UserFilter $filters)
    {
        $users = User::query()
            ->with('roles')
            ->where('id', '!=', \Auth::user()->id)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'aspirante');
            })
            ->filterBy($filters, $request->only([ 'role', 'search' ]))
            ->paginate(50);

        $users->appends($request->only([ 'role', 'search' ]));

        $roles = $this->getRoles();

        return view('administracion.users.index', compact('users', 'roles'));
    }

    protected function getRoles()
    {
        return Role::pluck('name');
    }
}
