<?php


namespace Aspirante\Repositories;


use Aspirante\Models\RevisionRegistro;
use ExamenEducacionMedia\Classes\BaseRepository;

class RevisionRegistroRepository extends BaseRepository
{

    public function getModel()
    {
        return new RevisionRegistro();
    }

    public function revisiones()
    {
        return $this->newQuery();
    }

    public function pagadas()
    {
        $query = $this->revisiones()->where('efectuado', 1);

        return $query;
    }

    public function sinPago()
    {
        $query = $this->revisiones()->where('efectuado', 0);

        return $query;
    }

    public function montoTotal()
    {
        return $this->revisiones()->get()->sum(function ($revision) {
            return $revision->ficha_json['total'];
        });
    }

    public function montoPagadas()
    {
        return $this->pagadas()->get()->sum(function ($revision) {
            return $revision->ficha_json['total'];
        });
    }

    public function montoSinPago()
    {
        return $this->sinPago()->get()->sum(function ($revision) {
            return $revision->ficha_json['total'];
        });
    }

}
