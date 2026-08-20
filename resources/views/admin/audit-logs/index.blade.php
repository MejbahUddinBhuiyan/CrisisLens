<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Audit Logs (অডিট লগ)
                </h2>

                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Search and filter system actions, user activities, and important changes.
                    <br>
                    সিস্টেম কার্যক্রম, ব্যবহারকারী কার্যকলাপ এবং গুরুত্বপূর্ণ পরিবর্তন সার্চ ও ফিল্টার করুন।
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                Back to Dashboard (ড্যাশবোর্ডে ফিরুন)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1250px; margin:0 auto; padding:0 16px;">

            <div style="margin-bottom:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px; line-height:1.7;">
                <strong>Audit Notice (অডিট নোট):</strong>
                This page helps Super Admin monitor important system actions such as report approval, rejection, responder updates, and safety guide changes.
                <br>
                এই পেজটি সুপার অ্যাডমিনকে রিপোর্ট অনুমোদন, বাতিল, রেসপন্ডার আপডেট এবং নিরাপত্তা গাইড পরিবর্তনের মতো গুরুত্বপূর্ণ কার্যক্রম পর্যবেক্ষণ করতে সাহায্য করে।
            </div>

            <form method="GET"
                  action="{{ route('admin.audit-logs.index') }}"
                  style="margin-bottom:24px; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:20px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:14px; align-items:end;">
                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Search (সার্চ)
                        </label>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="User, event, model, description..."
                               style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Action / Event (কাজ / ইভেন্ট)
                        </label>

                        <select name="event"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Events</option>

                            @foreach ($events as $event)
                                <option value="{{ $event }}" @selected(request('event') === $event)>
                                    {{ $event }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Target Model (টার্গেট মডেল)
                        </label>

                        <select name="subject_type"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Models</option>

                            @foreach ($subjectTypes as $subjectType)
                                <option value="{{ $subjectType }}" @selected(request('subject_type') === $subjectType)>
                                    {{ class_basename($subjectType) }}
                                </option>
                            @endforeach
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
                    <a href="{{ route('admin.audit-logs.index') }}"
                       style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                        Reset (রিসেট)
                    </a>

                    <button type="submit"
                            style="border:none; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:800; cursor:pointer;">
                        Apply Filter (ফিল্টার করুন)
                    </button>
                </div>
            </form>

            <div style="margin-bottom:16px; display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px;">
                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; font-weight:800; color:#64748b;">
                        Showing Logs (দেখানো লগ)
                    </p>
                    <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#172033;">
                        {{ $activities->count() }}
                    </h3>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; font-weight:800; color:#64748b;">
                        Total Records (মোট রেকর্ড)
                    </p>
                    <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#0369a1;">
                        {{ $activities->total() }}
                    </h3>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <p style="margin:0; font-size:13px; font-weight:800; color:#64748b;">
                        Current Page (বর্তমান পেজ)
                    </p>
                    <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#0F766E;">
                        {{ $activities->currentPage() }}
                    </h3>
                </div>

                @if (request()->hasAny(['search', 'event', 'subject_type', 'date']))
                    <div style="background:#e0f2fe; border:1px solid #bae6fd; border-radius:14px; padding:18px;">
                        <p style="margin:0; font-size:13px; font-weight:800; color:#0369a1;">
                            Filter Status (ফিল্টার অবস্থা)
                        </p>
                        <h3 style="margin:8px 0 0; font-size:22px; font-weight:900; color:#0369a1;">
                            Active
                        </h3>
                    </div>
                @endif
            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; box-shadow:0 1px 3px rgba(15,23,42,0.08); overflow:hidden;">
                @if ($activities->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        Time
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        User
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        Action
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        Target
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        Details
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($activities as $activity)
                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 18px; font-size:14px; color:#475569; white-space:nowrap;">
                                            {{ $activity->created_at->format('M d, Y') }}
                                            <br>
                                            <span style="font-size:12px; color:#64748b;">
                                                {{ $activity->created_at->format('h:i A') }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#172033;">
                                            @if ($activity->causer)
                                                <strong>{{ $activity->causer->name }}</strong>
                                                <br>
                                                <span style="font-size:12px; color:#64748b;">
                                                    {{ $activity->causer->email }}
                                                </span>
                                            @else
                                                <strong>System</strong>
                                                <br>
                                                <span style="font-size:12px; color:#64748b;">
                                                    No user
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <span style="background:#ccfbf1; color:#0F766E; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ $activity->event ?? 'activity' }}
                                            </span>

                                            <p style="margin:8px 0 0; color:#475569; font-size:13px;">
                                                {{ $activity->description }}
                                            </p>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569;">
                                            @if ($activity->subject_type)
                                                <strong style="color:#172033;">
                                                    {{ class_basename($activity->subject_type) }}
                                                </strong>

                                                <br>

                                                <span style="font-size:12px; color:#64748b;">
                                                    ID: {{ $activity->subject_id ?? 'N/A' }}
                                                </span>
                                            @else
                                                <span style="color:#64748b;">No target</span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:13px; color:#475569; min-width:280px;">
                                            @if ($activity->properties && $activity->properties->count())
                                                <details>
                                                    <summary style="cursor:pointer; color:#0F766E; font-weight:900;">
                                                        View Changes
                                                    </summary>

                                                    <pre style="margin-top:10px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:12px; white-space:pre-wrap; word-break:break-word; font-size:12px; color:#334155;">{{ json_encode($activity->properties->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                </details>
                                            @else
                                                <span style="color:#64748b;">No extra data</span>
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
                        <h3 style="font-size:20px; font-weight:900; color:#172033;">
                            No audit logs found (কোনো অডিট লগ পাওয়া যায়নি)
                        </h3>

                        <p style="margin-top:8px; color:#64748b;">
                            Try changing or clearing the filter options.
                            <br>
                            ফিল্টার পরিবর্তন বা রিসেট করে আবার চেষ্টা করুন।
                        </p>

                        <a href="{{ route('admin.audit-logs.index') }}"
                           style="display:inline-block; margin-top:20px; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                            Clear Filters (ফিল্টার মুছুন)
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>