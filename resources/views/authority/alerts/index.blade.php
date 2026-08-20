<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Manage Alerts (সতর্কতা পরিচালনা)
                </h2>

                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Search, filter, create, edit, and publish disaster alerts.
                    <br>
                    দুর্যোগ সতর্কতা সার্চ, ফিল্টার, তৈরি, সম্পাদনা এবং প্রকাশ করুন।
                </p>
            </div>

            <a href="{{ route('authority.alerts.create') }}"
               style="display:inline-block; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                Create Alert (সতর্কতা তৈরি)
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
                  action="{{ route('authority.alerts.index') }}"
                  style="margin-bottom:24px; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:20px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(210px, 1fr)); gap:14px; align-items:end;">
                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Search (সার্চ)
                        </label>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Title, message, publisher..."
                               style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Risk Level (ঝুঁকির মাত্রা)
                        </label>

                        <select name="risk_level"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Risk Levels</option>
                            <option value="Safe" @selected(request('risk_level') === 'Safe')>Safe (নিরাপদ)</option>
                            <option value="Advisory" @selected(request('risk_level') === 'Advisory')>Advisory (সতর্কতামূলক)</option>
                            <option value="Warning" @selected(request('risk_level') === 'Warning')>Warning (সতর্কতা)</option>
                            <option value="Critical" @selected(request('risk_level') === 'Critical')>Critical (গুরুতর ঝুঁকি)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Status (অবস্থা)
                        </label>

                        <select name="status"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Status</option>
                            <option value="draft" @selected(request('status') === 'draft')>Draft (খসড়া)</option>
                            <option value="published" @selected(request('status') === 'published')>Published (প্রকাশিত)</option>
                            <option value="expired" @selected(request('status') === 'expired')>Expired (মেয়াদ শেষ)</option>
                            <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled (বাতিল)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Approval (অনুমোদন)
                        </label>

                        <select name="approval"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Approval</option>
                            <option value="approved" @selected(request('approval') === 'approved')>Approved (অনুমোদিত)</option>
                            <option value="not_approved" @selected(request('approval') === 'not_approved')>Not Approved (অনুমোদিত নয়)</option>
                            <option value="requires_approval" @selected(request('approval') === 'requires_approval')>Requires Approval (অনুমোদন প্রয়োজন)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Created Date (তৈরির তারিখ)
                        </label>

                        <input type="date"
                               name="date"
                               value="{{ request('date') }}"
                               style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                    </div>
                </div>

                <div style="margin-top:16px; display:flex; justify-content:flex-end; gap:10px; flex-wrap:wrap;">
                    <a href="{{ route('authority.alerts.index') }}"
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
                    Showing {{ $alerts->count() }} of {{ $alerts->total() }} alerts
                    <br>
                    মোট {{ $alerts->total() }} সতর্কতার মধ্যে {{ $alerts->count() }} টি দেখানো হচ্ছে
                </p>

                @if (request()->hasAny(['search', 'risk_level', 'status', 'approval', 'date']))
                    <span style="background:#e0f2fe; color:#0369a1; padding:7px 12px; border-radius:999px; font-size:12px; font-weight:900;">
                        Filter Active (ফিল্টার চালু)
                    </span>
                @endif
            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; box-shadow:0 1px 3px rgba(15,23,42,0.08); overflow:hidden;">
                @if ($alerts->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Alert</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Risk</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Status</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Approval</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Publisher</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Dates</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($alerts as $alert)
                                    @php
                                        $riskStyle = match($alert->risk_level) {
                                            'Safe' => 'background:#dcfce7;color:#15803d;',
                                            'Advisory' => 'background:#fef3c7;color:#b45309;',
                                            'Warning' => 'background:#ffedd5;color:#c2410c;',
                                            'Critical' => 'background:#fee2e2;color:#b91c1c;',
                                            default => 'background:#f3f4f6;color:#374151;',
                                        };

                                        $statusStyle = match($alert->status) {
                                            'draft' => 'background:#f3f4f6;color:#374151;',
                                            'published' => 'background:#dcfce7;color:#15803d;',
                                            'expired' => 'background:#e0f2fe;color:#0369a1;',
                                            'cancelled' => 'background:#fee2e2;color:#b91c1c;',
                                            default => 'background:#f3f4f6;color:#374151;',
                                        };

                                        $approvalStyle = $alert->is_approved
                                            ? 'background:#dcfce7;color:#15803d;'
                                            : 'background:#fef3c7;color:#b45309;';

                                        $approvalLabel = $alert->is_approved
                                            ? 'Approved (অনুমোদিত)'
                                            : 'Not Approved (অনুমোদিত নয়)';
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 18px; font-size:14px; color:#172033; min-width:260px;">
                                            <strong>{{ $alert->title }}</strong>

                                            <p style="margin:6px 0 0; color:#64748b; font-size:13px; line-height:1.6;">
                                                {{ \Illuminate\Support\Str::limit($alert->message, 100) }}
                                            </p>

                                            @if ($alert->is_demo)
                                                <span style="display:inline-block; margin-top:8px; background:#e0f2fe; color:#0369a1; padding:4px 8px; border-radius:999px; font-size:11px; font-weight:900;">
                                                    Demo
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <span style="{{ $riskStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ \App\Support\BilingualLabel::alertRiskLevel($alert->risk_level) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <span style="{{ $statusStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ \App\Support\BilingualLabel::alertStatus($alert->status) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <span style="{{ $approvalStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ $approvalLabel }}
                                            </span>

                                            @if ($alert->requires_human_approval)
                                                <br>
                                                <span style="display:inline-block; margin-top:7px; background:#fee2e2; color:#b91c1c; padding:4px 8px; border-radius:999px; font-size:11px; font-weight:900;">
                                                    Human Approval Required
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569;">
                                            <strong style="color:#172033;">
                                                {{ $alert->publisher?->name ?? 'N/A' }}
                                            </strong>

                                            <br>

                                            <span style="font-size:12px; color:#64748b;">
                                                {{ $alert->publisher?->email ?? 'No email' }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569; min-width:190px;">
                                            <strong>Created:</strong>
                                            <br>
                                            {{ $alert->created_at->format('M d, Y h:i A') }}

                                            @if ($alert->published_at)
                                                <br><br>
                                                <strong>Published:</strong>
                                                <br>
                                                {{ $alert->published_at->format('M d, Y h:i A') }}
                                            @endif

                                            @if ($alert->expires_at)
                                                <br><br>
                                                <strong>Expires:</strong>
                                                <br>
                                                {{ $alert->expires_at->format('M d, Y h:i A') }}
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; white-space:nowrap;">
                                            <a href="{{ route('authority.alerts.edit', $alert) }}"
                                               style="display:inline-block; background:#0F766E; color:white; padding:8px 12px; border-radius:8px; font-size:13px; font-weight:800; text-decoration:none;">
                                                Edit (সম্পাদনা)
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="border-top:1px solid #e5e7eb; padding:16px 20px;">
                        {{ $alerts->links() }}
                    </div>
                @else
                    <div style="padding:42px 24px; text-align:center;">
                        <h3 style="font-size:20px; font-weight:900; color:#172033;">
                            No alerts found (কোনো সতর্কতা পাওয়া যায়নি)
                        </h3>

                        <p style="margin-top:8px; color:#64748b;">
                            Try changing or clearing the filter options.
                            <br>
                            ফিল্টার পরিবর্তন বা রিসেট করে আবার চেষ্টা করুন।
                        </p>

                        <div style="margin-top:22px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
                            <a href="{{ route('authority.alerts.index') }}"
                               style="display:inline-block; background:white; color:#172033; padding:11px 18px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                Clear Filters (ফিল্টার মুছুন)
                            </a>

                            <a href="{{ route('authority.alerts.create') }}"
                               style="display:inline-block; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                Create Alert (সতর্কতা তৈরি)
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>