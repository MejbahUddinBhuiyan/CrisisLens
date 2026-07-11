<?php

namespace App\Jobs;

use App\Models\Report;
use App\Services\Ai\AiInferenceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessReportFloodRiskPrediction implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Report $report
    ) {
        //
    }

    public function handle(AiInferenceService $ai): void
    {
        $payload = [
            'latitude' => (float) $this->report->latitude,
            'longitude' => (float) $this->report->longitude,
            'rainfall_mm' => $this->estimateRainfallFromUrgency($this->report->urgency),
            'river_level_m' => $this->estimateRiverLevelFromUrgency($this->report->urgency),
            'wind_speed_kmh' => $this->estimateWindSpeedFromCategory($this->report->category),
            'input_data_source' => 'citizen_report_demo_data',
        ];

        $result = $ai->predictFloodRisk($payload);

        if (! $result['success']) {
            $this->report->predictions()->create([
                'prediction_type' => 'flood_risk',
                'prediction' => 'Unavailable',
                'confidence_score' => null,
                'model_version' => 'unavailable',
                'processing_timestamp' => now(),
                'input_data_source' => 'citizen_report_demo_data',
                'input_payload' => $payload,
                'raw_response' => $result,
                'human_review_status' => 'needs_review',
                'is_demo' => true,
            ]);

            return;
        }

        $data = $result['data'];

        $this->report->predictions()->create([
            'prediction_type' => 'flood_risk',
            'prediction' => $data['prediction'] ?? 'Unavailable',
            'confidence_score' => $data['confidence_score'] ?? null,
            'model_version' => $data['model_version'] ?? 'unknown',
            'processing_timestamp' => $data['processing_timestamp'] ?? now(),
            'input_data_source' => $data['input_data_source'] ?? 'citizen_report_demo_data',
            'input_payload' => $payload,
            'raw_response' => $data,
            'human_review_status' => $data['human_review_status'] ?? 'pending',
            'is_demo' => true,
        ]);
    }

    private function estimateRainfallFromUrgency(string $urgency): float
    {
        return match ($urgency) {
            'critical' => 230,
            'high' => 150,
            'medium' => 70,
            default => 20,
        };
    }

    private function estimateRiverLevelFromUrgency(string $urgency): float
    {
        return match ($urgency) {
            'critical' => 7.5,
            'high' => 5.5,
            'medium' => 3.2,
            default => 1.4,
        };
    }

    private function estimateWindSpeedFromCategory(string $category): float
    {
        return match ($category) {
            'cyclone' => 95,
            'flood' => 35,
            'road_blocked' => 25,
            'building_damage' => 45,
            default => 20,
        };
    }
}