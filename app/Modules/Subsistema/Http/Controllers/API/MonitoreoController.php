<?php


namespace Subsistema\Http\Controllers\API;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Repositories\PlantelRepository;

class MonitoreoController extends Controller
{
    /**
     * @var PlantelRepository
     */
    private $plantelRepository;

    public function __construct(PlantelRepository $plantelRepository)
    {
        $this->plantelRepository = $plantelRepository;
    }

    public function index()
    {
        $query = $this->plantelRepository->monitoreoPlanteles([ 'subsistema' => $this->getSubsistema()->id ])
            ->get();

        return $query;
    }

    protected function getSubsistema()
    {
        return \Auth::guard('api')->user()->subsistema;
    }
}
