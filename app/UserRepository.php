<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-24
 * Time: 20:42
 */

namespace ExamenEducacionMedia;


use ExamenEducacionMedia\Classes\BaseRepository;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository
{

    public function getModel()
    {
        return new User();
    }

    public function searchAspriantes(Request $request, UserFilter $filters)
    {
        $users = $this->newQuery()
            ->with('aspirante')
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', [ 'supermario', 'cordinador', 'departamento',
                    'subsistema', 'plantel', 'invitado', ]);
            })
            ->filterBy($filters, $request->only([ 'search', 'curp' ]))
            ->paginate(50);

        $users->appends($request->only([ 'curp', 'search' ]));

        return $users;
    }
}
