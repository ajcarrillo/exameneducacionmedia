<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-27
 * Time: 16:03
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Exports\PlantelUsersExport;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\UserRepository;
use Maatwebsite\Excel\Excel;

class DescargaUsuariosPlantelController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Excel $excel, PlantelUsersExport $export)
    {
        return $excel->download($export, 'usuarios_plantel.xlsx');
    }
}
