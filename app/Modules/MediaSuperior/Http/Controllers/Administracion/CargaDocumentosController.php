<?php
/**
 * Created by PhpStorm.
 * User: Mini
 * Date: 31/01/2019
 * Time: 07:20 PM
 */

namespace MediaSuperior\Http\Controllers\Administracion;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MediaSuperior\Models\Archivo;
use MediaSuperior\Models\ArchivoRoles;
use Spatie\Permission\Models\Role;
use Storage;
use DB;

class CargaDocumentosController extends Controller
{
    public function index()
    {
        $documentos = DB::table('archivos_descargables', 'archivo_roles', 'roles')
            ->select('ad.id', 'ad.nombre as nombre', 'r.name', DB::raw("group_concat(r.name) as roles"))
            ->from('archivo_roles as ar')
            ->join('archivos_descargables as ad', 'ar.archivo_id', '=', 'ad.id')
            ->join('roles as r', 'ar.role_id', '=', 'r.id')
            ->groupBy('ar.archivo_id')
            ->get();

        return view('media_superior.administracion.carga_documentos.index', compact('documentos'));
    }

    public function create()
    {
        $roles = Role::get();

        return view('media_superior.administracion.carga_documentos.create', compact('roles'));
    }

    public function store(Request $request)
    {

        if (empty($request->roles)) {
            flash('¡¡ Seleccione al menos un rol !!')->warning();

            return redirect()->back();
        }
        $user           = Auth::user();
        $archivo        = $request->file('pdf');
        $path_archivo   = storage_path();                                        //PATH DEL DOCUMENTO
        $nombre_archivo = $archivo->getClientOriginalName();
        $exists         = Storage::disk('local')->exists($nombre_archivo);
        if ($exists) {
            flash('¡¡ Este documento ya se encuentra cargado ,verifique!!')->warning();

            return redirect()->back();
        }
        // NOMBRE DEL DOCUMENTO
        Storage::disk('local')->put($nombre_archivo, \File::get($archivo)); //GUARDADO
        $obj_archivo             = new Archivo();
        $obj_archivo->nombre     = $nombre_archivo;
        $obj_archivo->path       = $path_archivo;
        $obj_archivo->usuario_id = $user->id;
        $obj_archivo->save();
        foreach ($request->roles as $rol) {
            $archivo_roles = new ArchivoRoles([
                'archivo_id' => $obj_archivo->id,
                'role_id'    => $rol,
            ]);
            $archivo_roles->save();
        }
        flash('¡¡ El documento se ha guardado correctamente !!')->success();

        return redirect()->back();
    }

    public function descargar(Request $request, $id_archivo)
    {
        $archivo = Archivo::find($id_archivo);

        return Storage::disk('local')->download($archivo->nombre);
    }

    public function eliminar(Request $request, Archivo $archivo)
    {
        ArchivoRoles::where('archivo_id', '=', $archivo->id)->delete();
        $archivo->delete();
        Storage::disk('local')->delete($archivo->nombre);
        flash('!! El archivo se ha eliminado correctamente ¡¡')->success();

        return redirect()->back();
    }
}