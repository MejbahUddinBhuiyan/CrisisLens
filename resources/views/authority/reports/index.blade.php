<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Authority Report Review (কর্তৃপক্ষের রিপোর্ট পর্যালোচনা)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Review citizen reports, AI predictions, and validation status.
                    <br>
                    নাগরিক রিপোর্ট, AI পূর্বাভাস এবং যাচাই অবস্থা পর্যালোচনা করুন।
                </p>
            </div>

            <a href="{{ route('authority.dashboard') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                Authority Dashboard (কর্তৃপক্ষ ড্যাশবোর্ড)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 16px;">
            @if (session('success'))
                <div style="margin-bottom:24px; border:1px solid #bbf7d0; background:#f0fdf4; color:#15803d; padding:16px; border-radius:12px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; box-shadow:0 1px 3px rgba(15,23,42,0.08); overflow:hidden;">
                @if ($reports->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Citizen (নাগরিক)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Category (ধরন)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Urgency (জরুরি)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        AI Prediction (AI পূর্বাভাস)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Status (অবস্থা)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Submitted (জমা)
                                    </th>

                                    <th style="padding:14px 20px; text-align:right; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Action (কাজ)
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($reports as $report)
                                    @php
                                        $prediction = $report->predictions->first();
                                        $predictionLabel = $prediction?->prediction ?? 'Processing';

                                        $predictionStyle = match($predictionLabel) {
                                            'Safe' => 'background:#dcfce7;color:#15803d;',
                                            'Advisory' => 'background:#fef3c7;color:#b45309;',
                                            'Warning' => 'background:#ffedd5;color:#c2410c;',
                                            'Critical' => 'background:#fee2e2;color:#b91c1c;',
                                            'Unavailable' => 'background:#f3f4f6;color:#374151;',
                                            default => 'background:#e0f2fe;color:#0369a1;',
                                        };

                                        $urgencyStyle = match($report->urgency) {
                                            'low' => 'background:#f3f4f6;color:#374151;',
                                            'medium' => 'background:#e0f2fe;color:#0369a1;',
                                            'high' => 'background:#fef3c7;color:#b45309;',
                                            'critical' => 'background:#fee2e2;color:#b91c1c;',
                                            default => 'background:#f3f4f6;color:#374151;',
                                        };

                                        $statusStyle = match($report->status) {
                                            'verified' => 'background:#dcfce7;color:#15803d;',
                                            'rejected' => 'background:#fee2e2;color:#b91c1c;',
                                            default => 'background:#fef3c7;color:#b45309;',
                                        };
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 20px; font-size:14px; color:#172033;">
                                            <strong>{{ $report->user?->name ?? 'Unknown' }}</strong>
                                            <div style="font-size:12px; color:#64748b;">
                                                {{ $report->user?->email ?? 'N/A' }}
                                            </div>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; font-weight:700; color:#172033;">
                                            {{ \App\Support\BilingualLabel::category($report->category) }}
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <span style="{{ $urgencyStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                {{ \App\Support\BilingualLabel::urgency($report->urgency) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <span style="{{ $predictionStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                {{ \App\Support\BilingualLabel::riskLevel($predictionLabel) }}
                                            </span>

                                            @if ($prediction)
                                                <div style="margin-top:6px; font-size:12px; color:#64748b;">
                                                    Confidence (আস্থা): {{ $prediction->confidence_score ?? 'N/A' }}
                                                </div>
                                            @else
                                                <div style="margin-top:6px; font-size:12px; color:#64748b;">
                                                    Waiting for AI job (AI প্রক্রিয়ার জন্য অপেক্ষমাণ)
                                                </div>
                                            @endif
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <span style="{{ $statusStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                {{ \App\Support\BilingualLabel::reportStatus($report->status) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; color:#475569;">
                                            {{ $report->created_at->format('M d, Y h:i A') }}
                                        </td>

                                        <td style="padding:16px 20px; text-align:right;">
                                            <a href="{{ route('authority.reports.show', $report) }}"
                                               style="display:inline-block; background:#0F766E; color:white; padding:8px 12px; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">
                                                Review (পর্যালোচনা)
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="border-top:1px solid #e5e7eb; padding:16px 20px;">
                        {{ $reports->links() }}
                    </div>
                @else
                    <div style="padding:40px 24px; text-align:center;">
                        <h3 style="font-size:20px; font-weight:800; color:#172033;">
                            No reports available (কোনো রিপোর্ট নেই)
                        </h3>

                        <p style="margin-top:8px; font-size:14px; color:#64748b;">
                            Citizen reports will appear here after submission.
                            <br>
                            নাগরিক রিপোর্ট জমা দেওয়ার পর এখানে দেখা যাবে।
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>