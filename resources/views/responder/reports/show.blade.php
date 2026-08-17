<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Respond to Report (রিপোর্টে সাড়া দিন)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Review verified incident details and update response progress.
                    <br>
                    যাচাইকৃত ঘটনার তথ্য দেখুন এবং সাড়া দেওয়ার অগ্রগতি আপডেট করুন।
                </p>
            </div>

            <a href="{{ route('responder.reports.index') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                Back to Reports (রিপোর্টে ফিরে যান)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1100px; margin:0 auto; padding:0 16px;">
            @if (session('success'))
                <div style="margin-bottom:24px; border:1px solid #bbf7d0; background:#f0fdf4; color:#15803d; padding:16px; border-radius:12px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="margin-bottom:24px; border:1px solid #fecaca; background:#fef2f2; color:#b91c1c; padding:16px; border-radius:12px;">
                    <strong>Please fix (ঠিক করুন):</strong>
                    <ul style="margin-top:8px; padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li style="font-size:14px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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

                $statusStyle = match($report->status) {
                    'verified' => 'background:#dcfce7;color:#15803d;',
                    'under_review' => 'background:#e0f2fe;color:#0369a1;',
                    'resolved' => 'background:#f3f4f6;color:#374151;',
                    default => 'background:#fef3c7;color:#b45309;',
                };

                $mapsUrl = 'https://www.google.com/maps?q=' . $report->latitude . ',' . $report->longitude;
            @endphp

            <div style="display:grid; grid-template-columns:1.2fr 0.8fr; gap:24px;">
                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <h3 style="font-size:18px; font-weight:800; color:#172033;">
                        Incident Information (ঘটনার তথ্য)
                    </h3>

                    <dl style="margin-top:20px; display:grid; gap:14px;">
                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Category (ধরন)</dt>
                            <dd style="margin-top:4px; color:#172033; font-weight:700;">
                                {{ \App\Support\BilingualLabel::category($report->category) }}
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Urgency (জরুরি)</dt>
                            <dd style="margin-top:4px; color:#172033;">
                                {{ \App\Support\BilingualLabel::urgency($report->urgency) }}
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Current Status (বর্তমান অবস্থা)</dt>
                            <dd style="margin-top:6px;">
                                <span style="{{ $statusStyle }} padding:6px 10px; border-radius:999px; font-size:12px; font-weight:800;">
                                    {{ \App\Support\BilingualLabel::reportStatus($report->status) }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Citizen (নাগরিক)</dt>
                            <dd style="margin-top:4px; color:#172033;">
                                {{ $report->user?->name ?? 'Unknown' }} — {{ $report->user?->email ?? 'N/A' }}
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Location (অবস্থান)</dt>
                            <dd style="margin-top:4px; color:#172033;">
                                {{ $report->latitude }}, {{ $report->longitude }}
                            </dd>
                        </div>

                        <div>
                            <a href="{{ $mapsUrl }}" target="_blank"
                               style="display:inline-block; background:#0F766E; color:white; padding:9px 13px; border-radius:8px; font-size:13px; font-weight:800; text-decoration:none;">
                                View Location on Map (মানচিত্রে অবস্থান দেখুন)
                            </a>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Description (বিবরণ)</dt>
                            <dd style="margin-top:4px; line-height:1.7; color:#172033;">
                                {{ $report->description }}
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Authority Note / Response Note (কর্তৃপক্ষ/রেসপন্ডার নোট)</dt>
                            <dd style="margin-top:4px; line-height:1.7; color:#172033;">
                                {{ $report->validation_note ?? 'No note added (কোনো নোট নেই)' }}
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Verified By (যিনি যাচাই করেছেন)</dt>
                            <dd style="margin-top:4px; color:#172033;">
                                {{ $report->validator?->name ?? 'N/A' }}
                            </dd>
                        </div>
                    </dl>

                    @if ($report->images->count())
                        <div style="margin-top:24px;">
                            <h4 style="font-size:15px; font-weight:800; color:#172033;">
                                Uploaded Images (আপলোড করা ছবি)
                            </h4>

                            <div style="margin-top:12px; display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:12px;">
                                @foreach ($report->images as $image)
                                    <a href="{{ asset('storage/' . $image->path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $image->path) }}"
                                             alt="Report image"
                                             style="width:100%; height:140px; object-fit:cover; border-radius:10px; border:1px solid #e5e7eb;">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div>
                    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="font-size:18px; font-weight:800; color:#172033;">
                            AI Prediction (AI পূর্বাভাস)
                        </h3>

                        <div style="margin-top:16px;">
                            <span style="{{ $predictionStyle }} padding:7px 12px; border-radius:999px; font-size:13px; font-weight:800;">
                                {{ \App\Support\BilingualLabel::riskLevel($predictionLabel) }}
                            </span>
                        </div>

                        @if ($prediction)
                            <dl style="margin-top:18px; display:grid; gap:12px;">
                                <div>
                                    <dt style="font-size:13px; font-weight:700; color:#64748b;">Confidence (আস্থা)</dt>
                                    <dd style="margin-top:4px; color:#172033;">{{ $prediction->confidence_score ?? 'N/A' }}</dd>
                                </div>

                                <div>
                                    <dt style="font-size:13px; font-weight:700; color:#64748b;">Model Version (মডেল ভার্সন)</dt>
                                    <dd style="margin-top:4px; color:#172033;">{{ $prediction->model_version }}</dd>
                                </div>
                            </dl>
                        @else
                            <p style="margin-top:14px; color:#64748b; font-size:14px;">
                                AI processing has not completed yet.
                                <br>
                                AI প্রক্রিয়া এখনও শেষ হয়নি।
                            </p>
                        @endif
                    </div>

                    <div style="margin-top:24px; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                        <h3 style="font-size:18px; font-weight:800; color:#172033;">
                            Response Action (সাড়া দেওয়ার কাজ)
                        </h3>

                        @if ($report->status === 'resolved')
                            <div style="margin-top:14px; background:#f3f4f6; color:#374151; padding:12px; border-radius:10px; font-weight:700;">
                                This report has been resolved.
                                <br>
                                এই রিপোর্টটি সমাধান করা হয়েছে।
                            </div>
                        @else
                            <form method="POST" action="{{ route('responder.reports.under-review', $report) }}" style="margin-top:16px;">
                                @csrf
                                @method('PATCH')

                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b;">
                                    Response Note (সাড়া দেওয়ার নোট)
                                </label>

                                <textarea name="response_note"
                                          rows="3"
                                          placeholder="Optional note before starting response..."
                                          style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">{{ old('response_note') }}</textarea>

                                <button type="submit"
                                        style="margin-top:12px; width:100%; background:#0369A1; color:white; border:none; padding:10px 16px; border-radius:8px; font-weight:800; cursor:pointer;">
                                    Mark Under Review (পর্যালোচনাধীন করুন)
                                </button>
                            </form>

                            <form method="POST" action="{{ route('responder.reports.resolved', $report) }}" style="margin-top:16px;">
                                @csrf
                                @method('PATCH')

                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b;">
                                    Resolution Note (সমাধান নোট)
                                </label>

                                <textarea name="response_note"
                                          rows="3"
                                          required
                                          placeholder="Required note for resolving this report..."
                                          style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">{{ old('response_note') }}</textarea>

                                <button type="submit"
                                        style="margin-top:12px; width:100%; background:#16A34A; color:white; border:none; padding:10px 16px; border-radius:8px; font-weight:800; cursor:pointer;">
                                    Mark Resolved (সমাধান হয়েছে)
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Responder Safety Notice (রেসপন্ডার নিরাপত্তা বার্তা):</strong>
                Field response should follow official emergency protocols.
                <br>
                মাঠ পর্যায়ে সাড়া দেওয়ার সময় সরকারি জরুরি প্রোটোকল অনুসরণ করা উচিত।
            </div>
        </div>
    </div>
</x-app-layout>