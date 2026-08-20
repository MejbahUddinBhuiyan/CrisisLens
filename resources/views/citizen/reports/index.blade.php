<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    My Incident Reports (আমার ঘটনার রিপোর্ট)
                </h2>

                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Search, filter, and track your submitted incident reports.
                    <br>
                    আপনার জমা দেওয়া ঘটনার রিপোর্ট সার্চ, ফিল্টার এবং ট্র্যাক করুন।
                </p>
            </div>

            <a href="{{ route('citizen.reports.create') }}"
               style="display:inline-block; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                Submit New Report (নতুন রিপোর্ট জমা দিন)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1250px; margin:0 auto; padding:0 16px;">

            @if (session('success'))
                <div style="margin-bottom:24px; border:1px solid #bbf7d0; background:#f0fdf4; color:#15803d; padding:16px; border-radius:12px;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET"
                  action="{{ route('citizen.reports.index') }}"
                  style="margin-bottom:24px; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:20px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(190px, 1fr)); gap:14px; align-items:end;">
                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Search (সার্চ)
                        </label>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Description, category, status..."
                               style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Category (ধরন)
                        </label>

                        <select name="category"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Categories</option>
                            <option value="flood" @selected(request('category') === 'flood')>Flood (বন্যা)</option>
                            <option value="cyclone" @selected(request('category') === 'cyclone')>Cyclone (ঘূর্ণিঝড়)</option>
                            <option value="road_blocked" @selected(request('category') === 'road_blocked')>Road Blocked (রাস্তা বন্ধ)</option>
                            <option value="building_damage" @selected(request('category') === 'building_damage')>Building Damage (ভবনের ক্ষতি)</option>
                            <option value="medical_emergency" @selected(request('category') === 'medical_emergency')>Medical Emergency (চিকিৎসা জরুরি)</option>
                            <option value="shelter_needed" @selected(request('category') === 'shelter_needed')>Shelter Needed (আশ্রয় প্রয়োজন)</option>
                            <option value="other" @selected(request('category') === 'other')>Other (অন্যান্য)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Urgency (জরুরি)
                        </label>

                        <select name="urgency"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Urgency</option>
                            <option value="low" @selected(request('urgency') === 'low')>Low (কম)</option>
                            <option value="medium" @selected(request('urgency') === 'medium')>Medium (মাঝারি)</option>
                            <option value="high" @selected(request('urgency') === 'high')>High (উচ্চ)</option>
                            <option value="critical" @selected(request('urgency') === 'critical')>Critical (গুরুতর)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Status (অবস্থা)
                        </label>

                        <select name="status"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Status</option>
                            <option value="pending" @selected(request('status') === 'pending')>Pending (অপেক্ষমাণ)</option>
                            <option value="verified" @selected(request('status') === 'verified')>Verified (যাচাই করা)</option>
                            <option value="under_review" @selected(request('status') === 'under_review')>Under Review (পর্যালোচনাধীন)</option>
                            <option value="resolved" @selected(request('status') === 'resolved')>Resolved (সমাধান)</option>
                            <option value="rejected" @selected(request('status') === 'rejected')>Rejected (বাতিল)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            AI Prediction (AI পূর্বাভাস)
                        </label>

                        <select name="ai_prediction"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All AI</option>
                            <option value="Safe" @selected(request('ai_prediction') === 'Safe')>Safe (নিরাপদ)</option>
                            <option value="Advisory" @selected(request('ai_prediction') === 'Advisory')>Advisory (সতর্কতামূলক)</option>
                            <option value="Warning" @selected(request('ai_prediction') === 'Warning')>Warning (সতর্কতা)</option>
                            <option value="Critical" @selected(request('ai_prediction') === 'Critical')>Critical (গুরুতর ঝুঁকি)</option>
                            <option value="Unavailable" @selected(request('ai_prediction') === 'Unavailable')>Unavailable (উপলব্ধ নয়)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Date (তারিখ)
                        </label>

                        <input type="date"
                               name="date"
                               value="{{ request('date') }}"
                               style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                    </div>
                </div>

                <div style="margin-top:16px; display:flex; justify-content:flex-end; gap:10px; flex-wrap:wrap;">
                    <a href="{{ route('citizen.reports.index') }}"
                       style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                        Reset (রিসেট)
                    </a>

                    <button type="submit"
                            style="border:none; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:800; cursor:pointer;">
                        Apply Filter (ফিল্টার করুন)
                    </button>
                </div>
            </form>

            <div style="margin-bottom:16px; display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
                <p style="margin:0; color:#64748b; font-size:14px;">
                    Showing {{ $reports->count() }} of {{ $reports->total() }} reports
                    <br>
                    মোট {{ $reports->total() }} রিপোর্টের মধ্যে {{ $reports->count() }} টি দেখানো হচ্ছে
                </p>

                @if (request()->hasAny(['search', 'category', 'urgency', 'status', 'ai_prediction', 'date']))
                    <span style="background:#e0f2fe; color:#0369a1; padding:7px 12px; border-radius:999px; font-size:12px; font-weight:900;">
                        Filter Active (ফিল্টার চালু)
                    </span>
                @endif
            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; box-shadow:0 1px 3px rgba(15,23,42,0.08); overflow:hidden;">
                @if ($reports->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Category (ধরন)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Urgency (জরুরি)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Status (অবস্থা)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        AI Prediction (AI পূর্বাভাস)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Location (অবস্থান)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Images (ছবি)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Submitted (জমা)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
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
                                            'pending' => 'background:#fef3c7;color:#b45309;',
                                            'verified' => 'background:#dcfce7;color:#15803d;',
                                            'rejected' => 'background:#fee2e2;color:#b91c1c;',
                                            'resolved' => 'background:#e0f2fe;color:#0369a1;',
                                            'under_review' => 'background:#dbeafe;color:#1d4ed8;',
                                            default => 'background:#f3f4f6;color:#374151;',
                                        };
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 20px; font-size:14px; font-weight:700; color:#172033;">
                                            {{ \App\Support\BilingualLabel::category($report->category) }}
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <span style="{{ $urgencyStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700; white-space:nowrap;">
                                                {{ \App\Support\BilingualLabel::urgency($report->urgency) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <span style="{{ $statusStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700; white-space:nowrap;">
                                                {{ \App\Support\BilingualLabel::reportStatus($report->status) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <div>
                                                <span style="{{ $predictionStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700; white-space:nowrap;">
                                                    {{ \App\Support\BilingualLabel::riskLevel($predictionLabel) }}
                                                </span>

                                                @if ($prediction)
                                                    <p style="margin-top:6px; font-size:12px; color:#64748b;">
                                                        Confidence (আস্থা): {{ $prediction->confidence_score ?? 'N/A' }}
                                                    </p>
                                                @else
                                                    <p style="margin-top:6px; font-size:12px; color:#64748b;">
                                                        Waiting for AI job (AI প্রক্রিয়ার জন্য অপেক্ষমাণ)
                                                    </p>
                                                @endif
                                            </div>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; color:#475569;">
                                            <div style="line-height:1.6;">
                                                {{ $report->latitude }}, {{ $report->longitude }}

                                                <br>

                                                <a href="https://www.google.com/maps?q={{ $report->latitude }},{{ $report->longitude }}"
                                                   target="_blank"
                                                   style="font-size:12px; color:#0F766E; font-weight:800; text-decoration:none;">
                                                    Map (মানচিত্র)
                                                </a>
                                            </div>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; color:#475569;">
                                            <span style="display:inline-block; background:#f1f5f9; color:#334155; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:800;">
                                                {{ $report->images_count ?? $report->images->count() }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; color:#475569; white-space:nowrap;">
                                            {{ $report->created_at->format('M d, Y h:i A') }}
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; white-space:nowrap;">
                                            <a href="{{ route('citizen.reports.show', $report) }}"
                                               style="display:inline-block; background:#0F766E; color:white; padding:8px 12px; border-radius:8px; font-size:13px; font-weight:800; text-decoration:none;">
                                                View Details (বিস্তারিত)
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
                        <div style="width:48px; height:48px; margin:0 auto; display:flex; align-items:center; justify-content:center; border-radius:50%; background:#ccfbf1; color:#0F766E; font-size:20px; font-weight:800;">
                            !
                        </div>

                        <h3 style="margin-top:18px; font-size:20px; font-weight:800; color:#172033;">
                            No reports found (কোনো রিপোর্ট পাওয়া যায়নি)
                        </h3>

                        <p style="margin-top:8px; font-size:14px; color:#64748b;">
                            Try changing or clearing your filter options.
                            <br>
                            ফিল্টার পরিবর্তন বা রিসেট করে আবার চেষ্টা করুন।
                        </p>

                        <div style="margin-top:22px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
                            <a href="{{ route('citizen.reports.index') }}"
                               style="display:inline-block; background:white; color:#172033; padding:11px 18px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                                Clear Filters (ফিল্টার মুছুন)
                            </a>

                            <a href="{{ route('citizen.reports.create') }}"
                               style="display:inline-block; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                                Submit New Report (নতুন রিপোর্ট জমা দিন)
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>