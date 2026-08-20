<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Report Details (রিপোর্ট বিস্তারিত)
                </h2>

                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Review citizen report, AI prediction, uploaded images, location, and validation timeline.
                    <br>
                    নাগরিক রিপোর্ট, AI পূর্বাভাস, ছবি, অবস্থান এবং যাচাই টাইমলাইন পর্যালোচনা করুন।
                </p>
            </div>

            <a href="{{ route('authority.reports.index') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                Back to Reports (রিপোর্ট তালিকায় ফিরুন)
            </a>
        </div>
    </x-slot>

    @php
        $prediction = $report->predictions->first();
        $predictionLabel = $prediction?->prediction ?? 'Processing';

        $urgencyStyle = match($report->urgency) {
            'low' => 'background:#f3f4f6;color:#374151;',
            'medium' => 'background:#e0f2fe;color:#0369a1;',
            'high' => 'background:#fef3c7;color:#b45309;',
            'critical' => 'background:#fee2e2;color:#b91c1c;',
            default => 'background:#f3f4f6;color:#374151;',
        };

        $statusStyle = match($report->status) {
            'pending' => 'background:#fef3c7;color:#b45309;',
            'verified' => 'background:#dcfce7;color:#15803d;',
            'rejected' => 'background:#fee2e2;color:#b91c1c;',
            'resolved' => 'background:#e0f2fe;color:#0369a1;',
            'under_review' => 'background:#dbeafe;color:#1d4ed8;',
            default => 'background:#f3f4f6;color:#374151;',
        };

        $predictionStyle = match($predictionLabel) {
            'Safe' => 'background:#dcfce7;color:#15803d;',
            'Advisory' => 'background:#fef3c7;color:#b45309;',
            'Warning' => 'background:#ffedd5;color:#c2410c;',
            'Critical' => 'background:#fee2e2;color:#b91c1c;',
            'Unavailable' => 'background:#f3f4f6;color:#374151;',
            default => 'background:#e0f2fe;color:#0369a1;',
        };
    @endphp

    <div style="padding:32px 0;">
        <div style="max-width:1250px; margin:0 auto; padding:0 16px;">

            @if (session('success'))
                <div style="margin-bottom:24px; border:1px solid #bbf7d0; background:#f0fdf4; color:#15803d; padding:16px; border-radius:12px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="display:grid; grid-template-columns:1.4fr 0.8fr; gap:22px; align-items:start;">

                <div style="display:grid; gap:22px;">

                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <div style="display:flex; justify-content:space-between; gap:16px; flex-wrap:wrap;">
                            <div>
                                <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">
                                    Report ID (রিপোর্ট আইডি)
                                </p>

                                <h1 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#172033;">
                                    #{{ $report->id }}
                                </h1>
                            </div>

                            <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:flex-start;">
                                <span style="{{ $statusStyle }} padding:7px 12px; border-radius:999px; font-size:13px; font-weight:900;">
                                    {{ \App\Support\BilingualLabel::reportStatus($report->status) }}
                                </span>

                                <span style="{{ $urgencyStyle }} padding:7px 12px; border-radius:999px; font-size:13px; font-weight:900;">
                                    {{ \App\Support\BilingualLabel::urgency($report->urgency) }}
                                </span>
                            </div>
                        </div>

                        <div style="margin-top:22px; display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:16px;">
                            <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:16px;">
                                <p style="margin:0; color:#64748b; font-size:13px; font-weight:800;">Category (ধরন)</p>
                                <p style="margin:8px 0 0; color:#172033; font-size:15px; font-weight:900;">
                                    {{ \App\Support\BilingualLabel::category($report->category) }}
                                </p>
                            </div>

                            <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:16px;">
                                <p style="margin:0; color:#64748b; font-size:13px; font-weight:800;">Submitted (জমা)</p>
                                <p style="margin:8px 0 0; color:#172033; font-size:15px; font-weight:900;">
                                    {{ $report->created_at->format('M d, Y h:i A') }}
                                </p>
                            </div>

                            <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:16px;">
                                <p style="margin:0; color:#64748b; font-size:13px; font-weight:800;">Images (ছবি)</p>
                                <p style="margin:8px 0 0; color:#172033; font-size:15px; font-weight:900;">
                                    {{ $report->images->count() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:20px; font-weight:900; color:#172033;">
                            Report Description (রিপোর্ট বিবরণ)
                        </h3>

                        <div style="margin-top:16px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:18px; line-height:1.8; color:#334155;">
                            {{ $report->description }}
                        </div>
                    </div>

                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:20px; font-weight:900; color:#172033;">
                            Location (অবস্থান)
                        </h3>

                        <div style="margin-top:16px; display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:16px;">
                            <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:16px;">
                                <p style="margin:0; color:#64748b; font-size:13px; font-weight:800;">Latitude</p>
                                <p style="margin:8px 0 0; color:#172033; font-size:15px; font-weight:900;">
                                    {{ $report->latitude }}
                                </p>
                            </div>

                            <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:16px;">
                                <p style="margin:0; color:#64748b; font-size:13px; font-weight:800;">Longitude</p>
                                <p style="margin:8px 0 0; color:#172033; font-size:15px; font-weight:900;">
                                    {{ $report->longitude }}
                                </p>
                            </div>
                        </div>

                        <a href="https://www.google.com/maps?q={{ $report->latitude }},{{ $report->longitude }}"
                           target="_blank"
                           style="display:inline-block; margin-top:18px; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                            Open in Google Maps (Google Maps-এ দেখুন)
                        </a>
                    </div>

                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:20px; font-weight:900; color:#172033;">
                            Uploaded Images (আপলোড করা ছবি)
                        </h3>

                        @if ($report->images->count())
                            <div style="margin-top:18px; display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px;">
                                @foreach ($report->images as $image)
                                    <a href="{{ \Illuminate\Support\Facades\Storage::url($image->path) }}"
                                       target="_blank"
                                       style="display:block; border:1px solid #e5e7eb; border-radius:14px; overflow:hidden; background:#f8fafc; text-decoration:none;">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image->path) }}"
                                             alt="Report Image"
                                             style="width:100%; height:160px; object-fit:cover; display:block;">

                                        <div style="padding:10px;">
                                            <p style="margin:0; font-size:12px; color:#64748b; word-break:break-word;">
                                                {{ $image->original_name }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p style="margin-top:14px; color:#64748b;">
                                No images uploaded with this report.
                                <br>
                                এই রিপোর্টে কোনো ছবি আপলোড করা হয়নি।
                            </p>
                        @endif
                    </div>
                </div>

                <div style="display:grid; gap:22px;">

                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:22px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:19px; font-weight:900; color:#172033;">
                            Citizen Info (নাগরিক তথ্য)
                        </h3>

                        <div style="margin-top:16px; line-height:1.8;">
                            <p style="margin:0; color:#172033; font-weight:900;">
                                {{ $report->user?->name ?? 'Unknown User' }}
                            </p>

                            <p style="margin:4px 0 0; color:#64748b; font-size:14px;">
                                {{ $report->user?->email ?? 'No email available' }}
                            </p>
                        </div>
                    </div>

                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:22px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:19px; font-weight:900; color:#172033;">
                            AI Prediction (AI পূর্বাভাস)
                        </h3>

                        <div style="margin-top:16px;">
                            <span style="{{ $predictionStyle }} padding:7px 12px; border-radius:999px; font-size:13px; font-weight:900;">
                                {{ \App\Support\BilingualLabel::riskLevel($predictionLabel) }}
                            </span>

                            @if ($prediction)
                                <div style="margin-top:16px; color:#475569; font-size:14px; line-height:1.8;">
                                    <p style="margin:0;">
                                        <strong>Confidence:</strong>
                                        {{ $prediction->confidence_score ?? 'N/A' }}
                                    </p>

                                    <p style="margin:4px 0 0;">
                                        <strong>Model:</strong>
                                        {{ $prediction->model_version ?? 'N/A' }}
                                    </p>

                                    <p style="margin:4px 0 0;">
                                        <strong>Review Status:</strong>
                                        {{ ucfirst(str_replace('_', ' ', $prediction->human_review_status ?? 'pending')) }}
                                    </p>

                                    <p style="margin:4px 0 0;">
                                        <strong>Processed:</strong>
                                        {{ $prediction->processing_timestamp?->format('M d, Y h:i A') ?? 'N/A' }}
                                    </p>
                                </div>
                            @else
                                <p style="margin-top:14px; color:#64748b; line-height:1.7;">
                                    AI prediction is still processing or unavailable.
                                    <br>
                                    AI পূর্বাভাস এখনও প্রক্রিয়াধীন বা উপলব্ধ নয়।
                                </p>
                            @endif
                        </div>
                    </div>

                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:22px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:19px; font-weight:900; color:#172033;">
                            Report Timeline (রিপোর্ট টাইমলাইন)
                        </h3>

                        <div style="margin-top:18px; display:grid; gap:14px;">
                            <div style="display:flex; gap:12px;">
                                <div style="width:14px; height:14px; border-radius:50%; background:#0F766E; margin-top:4px;"></div>
                                <div>
                                    <p style="margin:0; font-weight:900; color:#172033;">Report Submitted</p>
                                    <p style="margin:4px 0 0; color:#64748b; font-size:13px;">
                                        {{ $report->created_at->format('M d, Y h:i A') }}
                                    </p>
                                </div>
                            </div>

                            <div style="display:flex; gap:12px;">
                                <div style="width:14px; height:14px; border-radius:50%; background:{{ $prediction ? '#0F766E' : '#cbd5e1' }}; margin-top:4px;"></div>
                                <div>
                                    <p style="margin:0; font-weight:900; color:#172033;">AI Prediction Generated</p>
                                    <p style="margin:4px 0 0; color:#64748b; font-size:13px;">
                                        {{ $prediction?->created_at?->format('M d, Y h:i A') ?? 'Waiting for AI job' }}
                                    </p>
                                </div>
                            </div>

                            <div style="display:flex; gap:12px;">
                                <div style="width:14px; height:14px; border-radius:50%; background:{{ in_array($report->status, ['verified', 'rejected', 'under_review', 'resolved']) ? '#0F766E' : '#cbd5e1' }}; margin-top:4px;"></div>
                                <div>
                                    <p style="margin:0; font-weight:900; color:#172033;">Authority Review</p>
                                    <p style="margin:4px 0 0; color:#64748b; font-size:13px;">
                                        @if ($report->validated_at)
                                            {{ $report->validated_at->format('M d, Y h:i A') }}
                                            by {{ $report->validator?->name ?? 'Authority' }}
                                        @else
                                            Pending authority review
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div style="display:flex; gap:12px;">
                                <div style="width:14px; height:14px; border-radius:50%; background:{{ in_array($report->status, ['under_review', 'resolved']) ? '#0F766E' : '#cbd5e1' }}; margin-top:4px;"></div>
                                <div>
                                    <p style="margin:0; font-weight:900; color:#172033;">Responder Action</p>
                                    <p style="margin:4px 0 0; color:#64748b; font-size:13px;">
                                        @if ($report->status === 'under_review')
                                            Report is under responder review.
                                        @elseif ($report->status === 'resolved')
                                            Report has been resolved.
                                        @else
                                            Waiting for responder action.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:22px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="margin:0; font-size:19px; font-weight:900; color:#172033;">
                            Authority Decision (কর্তৃপক্ষ সিদ্ধান্ত)
                        </h3>

                        @if ($report->validation_note)
                            <div style="margin-top:14px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:14px; color:#475569; line-height:1.7;">
                                <strong>Previous Note:</strong>
                                <br>
                                {{ $report->validation_note }}
                            </div>
                        @endif

                        @if ($report->status === 'pending')
                            <form method="POST"
                                  action="{{ route('authority.reports.approve', $report) }}"
                                  style="margin-top:16px;">
                                @csrf
                                @method('PATCH')

                                <label style="display:block; font-size:14px; font-weight:800; color:#172033;">
                                    Approval Note (অনুমোদন নোট)
                                </label>

                                <textarea name="validation_note"
                                          rows="3"
                                          placeholder="Write approval note..."
                                          style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px; line-height:1.6;"></textarea>

                                <button type="submit"
                                        style="margin-top:10px; width:100%; border:none; background:#15803d; color:white; padding:11px 16px; border-radius:9px; font-size:14px; font-weight:900; cursor:pointer;">
                                    Approve Report (রিপোর্ট অনুমোদন)
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('authority.reports.reject', $report) }}"
                                  style="margin-top:16px;">
                                @csrf
                                @method('PATCH')

                                <label style="display:block; font-size:14px; font-weight:800; color:#172033;">
                                    Rejection Note (বাতিল নোট)
                                </label>

                                <textarea name="validation_note"
                                          rows="3"
                                          placeholder="Write rejection reason..."
                                          style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px; line-height:1.6;"></textarea>

                                <button type="submit"
                                        style="margin-top:10px; width:100%; border:none; background:#b91c1c; color:white; padding:11px 16px; border-radius:9px; font-size:14px; font-weight:900; cursor:pointer;">
                                    Reject Report (রিপোর্ট বাতিল)
                                </button>
                            </form>
                        @else
                            <div style="margin-top:16px; border:1px solid #e5e7eb; background:#f8fafc; color:#475569; padding:14px; border-radius:12px; line-height:1.7;">
                                This report already has authority decision or responder status.
                                <br>
                                এই রিপোর্টে ইতিমধ্যে কর্তৃপক্ষের সিদ্ধান্ত বা রেসপন্ডার অবস্থা রয়েছে।
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <style>
                @media (max-width: 950px) {
                    div[style*="grid-template-columns:1.4fr 0.8fr"] {
                        grid-template-columns: 1fr !important;
                    }
                }
            </style>
        </div>
    </div>
</x-app-layout>