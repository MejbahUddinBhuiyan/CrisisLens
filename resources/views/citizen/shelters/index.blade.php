<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Shelter Directory (আশ্রয়কেন্দ্র তালিকা)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Find nearby active shelters, available capacity, contact details, and facilities.
                    <br>
                    কাছাকাছি সক্রিয় আশ্রয়কেন্দ্র, খালি আসন, যোগাযোগ এবং সুবিধাসমূহ দেখুন।
                </p>
            </div>

            <a href="{{ route('citizen.dashboard') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                Citizen Dashboard (নাগরিক ড্যাশবোর্ড)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 16px;">

            <div style="margin-bottom:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Demo Safety Notice (ডেমো নিরাপত্তা বার্তা):</strong>
                Shelter information shown here is demonstration data unless verified by authorized personnel.
                <br>
                এখানে দেখানো আশ্রয়কেন্দ্রের তথ্য অনুমোদিত কর্তৃপক্ষ দ্বারা যাচাই না হওয়া পর্যন্ত ডেমো তথ্য হিসেবে বিবেচিত হবে।
            </div>

            @if ($shelters->count())
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:20px;">
                    @foreach ($shelters as $shelter)
                        @php
                            $latestStatus = $shelter->statuses->first();
                            $statusValue = $latestStatus?->status ?? 'available';

                            $statusStyle = match($statusValue) {
                                'available' => 'background:#dcfce7;color:#15803d;',
                                'limited' => 'background:#fef3c7;color:#b45309;',
                                'full' => 'background:#fee2e2;color:#b91c1c;',
                                'closed' => 'background:#f3f4f6;color:#374151;',
                                default => 'background:#e0f2fe;color:#0369a1;',
                            };

                            $availableCapacity = max(0, $shelter->capacity - $shelter->current_occupancy);
                            $facilities = $shelter->facilities ?? [];

                            $mapsUrl = 'https://www.google.com/maps?q=' . $shelter->latitude . ',' . $shelter->longitude;
                        @endphp

                        <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                            <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px;">
                                <div>
                                    <h3 style="font-size:18px; font-weight:800; color:#172033;">
                                        {{ $shelter->name }}
                                    </h3>

                                    <p style="margin-top:6px; font-size:14px; line-height:1.6; color:#64748b;">
                                        {{ $shelter->address }}
                                    </p>
                                </div>

                                <span style="{{ $statusStyle }} padding:6px 10px; border-radius:999px; font-size:12px; font-weight:800; white-space:nowrap;">
                                    {{ \App\Support\BilingualLabel::shelterStatus($statusValue) }}
                                </span>
                            </div>

                            <div style="margin-top:18px; display:grid; grid-template-columns:repeat(3, 1fr); gap:10px;">
                                <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:12px;">
                                    <div style="font-size:12px; color:#64748b; font-weight:700;">
                                        Capacity (ধারণক্ষমতা)
                                    </div>
                                    <div style="margin-top:4px; font-size:18px; font-weight:800; color:#172033;">
                                        {{ $shelter->capacity }}
                                    </div>
                                </div>

                                <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:12px;">
                                    <div style="font-size:12px; color:#64748b; font-weight:700;">
                                        Occupied (বর্তমান)
                                    </div>
                                    <div style="margin-top:4px; font-size:18px; font-weight:800; color:#172033;">
                                        {{ $shelter->current_occupancy }}
                                    </div>
                                </div>

                                <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:12px;">
                                    <div style="font-size:12px; color:#64748b; font-weight:700;">
                                        Available (খালি)
                                    </div>
                                    <div style="margin-top:4px; font-size:18px; font-weight:800; color:#0F766E;">
                                        {{ $availableCapacity }}
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top:18px;">
                                <h4 style="font-size:14px; font-weight:800; color:#172033;">
                                    Contact Information (যোগাযোগের তথ্য)
                                </h4>

                                <div style="margin-top:8px; font-size:14px; color:#475569; line-height:1.7;">
                                    @if ($shelter->contact_phone)
                                        <div>
                                            Phone (ফোন): {{ $shelter->contact_phone }}
                                        </div>
                                    @endif

                                    @if ($shelter->contact_email)
                                        <div>
                                            Email (ইমেইল): {{ $shelter->contact_email }}
                                        </div>
                                    @endif

                                    @if (! $shelter->contact_phone && ! $shelter->contact_email)
                                        <div style="color:#94a3b8;">
                                            No contact added (যোগাযোগের তথ্য নেই)
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div style="margin-top:18px;">
                                <h4 style="font-size:14px; font-weight:800; color:#172033;">
                                    Facilities (সুবিধাসমূহ)
                                </h4>

                                @if (count($facilities))
                                    <div style="margin-top:10px; display:flex; flex-wrap:wrap; gap:8px;">
                                        @foreach ($facilities as $facility)
                                            <span style="background:#f1f5f9; color:#334155; padding:5px 9px; border-radius:999px; font-size:12px; font-weight:700;">
                                                {{ \App\Support\BilingualLabel::facility($facility) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p style="margin-top:8px; font-size:14px; color:#94a3b8;">
                                        No facilities listed (কোনো সুবিধা তালিকাভুক্ত নেই)
                                    </p>
                                @endif
                            </div>

                            <div style="margin-top:18px; display:flex; gap:10px; flex-wrap:wrap;">
                                <a href="{{ $mapsUrl }}"
                                   target="_blank"
                                   style="display:inline-block; background:#0F766E; color:white; padding:10px 14px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                    View on Map (মানচিত্রে দেখুন)
                                </a>

                                @if ($shelter->contact_phone)
                                    <a href="tel:{{ $shelter->contact_phone }}"
                                       style="display:inline-block; background:white; color:#172033; border:1px solid #cbd5e1; padding:10px 14px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                        Call (কল করুন)
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:24px; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:16px 20px;">
                    {{ $shelters->links() }}
                </div>
            @else
                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:40px 24px; text-align:center; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:48px; height:48px; margin:0 auto; display:flex; align-items:center; justify-content:center; border-radius:50%; background:#ccfbf1; color:#0F766E; font-size:20px; font-weight:800;">
                        S
                    </div>

                    <h3 style="margin-top:18px; font-size:20px; font-weight:800; color:#172033;">
                        No active shelters available (সক্রিয় আশ্রয়কেন্দ্র নেই)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b;">
                        Active shelters will appear here when authority adds them.
                        <br>
                        কর্তৃপক্ষ সক্রিয় আশ্রয়কেন্দ্র যোগ করলে এখানে দেখা যাবে।
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>