<?php

namespace ExamenEducacionMedia\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use MediaSuperior\Models\Archivo;
use MediaSuperior\Models\ArchivoRoles;
use Spatie\Permission\Models\Role;

class CentroDescargaController extends Controller
{
    public function index()
    {

        $user       = Auth::user();
        $role       = $user->roles->pluck('id')->first();
        $documentos = ArchivoRoles::with('archivo')->where('role_id', $role)->get();
        $name_role  = Role::find($role);

        return view('centro_de_descargas.centro_descarga', compact('documentos', 'name_role'));
    }

    public function descargar($id_archivo)
    {
        $archivo = Archivo::find($id_archivo);

        return Storage::disk('descargables')->download($archivo->nombre);
    }

}
