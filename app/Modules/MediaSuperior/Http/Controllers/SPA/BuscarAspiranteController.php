<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-24
 * Time: 20:54
 */

namespace MediaSuperior\Http\Controllers\SPA;


use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\UserFilter;
use ExamenEducacionMedia\UserRepository;
use Illuminate\Http\Request;

class BuscarAspiranteController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function index(Request $request, UserFilter $filters)
    {
        $users = $this->userRepository->searchAspriantes($request, $filters);

        return ok(compact('users'));
    }
}
