<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IngestSensorRequest;
use App\Services\Sensor\SensorIngestionService;
use Illuminate\Http\JsonResponse;

class SensorApiController extends Controller
{
    protected $ingestionService;

    public function __construct(SensorIngestionService $ingestionService)
    {
        $this->ingestionService = $ingestionService;
    }

    /**
     * Ingest sensor data.
     *
     * @param IngestSensorRequest $request
     * @return JsonResponse
     */
    public function ingest(IngestSensorRequest $request): JsonResponse
    {
        $result = $this->ingestionService->ingest(
            $request->validated('sensor_key'),
            $request->validated('temperature')
        );

        return response()->json($result);
    }
}
