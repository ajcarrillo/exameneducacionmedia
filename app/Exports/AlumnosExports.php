<?php
/**
 * Created by PhpStorm.
 * User: geremias
 * Date: 21/02/19
 * Time: 10:09 AM
 */

namespace ExamenEducacionMedia\Exports;

use Aspirante\Models\Aspirante;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumnosExports implements FromCollection, WithHeadings
{
    protected $formato;

    public function __construct($formato)
    {
        $this->formato = $formato;
    }

    public function collection()
    {
        switch ($this->formato) {
            case 'listado-primera-opcion-secundaria' :
                return Aspirante::dataForAspirantes1erOp();
                break;
            default:
                return [];
        }
    }

    public function headings(): array
    {
        $columns = [];

        switch ($this->formato) {
            case 'listado-primera-opcion-secundaria':
                $columns = [
                    'folio',
                    'nombre_completo',
                    'plantel',
                    'especialidad',
                    'subsistema',
                    'secundaria',
                    'modalidad',
                    'tiene_pago',
                    'concluyo_registro',
                ];
                break;
        }

        return $columns;
    }
}