<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Alert Management (সতর্কতা ব্যবস্থাপনা)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Create, publish, and manage public disaster alerts.
                    <br>
                    জনসাধারণের দুর্যোগ সতর্কতা তৈরি, প্রকাশ এবং পরিচালনা করুন।
                </p>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a href="{{ route('authority.dashboard') }}"
                   style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                    Authority Dashboard (কর্তৃপক্ষ ড্যাশবোর্ড)
                </a>

                <a href="{{ route('authority.alerts.create') }}"
                   style="display:inline-block; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                    Create Alert (সতর্কতা তৈরি করুন)
                </a>
            </div>
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
                @if ($alerts->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Alert (সতর্কতা)
                                    </th>
                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Risk Level (ঝুঁকির মাত্রা)
                                    </th>
                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Status (অবস্থা)
                                    </th>
                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Approval (অনুমোদন)
                                    </th>
                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Published (প্রকাশিত)
                                    </th>
                                    <th style="padding:14px 20px; text-align:right; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Action (কাজ)
                                    </th>
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
                                            'published' => 'background:#dcfce7;color:#15803d;',
                                            'draft' => 'background:#fef3c7;color:#b45309;',
                                            'cancelled' => 'background:#fee2e2;color:#b91c1c;',
                                            'expired' => 'background:#f3f4f6;color:#374151;',
                                            default => 'background:#e0f2fe;color:#0369a1;',
                                        };
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 20px; font-size:14px; color:#172033; max-width:420px;">
                                            <strong>{{ $alert->title }}</strong>
                                            <div style="margin-top:6px; font-size:13px; color:#64748b; line-height:1.6;">
                                                {{ \Illuminate\Support\Str::limit($alert->message, 120) }}
                                            </div>
                                            <div style="margin-top:6px; font-size:12px; color:#94a3b8;">
                                                Created by (তৈরি করেছেন): {{ $alert->publisher?->name ?? 'N/A' }}
                                            </div>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <span style="{{ $riskStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                {{ \App\Support\BilingualLabel::alertRiskLevel($alert->risk_level) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <span style="{{ $statusStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                {{ \App\Support\BilingualLabel::alertStatus($alert->status) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            @if ($alert->is_approved)
                                                <span style="background:#dcfce7; color:#15803d; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                    Approved (অনুমোদিত)
                                                </span>
                                            @else
                                                <span style="background:#fef3c7; color:#b45309; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                    Pending (অপেক্ষমাণ)
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; color:#475569;">
                                            @if ($alert->published_at)
                                                {{ $alert->published_at->format('M d, Y h:i A') }}
                                            @else
                                                Not published (প্রকাশিত নয়)
                                            @endif

                                            @if ($alert->expires_at)
                                                <div style="margin-top:4px; font-size:12px; color:#64748b;">
                                                    Expires (মেয়াদ): {{ $alert->expires_at->format('M d, Y h:i A') }}
                                                </div>
                                            @endif
                                        </td>

                                        <td style="padding:16px 20px; text-align:right;">
                                            <a href="{{ route('authority.alerts.edit', $alert) }}"
                                               style="display:inline-block; background:#0F766E; color:white; padding:8px 12px; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">
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
                    <div style="padding:40px 24px; text-align:center;">
                        <div style="width:48px; height:48px; margin:0 auto; display:flex; align-items:center; justify-content:center; border-radius:50%; background:#ccfbf1; color:#0F766E; font-size:20px; font-weight:800;">
                            !
                        </div>

                        <h3 style="margin-top:18px; font-size:20px; font-weight:800; color:#172033;">
                            No alerts created yet (এখনও কোনো সতর্কতা তৈরি হয়নি)
                        </h3>

                        <p style="margin-top:8px; font-size:14px; color:#64748b;">
                            Create alerts to notify citizens about disaster risk.
                            <br>
                            দুর্যোগ ঝুঁকি সম্পর্কে নাগরিকদের জানাতে সতর্কতা তৈরি করুন।
                        </p>

                        <a href="{{ route('authority.alerts.create') }}"
                           style="display:inline-block; margin-top:22px; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                            Create First Alert (প্রথম সতর্কতা তৈরি করুন)
                        </a>
                    </div>
                @endif
            </div>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Emergency Disclaimer (জরুরি সতর্কতা):</strong>
                Public alerts must be verified by authorized personnel before real emergency use.
                <br>
                বাস্তব জরুরি ব্যবহারের আগে জনসাধারণের সতর্কতা অনুমোদিত কর্তৃপক্ষ দ্বারা যাচাই করা আবশ্যক।
            </div>
        </div>
    </div>
</x-app-layout>