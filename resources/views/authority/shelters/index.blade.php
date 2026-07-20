<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Shelter Management (আশ্রয়কেন্দ্র ব্যবস্থাপনা)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Manage shelters, capacity, occupancy, facilities, and availability status.
                    <br>
                    আশ্রয়কেন্দ্র, ধারণক্ষমতা, বর্তমান অবস্থানকারী, সুবিধা এবং অবস্থা পরিচালনা করুন।
                </p>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a href="{{ route('authority.dashboard') }}"
                   style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                    Authority Dashboard (কর্তৃপক্ষ ড্যাশবোর্ড)
                </a>

                <a href="{{ route('authority.shelters.create') }}"
                   style="display:inline-block; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                    Add Shelter (আশ্রয়কেন্দ্র যোগ করুন)
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
                @if ($shelters->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Shelter (আশ্রয়কেন্দ্র)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Capacity (ধারণক্ষমতা)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Available (খালি আসন)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Status (অবস্থা)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Facilities (সুবিধা)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Active (সক্রিয়)
                                    </th>

                                    <th style="padding:14px 20px; text-align:right; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Action (কাজ)
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
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
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 20px; font-size:14px; color:#172033;">
                                            <strong>{{ $shelter->name }}</strong>

                                            <div style="margin-top:4px; font-size:12px; color:#64748b; line-height:1.5;">
                                                {{ $shelter->address }}
                                            </div>

                                            <div style="margin-top:4px; font-size:12px; color:#64748b;">
                                                {{ $shelter->latitude }}, {{ $shelter->longitude }}
                                            </div>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; color:#172033;">
                                            <strong>{{ $shelter->capacity }}</strong>
                                            <div style="font-size:12px; color:#64748b;">
                                                Occupied (বর্তমান): {{ $shelter->current_occupancy }}
                                            </div>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; color:#172033;">
                                            <strong>{{ $availableCapacity }}</strong>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <span style="{{ $statusStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                {{ \App\Support\BilingualLabel::shelterStatus($statusValue) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; color:#475569; max-width:260px;">
                                            @if (count($facilities))
                                                <div style="display:flex; flex-wrap:wrap; gap:6px;">
                                                    @foreach ($facilities as $facility)
                                                        <span style="background:#f1f5f9; color:#334155; padding:4px 8px; border-radius:999px; font-size:12px; font-weight:600;">
                                                            {{ \App\Support\BilingualLabel::facility($facility) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span style="color:#94a3b8;">No facilities added (সুবিধা যোগ করা হয়নি)</span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            @if ($shelter->is_active)
                                                <span style="background:#dcfce7; color:#15803d; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                    Yes (হ্যাঁ)
                                                </span>
                                            @else
                                                <span style="background:#fee2e2; color:#b91c1c; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                    No (না)
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 20px; text-align:right;">
                                            <a href="{{ route('authority.shelters.edit', $shelter) }}"
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
                        {{ $shelters->links() }}
                    </div>
                @else
                    <div style="padding:40px 24px; text-align:center;">
                        <div style="width:48px; height:48px; margin:0 auto; display:flex; align-items:center; justify-content:center; border-radius:50%; background:#ccfbf1; color:#0F766E; font-size:20px; font-weight:800;">
                            S
                        </div>

                        <h3 style="margin-top:18px; font-size:20px; font-weight:800; color:#172033;">
                            No shelters added yet (এখনও কোনো আশ্রয়কেন্দ্র যোগ করা হয়নি)
                        </h3>

                        <p style="margin-top:8px; font-size:14px; color:#64748b;">
                            Add shelters so citizens can find safe locations during emergencies.
                            <br>
                            জরুরি অবস্থায় নাগরিকদের নিরাপদ স্থান খুঁজে পেতে আশ্রয়কেন্দ্র যোগ করুন।
                        </p>

                        <a href="{{ route('authority.shelters.create') }}"
                           style="display:inline-block; margin-top:22px; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                            Add First Shelter (প্রথম আশ্রয়কেন্দ্র যোগ করুন)
                        </a>
                    </div>
                @endif
            </div>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Demo Safety Notice (ডেমো নিরাপত্তা বার্তা):</strong>
                Shelter data in this system is for demonstration unless verified by authorized personnel.
                <br>
                এই সিস্টেমের আশ্রয়কেন্দ্রের তথ্য অনুমোদিত কর্তৃপক্ষ দ্বারা যাচাই না হওয়া পর্যন্ত ডেমো হিসেবে বিবেচিত হবে।
            </div>
        </div>
    </div>
</x-app-layout>