<?php

namespace Subsistema\Http\Controllers\API;

use Subsistema\Models\Plantel;
use ExamenEducacionMedia\Traits\ResponseTrait;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class ActivarPlantel extends Controller
{
    use ResponseTrait;

    public function update(Request $request, Plantel $plantel)
    {
        $plantel->update([
            'active' => $request->input('active'),
        ]);

        return $this->respondWithArray([ 'isValid' => true ]);
    }

    public function destroy(Request $request, Plantel $plantel)
    {
        $plantel->update([
            'active' => $request->input('active'),
        ]);

        return $this->respondWithArray([ 'isValid' => true ]);
    }
}
