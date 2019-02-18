<?php
/**
 * Created by PhpStorm.
 * User: Mini
 * Date: 31/01/2019
 * Time: 07:20 PM
 */

namespace MediaSuperior\Http\Controllers\Administracion;


use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use MediaSuperior\Models\Archivo;
use MediaSuperior\Models\ArchivoRoles;
use Spatie\Permission\Models\Role;


class CargaDocumentosController extends Controller
{
    public function index()
    {
        $documentos = DB::table('archivos_descargables', 'archivo_roles', 'roles')
            ->select('ad.id', 'ad.nombre as nombre', 'ad.descripcion as descripcion', 'r.name', DB::raw("group_concat(r.name) as roles"))
            ->from('archivo_roles as ar')
            ->join('archivos_descargables as ad', 'ar.archivo_id', '=', 'ad.id')
            ->join('roles as r', 'ar.role_id', '=', 'r.id')
            ->groupBy('ar.archivo_id')
            ->get();

        return view('media_superior.administracion.carga_documentos.index', compact('documentos'));
    }

    public function create()
    {
        $roles = Role::where('name', '<>', 'supermario')->get();

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
        $descripcion    = $request->input('descripcion');
        $path_archivo   = storage_path();                                        //PATH DEL DOCUMENTO
        $nombre_archivo = $archivo->getClientOriginalName();
        $exists         = Storage::disk('descargables')->exists($nombre_archivo);
        if ($exists) {
            flash('¡¡ Este documento ya se encuentra cargado ,verifique!!')->warning();

            return redirect()->back();
        }
        // NOMBRE DEL DOCUMENTO
        Storage::disk('descargables')->put($nombre_archivo, \File::get($archivo)); //GUARDADO
        $obj_archivo              = new Archivo();
        $obj_archivo->nombre      = $nombre_archivo;
        $obj_archivo->descripcion = $descripcion;
        $obj_archivo->path        = $path_archivo;
        $obj_archivo->usuario_id  = $user->id;
        $obj_archivo->save();
        foreach ($request->roles as $rol) {
            $archivo_roles = new ArchivoRoles([
                'archivo_id' => $obj_archivo->id,
                'role_id'    => $rol,
            ]);
            $archivo_roles->save();
        }
        flash('¡¡ El documento se ha guardado correctamente !!')->success();
        if ($request->exists('addanother')) {
            return redirect()->back();
        }

        return redirect()->to(route('media.administracion.carga-documentos.index'));
    }

    public function descargar(Request $request, $id_archivo)
    {
        $archivo = Archivo::find($id_archivo);

        return Storage::disk('descargables')->download($archivo->nombre);
    }

    public function eliminar(Request $request, Archivo $archivo)
    {
        ArchivoRoles::where('archivo_id', '=', $archivo->id)->delete();
        $archivo->delete();
        Storage::disk('descargables')->delete($archivo->nombre);
        flash('¡¡ El archivo se ha eliminado correctamente !!')->success();

        return redirect()->back();
    }
}