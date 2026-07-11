<?php

namespace App\Http\Controllers;

use App\Services\Ai\AiInferenceService;
use Illuminate\View\View;

class AiTestController extends Controller
{
    public function floodRisk(AiInferenceService $ai): View
    {
        $payload = [
            'latitude' => 23.8103,
            'longitude' => 90.4125,
            'rainfall_mm' => 150,
            'river_level_m' => 5.5,
            'wind_speed_kmh' => 35,
            'input_data_source' => 'laravel_demo_test',
        ];

        $result = $ai->predictFloodRisk($payload);

        return view('ai-test.flood-risk', [
            'payload' => $payload,
            'result' => $result,
        ]);
    }
}
