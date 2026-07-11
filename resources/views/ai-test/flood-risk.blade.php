<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrisisLens AI Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-[#172033]">
    <main class="mx-auto max-w-5xl px-4 py-10">
        <div class="mb-8 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-teal-700">CrisisLens AI Connection Test</p>
            <h1 class="mt-2 text-3xl font-bold">Flood Risk Prediction</h1>
            <p class="mt-3 text-slate-600">
                This page tests Laravel calling the separate FastAPI AI service.
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-bold">Input Sent From Laravel</h2>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-900 p-4 text-sm text-slate-100">{{ json_encode($payload, JSON_PRETTY_PRINT) }}</pre>
            </section>

            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-bold">AI Service Response</h2>

                @if ($result['success'])
                    @php
                        $data = $result['data'];
                        $risk = $data['prediction'] ?? 'Unknown';

                        $riskClasses = [
                            'Safe' => 'border-green-200 bg-green-50 text-green-700',
                            'Advisory' => 'border-amber-200 bg-amber-50 text-amber-700',
                            'Warning' => 'border-orange-200 bg-orange-50 text-orange-700',
                            'Critical' => 'border-red-200 bg-red-50 text-red-700',
                        ];

                        $class = $riskClasses[$risk] ?? 'border-slate-200 bg-slate-50 text-slate-700';
                    @endphp

                    <div class="mt-4 rounded-lg border p-4 {{ $class }}">
                        <p class="text-sm font-semibold">Prediction</p>
                        <p class="mt-1 text-2xl font-bold">{{ $risk }}</p>
                    </div>

                    <dl class="mt-5 space-y-3 text-sm">
                        <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                            <dt class="font-medium text-slate-600">Confidence</dt>
                            <dd class="font-semibold">{{ $data['confidence_score'] ?? 'N/A' }}</dd>
                        </div>

                        <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                            <dt class="font-medium text-slate-600">Model Version</dt>
                            <dd class="font-semibold">{{ $data['model_version'] ?? 'N/A' }}</dd>
                        </div>

                        <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                            <dt class="font-medium text-slate-600">Human Review</dt>
                            <dd class="font-semibold">{{ $data['human_review_status'] ?? 'N/A' }}</dd>
                        </div>

                        <div>
                            <dt class="font-medium text-slate-600">Disclaimer</dt>
                            <dd class="mt-1 text-slate-700">{{ $data['disclaimer'] ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                @else
                    <div class="mt-4 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
                        <p class="font-bold">Connection Failed</p>
                        <p class="mt-2 text-sm">{{ $result['message'] }}</p>
                    </div>

                    <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-900 p-4 text-sm text-slate-100">{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
                @endif
            </section>
        </div>

        <section class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-5 text-amber-800">
            <p class="font-semibold">Emergency Safety Notice</p>
            <p class="mt-1 text-sm">
                This is demonstration AI output. It must not be treated as real disaster information.
                Official emergency alerts require authorized human approval.
            </p>
        </section>
    </main>
</body>
</html>