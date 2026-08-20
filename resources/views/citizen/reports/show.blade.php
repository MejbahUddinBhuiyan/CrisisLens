<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Report Details (রিপোর্ট বিস্তারিত)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    View submitted report, AI prediction, uploaded images, and map location.
                    <br>
                    জমা দেওয়া রিপোর্ট, AI পূর্বাভাস, ছবি এবং মানচিত্রে অবস্থান দেখুন।
                </p>
            </div>

            <a href="{{ route('citizen.reports.index') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                Back to My Reports (আমার রিপোর্টে ফিরুন)
            </a>
        </div>
    </x-slot>

    @php
        $latestPrediction = $report->predictions->first();
        $mapsUrl = 'https://www.google.com/maps?q=' . $report->latitude . ',' . $report->longitude;

        $statusStyle = match($report->status) {
            'pending' => 'background:#fef3c7;color:#b45309;',
            'verified' => 'background:#dcfce7;color:#15803d;',
            'rejected' => 'background:#fee2e2;color:#b91c1c;',
            'resolved' => 'background:#e0f2fe;color:#0369a1;',
            'under_review' => 'background:#dbeafe;color:#1d4ed8;',
            default => 'background:#f3f4f6;color:#374151;',
        };

        $urgencyStyle = match($report->urgency) {
            'critical' => 'background:#fee2e2;color:#b91c1c;',
            'high' => 'background:#ffedd5;color:#c2410c;',
            'medium' => 'background:#fef3c7;color:#b45309;',
            'low' => 'background:#dcfce7;color:#15803d;',
            default => 'background:#f3f4f6;color:#374151;',
        };

        $predictionStyle = match($latestPrediction?->prediction) {
            'Critical' => 'background:#fee2e2;color:#b91c1c;',
            'Warning' => 'background:#ffedd5;color:#c2410c;',
            'Advisory' => 'background:#fef3c7;color:#b45309;',
            'Safe' => 'background:#dcfce7;color:#15803d;',
            'Unavailable' => 'background:#f3f4f6;color:#374151;',
            default => 'background:#eff6ff;color:#1d4ed8;',
        };
    @endphp

    <div style="padding:32px 0;">
        <div style="max-width:1100px; margin:0 auto; padding:0 16px;">

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:16px; margin-bottom:24px;">
                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">
                        Report Status (রিপোর্ট অবস্থা)
                    </p>

                    <div style="margin-top:10px;">
                        <span style="{{ $statusStyle }} padding:7px 12px; border-radius:999px; font-size:13px; font-weight:900;">
                            {{ \App\Support\BilingualLabel::reportStatus($report->status) }}
                        </span>
                    </div>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">
                        Urgency (জরুরিতা)
                    </p>

                    <div style="margin-top:10px;">
                        <span style="{{ $urgencyStyle }} padding:7px 12px; border-radius:999px; font-size:13px; font-weight:900;">
                            {{ \App\Support\BilingualLabel::urgency($report->urgency) }}
                        </span>
                    </div>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">
                        Images (ছবি)
                    </p>

                    <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#172033;">
                        {{ $report->images->count() }}
                    </h3>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">
                        Submitted (জমা দেওয়া হয়েছে)
                    </p>

                    <h3 style="margin:8px 0 0; font-size:15px; font-weight:900; color:#172033;">
                        {{ $report->created_at->format('M d, Y h:i A') }}
                    </h3>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1.2fr 0.8fr; gap:24px;">
                <div>
                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:20px; font-weight:900; color:#172033;">
                            Incident Information (ঘটনার তথ্য)
                        </h3>

                        <div style="margin-top:18px; display:grid; gap:14px;">
                            <div>
                                <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">Category (ধরন)</p>
                                <p style="margin:6px 0 0; color:#172033; font-weight:800;">
                                    {{ \App\Support\BilingualLabel::category($report->category) }}
                                </p>
                            </div>

                            <div>
                                <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">Description (বিবরণ)</p>
                                <div style="margin-top:8px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:14px; color:#172033; line-height:1.8;">
                                    {{ $report->description }}
                                </div>
                            </div>

                            @if ($report->validation_note)
                                <div>
                                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">Authority/Responder Note (কর্তৃপক্ষ/রেসপন্ডার নোট)</p>
                                    <div style="margin-top:8px; background:#fffbeb; border:1px solid #fcd34d; border-radius:12px; padding:14px; color:#92400e; line-height:1.8;">
                                        {{ $report->validation_note }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div style="margin-top:24px; background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:20px; font-weight:900; color:#172033;">
                            Uploaded Images (আপলোড করা ছবি)
                        </h3>

                        @if ($report->images->count())
                            <div style="margin-top:18px; display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px;">
                                @foreach ($report->images as $image)
                                    <a href="{{ Storage::url($image->path) }}" target="_blank"
                                       style="display:block; border:1px solid #e5e7eb; border-radius:14px; overflow:hidden; background:#f8fafc; text-decoration:none;">
                                        <img src="{{ Storage::url($image->path) }}"
                                             alt="{{ $image->original_name }}"
                                             style="width:100%; height:180px; object-fit:cover; display:block;">

                                        <div style="padding:10px; color:#64748b; font-size:12px; font-weight:700;">
                                            {{ $image->original_name }}
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div style="margin-top:16px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:18px; color:#64748b;">
                                No images uploaded with this report.
                                <br>
                                এই রিপোর্টের সাথে কোনো ছবি আপলোড করা হয়নি।
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:20px; font-weight:900; color:#172033;">
                            AI Prediction (AI পূর্বাভাস)
                        </h3>

                        @if ($latestPrediction)
                            <div style="margin-top:16px;">
                                <span style="{{ $predictionStyle }} padding:8px 13px; border-radius:999px; font-size:13px; font-weight:900;">
                                    {{ \App\Support\BilingualLabel::riskLevel($latestPrediction->prediction) }}
                                </span>
                            </div>

                            <div style="margin-top:16px; display:grid; gap:12px;">
                                <div>
                                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">Confidence Score</p>
                                    <p style="margin:5px 0 0; font-size:22px; font-weight:900; color:#172033;">
                                        {{ $latestPrediction->confidence_score ?? 'N/A' }}
                                    </p>
                                </div>

                                <div>
                                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">Model Version</p>
                                    <p style="margin:5px 0 0; color:#172033; font-weight:800;">
                                        {{ $latestPrediction->model_version ?? 'N/A' }}
                                    </p>
                                </div>

                                <div>
                                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">Human Review Status</p>
                                    <p style="margin:5px 0 0; color:#172033; font-weight:800;">
                                        {{ ucfirst(str_replace('_', ' ', $latestPrediction->human_review_status ?? 'pending')) }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div style="margin-top:16px; background:#eff6ff; border:1px solid #bfdbfe; border-radius:12px; padding:14px; color:#1d4ed8; line-height:1.7;">
                                AI prediction is processing or not available yet.
                                <br>
                                AI পূর্বাভাস প্রক্রিয়াধীন অথবা এখনো পাওয়া যায়নি।
                            </div>
                        @endif
                    </div>

                    <div style="margin-top:24px; background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:20px; font-weight:900; color:#172033;">
                            Location (অবস্থান)
                        </h3>

                        <div style="margin-top:14px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:14px; color:#475569; line-height:1.8;">
                            Latitude: {{ $report->latitude }}
                            <br>
                            Longitude: {{ $report->longitude }}
                        </div>

                        <a href="{{ $mapsUrl }}" target="_blank"
                           style="display:inline-block; margin-top:16px; background:#0F766E; color:white; padding:10px 15px; border-radius:9px; font-size:14px; font-weight:800; text-decoration:none;">
                            Open in Google Maps (Google Maps-এ খুলুন)
                        </a>
                    </div>

                    <div style="margin-top:24px; border:1px solid #bfdbfe; background:#eff6ff; color:#1d4ed8; padding:16px; border-radius:12px; line-height:1.7;">
                        <strong>Tracking Note (ট্র্যাকিং নোট):</strong>
                        Your report status will update after authority review and responder action.
                        <br>
                        কর্তৃপক্ষ যাচাই এবং রেসপন্ডার কার্যক্রমের পর রিপোর্টের অবস্থা আপডেট হবে।
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 900px) {
            div[style*="grid-template-columns:1.2fr 0.8fr"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</x-app-layout>