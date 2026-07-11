<?php

namespace App\Services\Ai;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class AiInferenceService
{
    public function predictFloodRisk(array $payload): array
    {
        try {
            $response = Http::timeout(10)
                ->acceptJson()
                ->asJson()
                ->post(config('services.ai.url') . '/api/v1/predict/flood-risk', $payload);

            if ($response->failed()) {
                return [
                    'success' => false,
                    'message' => 'AI service returned an error.',
                    'status' => $response->status(),
                    'data' => $response->json(),
                ];
            }

            return [
                'success' => true,
                'message' => 'Flood risk prediction completed.',
                'data' => $response->json(),
            ];
        } catch (ConnectionException $exception) {
            return [
                'success' => false,
                'message' => 'Could not connect to the AI service. Make sure FastAPI is running on port 8001.',
                'error' => $exception->getMessage(),
            ];
        }
    }
}