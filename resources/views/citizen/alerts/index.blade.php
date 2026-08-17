<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Public Alerts (জনসাধারণের সতর্কতা)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    View active disaster alerts and safety instructions.
                    <br>
                    সক্রিয় দুর্যোগ সতর্কতা এবং নিরাপত্তা নির্দেশনা দেখুন।
                </p>
            </div>

            <a href="{{ route('citizen.dashboard') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                Citizen Dashboard (নাগরিক ড্যাশবোর্ড)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1000px; margin:0 auto; padding:0 16px;">
            <div style="margin-bottom:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Demo Safety Notice (ডেমো নিরাপত্তা বার্তা):</strong>
                These alerts are demonstration data unless confirmed by official authority.
                <br>
                এই সতর্কতাগুলো সরকারি কর্তৃপক্ষ দ্বারা নিশ্চিত না হওয়া পর্যন্ত ডেমো তথ্য হিসেবে বিবেচিত হবে।
            </div>

            @if ($alerts->count())
                <div style="display:grid; gap:18px;">
                    @foreach ($alerts as $alert)
                        @php
                            $riskStyle = match($alert->risk_level) {
                                'Safe' => 'background:#dcfce7;color:#15803d;border-color:#bbf7d0;',
                                'Advisory' => 'background:#fef3c7;color:#b45309;border-color:#fde68a;',
                                'Warning' => 'background:#ffedd5;color:#c2410c;border-color:#fed7aa;',
                                'Critical' => 'background:#fee2e2;color:#b91c1c;border-color:#fecaca;',
                                default => 'background:#f3f4f6;color:#374151;border-color:#e5e7eb;',
                            };
                        @endphp

                        <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                            <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px; flex-wrap:wrap;">
                                <div>
                                    <h3 style="font-size:20px; font-weight:800; color:#172033;">
                                        {{ $alert->title }}
                                    </h3>

                                    <p style="margin-top:6px; font-size:13px; color:#64748b;">
                                        Published (প্রকাশিত):
                                        {{ $alert->published_at?->format('M d, Y h:i A') ?? 'N/A' }}
                                    </p>
                                </div>

                                <span style="{{ $riskStyle }} padding:7px 12px; border-radius:999px; font-size:13px; font-weight:800; border:1px solid;">
                                    {{ \App\Support\BilingualLabel::alertRiskLevel($alert->risk_level) }}
                                </span>
                            </div>

                            <div style="margin-top:16px; color:#172033; line-height:1.8; font-size:15px;">
                                {{ $alert->message }}
                            </div>

                            @if ($alert->expires_at)
                                <div style="margin-top:16px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:12px; font-size:13px; color:#475569;">
                                    Expires At (মেয়াদ শেষ):
                                    <strong>{{ $alert->expires_at->format('M d, Y h:i A') }}</strong>
                                </div>
                            @endif

                            <div style="margin-top:16px; font-size:12px; color:#94a3b8;">
                                Published by (প্রকাশ করেছেন): {{ $alert->publisher?->name ?? 'Authority' }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:24px; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:16px 20px;">
                    {{ $alerts->links() }}
                </div>
            @else
                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:40px 24px; text-align:center; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:48px; height:48px; margin:0 auto; display:flex; align-items:center; justify-content:center; border-radius:50%; background:#ccfbf1; color:#0F766E; font-size:20px; font-weight:800;">
                        !
                    </div>

                    <h3 style="margin-top:18px; font-size:20px; font-weight:800; color:#172033;">
                        No active alerts (কোনো সক্রিয় সতর্কতা নেই)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b;">
                        Published disaster alerts will appear here.
                        <br>
                        প্রকাশিত দুর্যোগ সতর্কতা এখানে দেখা যাবে।
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>