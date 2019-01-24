<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 17:24
 */

namespace Aspirante\Http\Controllers\API;


use Aspirante\Http\Requests\UpdateAspirante;
use Aspirante\Traits\Utilities;
use ExamenEducacionMedia\Http\Controllers\Controller;

class UpdateAspiranteController extends Controller
{
    use Utilities;

    public function update(UpdateAspirante $request, $id)
    {
        $request->validated();

        $aspirante = $this->getAspiranteByUuid($id);

        $aspirante->update($request->input());

        return ok();
    }
}
