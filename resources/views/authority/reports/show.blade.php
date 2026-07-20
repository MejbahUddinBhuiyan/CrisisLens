<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Review Incident Report (ঘটনার রিপোর্ট পর্যালোচনা)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Validate citizen report and compare with AI prediction.
                    <br>
                    নাগরিক রিপোর্ট যাচাই করুন এবং AI পূর্বাভাসের সাথে তুলনা করুন।
                </p>
            </div>

            <a href="{{ route('authority.reports.index') }}"
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
            @endphp

            <div style="display:grid; grid-template-columns:1.2fr 0.8fr; gap:24px;">
                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <h3 style="font-size:18px; font-weight:800; color:#172033;">
                        Report Information (রিপোর্টের তথ্য)
                    </h3>

                    <dl style="margin-top:20px; display:grid; gap:14px;">
                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Citizen (নাগরিক)</dt>
                            <dd style="margin-top:4px; color:#172033;">
                                {{ $report->user?->name ?? 'Unknown' }} — {{ $report->user?->email ?? 'N/A' }}
                            </dd>
                        </div>

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
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Status (অবস্থা)</dt>
                            <dd style="margin-top:4px; color:#172033;">
                                {{ \App\Support\BilingualLabel::reportStatus($report->status) }}
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Location (অবস্থান)</dt>
                            <dd style="margin-top:4px; color:#172033;">
                                {{ $report->latitude }}, {{ $report->longitude }}
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Description (বিবরণ)</dt>
                            <dd style="margin-top:4px; line-height:1.7; color:#172033;">
                                {{ $report->description }}
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size:13px; font-weight:700; color:#64748b;">Submitted (জমা দেওয়া হয়েছে)</dt>
                            <dd style="margin-top:4px; color:#172033;">
                                {{ $report->created_at->format('M d, Y h:i A') }}
                            </dd>
                        </div>

                        @if ($report->validator)
                            <div>
                                <dt style="font-size:13px; font-weight:700; color:#64748b;">Reviewed By (যিনি পর্যালোচনা করেছেন)</dt>
                                <dd style="margin-top:4px; color:#172033;">
                                    {{ $report->validator->name }}
                                </dd>
                            </div>
                        @endif

                        @if ($report->validated_at)
                            <div>
                                <dt style="font-size:13px; font-weight:700; color:#64748b;">Reviewed At (পর্যালোচনার সময়)</dt>
                                <dd style="margin-top:4px; color:#172033;">
                                    {{ $report->validated_at->format('M d, Y h:i A') }}
                                </dd>
                            </div>
                        @endif

                        @if ($report->validation_note)
                            <div>
                                <dt style="font-size:13px; font-weight:700; color:#64748b;">Validation Note (যাচাই নোট)</dt>
                                <dd style="margin-top:4px; line-height:1.7; color:#172033;">
                                    {{ $report->validation_note }}
                                </dd>
                            </div>
                        @endif
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

                                <div>
                                    <dt style="font-size:13px; font-weight:700; color:#64748b;">Human Review (মানব পর্যালোচনা)</dt>
                                    <dd style="margin-top:4px; color:#172033;">
                                        {{ ucfirst(str_replace('_', ' ', $prediction->human_review_status)) }}
                                    </dd>
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
                            Authority Decision (কর্তৃপক্ষের সিদ্ধান্ত)
                        </h3>

                        @if ($report->status === 'verified')
                            <div style="margin-top:14px; background:#dcfce7; color:#15803d; padding:12px; border-radius:10px; font-weight:700;">
                                This report has been verified.
                                <br>
                                এই রিপোর্টটি যাচাই করা হয়েছে।
                            </div>
                        @elseif ($report->status === 'rejected')
                            <div style="margin-top:14px; background:#fee2e2; color:#b91c1c; padding:12px; border-radius:10px; font-weight:700;">
                                This report has been rejected.
                                <br>
                                এই রিপোর্টটি বাতিল করা হয়েছে।
                            </div>
                        @else
                            <form method="POST" action="{{ route('authority.reports.approve', $report) }}" style="margin-top:16px;">
                                @csrf
                                @method('PATCH')

                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b;">
                                    Approval Note (অনুমোদন নোট)
                                </label>

                                <textarea name="validation_note"
                                          rows="3"
                                          placeholder="Optional note for approving this report..."
                                          style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">{{ old('validation_note') }}</textarea>

                                <button type="submit"
                                        style="margin-top:12px; width:100%; background:#16A34A; color:white; border:none; padding:10px 16px; border-radius:8px; font-weight:800; cursor:pointer;">
                                    Approve & Verify (অনুমোদন ও যাচাই করুন)
                                </button>
                            </form>

                            <form method="POST" action="{{ route('authority.reports.reject', $report) }}" style="margin-top:16px;">
                                @csrf
                                @method('PATCH')

                                <label style="display:block; font-size:13px; font-weight:700; color:#64748b;">
                                    Rejection Note (বাতিলের কারণ)
                                </label>

                                <textarea name="validation_note"
                                          rows="3"
                                          required
                                          placeholder="Required note for rejecting this report..."
                                          style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">{{ old('validation_note') }}</textarea>

                                <button type="submit"
                                        style="margin-top:12px; width:100%; background:#DC2626; color:white; border:none; padding:10px 16px; border-radius:8px; font-weight:800; cursor:pointer;">
                                    Reject Report (রিপোর্ট বাতিল করুন)
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Emergency Disclaimer (জরুরি সতর্কতা):</strong>
                AI predictions are demonstration estimates. Public emergency alerts must be reviewed and approved by authorized personnel.
                <br>
                AI পূর্বাভাস ডেমো অনুমান মাত্র। জনসাধারণের জরুরি সতর্কতা অবশ্যই অনুমোদিত ব্যক্তির মাধ্যমে পর্যালোচনা ও অনুমোদন করতে হবে।
            </div>
        </div>
    </div>
</x-app-layout>