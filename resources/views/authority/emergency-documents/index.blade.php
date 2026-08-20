<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Safety Guides (নিরাপত্তা গাইড)
                </h2>

                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Search, filter, create, edit, verify, and publish emergency safety guides.
                    <br>
                    জরুরি নিরাপত্তা গাইড সার্চ, ফিল্টার, তৈরি, সম্পাদনা, যাচাই এবং প্রকাশ করুন।
                </p>
            </div>

            <a href="{{ route('authority.emergency-documents.create') }}"
               style="display:inline-block; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                Create Guide (গাইড তৈরি)
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
                  action="{{ route('authority.emergency-documents.index') }}"
                  style="margin-bottom:24px; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:20px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(210px, 1fr)); gap:14px; align-items:end;">
                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Search (সার্চ)
                        </label>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Title, content, uploader..."
                               style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Category (ক্যাটাগরি)
                        </label>

                        <select name="category"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Categories</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category }}" @selected(request('category') === $category)>
                                    {{ ucfirst(str_replace('_', ' ', $category)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Language (ভাষা)
                        </label>

                        <select name="language"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Languages</option>
                            <option value="English" @selected(request('language') === 'English')>English</option>
                            <option value="Bangla" @selected(request('language') === 'Bangla')>Bangla</option>
                            <option value="English-Bangla" @selected(request('language') === 'English-Bangla')>English-Bangla</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Active Status (প্রকাশ অবস্থা)
                        </label>

                        <select name="active_status"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All</option>
                            <option value="active" @selected(request('active_status') === 'active')>Active (সক্রিয়)</option>
                            <option value="inactive" @selected(request('active_status') === 'inactive')>Inactive (নিষ্ক্রিয়)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Verification (যাচাই)
                        </label>

                        <select name="verified_status"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All</option>
                            <option value="verified" @selected(request('verified_status') === 'verified')>Verified (যাচাইকৃত)</option>
                            <option value="unverified" @selected(request('verified_status') === 'unverified')>Unverified (যাচাইকৃত নয়)</option>
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
                    <a href="{{ route('authority.emergency-documents.index') }}"
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
                    Showing {{ $documents->count() }} of {{ $documents->total() }} guides
                    <br>
                    মোট {{ $documents->total() }} গাইডের মধ্যে {{ $documents->count() }} টি দেখানো হচ্ছে
                </p>

                @if (request()->hasAny(['search', 'category', 'language', 'active_status', 'verified_status', 'date']))
                    <span style="background:#e0f2fe; color:#0369a1; padding:7px 12px; border-radius:999px; font-size:12px; font-weight:900;">
                        Filter Active (ফিল্টার চালু)
                    </span>
                @endif
            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; box-shadow:0 1px 3px rgba(15,23,42,0.08); overflow:hidden;">
                @if ($documents->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Guide</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Category</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Language</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Status</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Uploader</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Created</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($documents as $document)
                                    @php
                                        $activeStyle = $document->is_active
                                            ? 'background:#dcfce7;color:#15803d;'
                                            : 'background:#f3f4f6;color:#374151;';

                                        $verifiedStyle = $document->is_verified
                                            ? 'background:#dcfce7;color:#15803d;'
                                            : 'background:#fef3c7;color:#b45309;';

                                        $languageStyle = match($document->language) {
                                            'English' => 'background:#e0f2fe;color:#0369a1;',
                                            'Bangla' => 'background:#dcfce7;color:#15803d;',
                                            'English-Bangla' => 'background:#ccfbf1;color:#0F766E;',
                                            default => 'background:#f3f4f6;color:#374151;',
                                        };
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 18px; font-size:14px; color:#172033; min-width:280px;">
                                            <strong>{{ $document->title }}</strong>

                                            <p style="margin:6px 0 0; color:#64748b; font-size:13px; line-height:1.6;">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($document->content), 110) }}
                                            </p>

                                            @if ($document->is_demo)
                                                <span style="display:inline-block; margin-top:8px; background:#e0f2fe; color:#0369a1; padding:4px 8px; border-radius:999px; font-size:11px; font-weight:900;">
                                                    Demo
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <span style="background:#f1f5f9; color:#334155; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ ucfirst(str_replace('_', ' ', $document->category)) }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <span style="{{ $languageStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ $document->language }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; min-width:160px;">
                                            <span style="{{ $activeStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ $document->is_active ? 'Active (সক্রিয়)' : 'Inactive (নিষ্ক্রিয়)' }}
                                            </span>

                                            <br>

                                            <span style="{{ $verifiedStyle }} display:inline-block; margin-top:7px; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ $document->is_verified ? 'Verified (যাচাইকৃত)' : 'Unverified (যাচাইকৃত নয়)' }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569;">
                                            <strong style="color:#172033;">
                                                {{ $document->uploader?->name ?? 'N/A' }}
                                            </strong>

                                            <br>

                                            <span style="font-size:12px; color:#64748b;">
                                                {{ $document->uploader?->email ?? 'No email' }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569; white-space:nowrap;">
                                            {{ $document->created_at->format('M d, Y h:i A') }}
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; white-space:nowrap;">
                                            <a href="{{ route('authority.emergency-documents.edit', $document) }}"
                                               style="display:inline-block; background:#0F766E; color:white; padding:8px 12px; border-radius:8px; font-size:13px; font-weight:800; text-decoration:none;">
                                                Edit (সম্পাদনা)
                                            </a>

                                            @if ($document->is_active && $document->is_verified)
                                                <a href="{{ route('public.safety-guides.show', $document) }}"
                                                   target="_blank"
                                                   style="display:inline-block; margin-left:6px; background:white; color:#0F766E; padding:8px 12px; border:1px solid #0F766E; border-radius:8px; font-size:13px; font-weight:800; text-decoration:none;">
                                                    Public View
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="border-top:1px solid #e5e7eb; padding:16px 20px;">
                        {{ $documents->links() }}
                    </div>
                @else
                    <div style="padding:42px 24px; text-align:center;">
                        <h3 style="font-size:20px; font-weight:900; color:#172033;">
                            No safety guides found (কোনো নিরাপত্তা গাইড পাওয়া যায়নি)
                        </h3>

                        <p style="margin-top:8px; color:#64748b;">
                            Try changing or clearing the filter options.
                            <br>
                            ফিল্টার পরিবর্তন বা রিসেট করে আবার চেষ্টা করুন।
                        </p>

                        <div style="margin-top:22px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
                            <a href="{{ route('authority.emergency-documents.index') }}"
                               style="display:inline-block; background:white; color:#172033; padding:11px 18px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                Clear Filters (ফিল্টার মুছুন)
                            </a>

                            <a href="{{ route('authority.emergency-documents.create') }}"
                               style="display:inline-block; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                Create Guide (গাইড তৈরি)
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>