<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Audit Logs (অডিট লগ)
                </h2>

                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Track important actions performed by users, authorities, responders, and administrators.
                    <br>
                    ব্যবহারকারী, কর্তৃপক্ষ, রেসপন্ডার এবং অ্যাডমিনের গুরুত্বপূর্ণ কার্যক্রম দেখুন।
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                Back to Admin Dashboard (অ্যাডমিন ড্যাশবোর্ডে ফিরুন)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1250px; margin:0 auto; padding:0 16px;">

            <div style="margin-bottom:24px; border:1px solid #bfdbfe; background:#eff6ff; color:#1d4ed8; padding:16px; border-radius:12px; line-height:1.7;">
                <strong>Audit Notice (অডিট নোট):</strong>
                This page helps the Super Administrator monitor system actions for accountability and security.
                <br>
                এই পেজটি Super Administrator-কে নিরাপত্তা ও দায়বদ্ধতার জন্য সিস্টেম কার্যক্রম পর্যবেক্ষণে সাহায্য করে।
            </div>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:16px; margin-bottom:24px;">
                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">
                        Total Logs Shown (দেখানো মোট লগ)
                    </p>

                    <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#172033;">
                        {{ $activities->count() }}
                    </h3>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">
                        Page (পৃষ্ঠা)
                    </p>

                    <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#0F766E;">
                        {{ $activities->currentPage() }}
                    </h3>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; color:#64748b; font-weight:800;">
                        Total Records (মোট রেকর্ড)
                    </p>

                    <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#dc2626;">
                        {{ $activities->total() }}
                    </h3>
                </div>
            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; box-shadow:0 1px 3px rgba(15,23,42,0.08); overflow:hidden;">
                @if ($activities->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; font-weight:800; color:#64748b; text-transform:uppercase;">
                                        Time (সময়)
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; font-weight:800; color:#64748b; text-transform:uppercase;">
                                        User (ব্যবহারকারী)
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; font-weight:800; color:#64748b; text-transform:uppercase;">
                                        Action (কাজ)
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; font-weight:800; color:#64748b; text-transform:uppercase;">
                                        Target (টার্গেট)
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; font-weight:800; color:#64748b; text-transform:uppercase;">
                                        Changes (পরিবর্তন)
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($activities as $activity)
                                    @php
                                        $causerName = $activity->causer?->name ?? 'System';
                                        $causerEmail = $activity->causer?->email ?? null;

                                        $subjectType = $activity->subject_type
                                            ? class_basename($activity->subject_type)
                                            : 'N/A';

                                        $subjectId = $activity->subject_id ?? 'N/A';

                                        $eventStyle = match($activity->event) {
                                            'created' => 'background:#dcfce7;color:#15803d;',
                                            'updated' => 'background:#dbeafe;color:#1d4ed8;',
                                            'deleted' => 'background:#fee2e2;color:#b91c1c;',
                                            default => 'background:#f1f5f9;color:#334155;',
                                        };

                                        $properties = $activity->properties ?? collect();
                                        $attributes = $properties->get('attributes', []);
                                        $old = $properties->get('old', []);
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 18px; font-size:13px; color:#475569; white-space:nowrap;">
                                            {{ $activity->created_at->format('M d, Y h:i A') }}

                                            <br>

                                            <span style="font-size:12px; color:#94a3b8;">
                                                {{ $activity->created_at->diffForHumans() }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#172033;">
                                            <strong>{{ $causerName }}</strong>

                                            @if ($causerEmail)
                                                <br>
                                                <span style="font-size:12px; color:#64748b;">
                                                    {{ $causerEmail }}
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <div>
                                                <span style="{{ $eventStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900;">
                                                    {{ ucfirst($activity->event ?? 'activity') }}
                                                </span>

                                                <p style="margin:8px 0 0; color:#475569; line-height:1.6;">
                                                    {{ $activity->description }}
                                                </p>

                                                @if ($activity->log_name)
                                                    <span style="display:inline-block; margin-top:6px; background:#f8fafc; border:1px solid #e5e7eb; color:#64748b; padding:4px 8px; border-radius:999px; font-size:11px; font-weight:800;">
                                                        {{ $activity->log_name }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569;">
                                            <strong>{{ $subjectType }}</strong>

                                            <br>

                                            <span style="font-size:12px; color:#64748b;">
                                                ID: {{ $subjectId }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:13px; color:#475569; min-width:280px;">
                                            @if (! empty($attributes) || ! empty($old))
                                                <details>
                                                    <summary style="cursor:pointer; color:#0F766E; font-weight:900;">
                                                        View Changes (পরিবর্তন দেখুন)
                                                    </summary>

                                                    @if (! empty($old))
                                                        <div style="margin-top:10px;">
                                                            <strong style="color:#b91c1c;">Old Data (পুরোনো ডাটা)</strong>

                                                            <pre style="white-space:pre-wrap; background:#fef2f2; border:1px solid #fecaca; color:#7f1d1d; padding:10px; border-radius:10px; font-size:12px; overflow:auto;">{{ json_encode($old, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                        </div>
                                                    @endif

                                                    @if (! empty($attributes))
                                                        <div style="margin-top:10px;">
                                                            <strong style="color:#15803d;">New Data (নতুন ডাটা)</strong>

                                                            <pre style="white-space:pre-wrap; background:#f0fdf4; border:1px solid #bbf7d0; color:#14532d; padding:10px; border-radius:10px; font-size:12px; overflow:auto;">{{ json_encode($attributes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                        </div>
                                                    @endif
                                                </details>
                                            @else
                                                <span style="color:#94a3b8;">
                                                    No detailed changes stored.
                                                    <br>
                                                    বিস্তারিত পরিবর্তন সংরক্ষিত নেই।
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="border-top:1px solid #e5e7eb; padding:16px 20px;">
                        {{ $activities->links() }}
                    </div>
                @else
                    <div style="padding:42px 24px; text-align:center;">
                        <div style="width:48px; height:48px; margin:0 auto; display:flex; align-items:center; justify-content:center; border-radius:50%; background:#ccfbf1; color:#0F766E; font-size:20px; font-weight:800;">
                            !
                        </div>

                        <h3 style="margin-top:18px; font-size:20px; font-weight:800; color:#172033;">
                            No audit logs found (কোনো অডিট লগ পাওয়া যায়নি)
                        </h3>

                        <p style="margin-top:8px; font-size:14px; color:#64748b;">
                            Logs will appear after users perform important actions.
                            <br>
                            ব্যবহারকারীরা গুরুত্বপূর্ণ কাজ করলে লগ এখানে দেখা যাবে।
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>