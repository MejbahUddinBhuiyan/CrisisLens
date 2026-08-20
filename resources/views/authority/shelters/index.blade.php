<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Manage Shelters (আশ্রয়কেন্দ্র পরিচালনা)
                </h2>

                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Search, filter, create, and update emergency shelters.
                    <br>
                    জরুরি আশ্রয়কেন্দ্র সার্চ, ফিল্টার, তৈরি এবং আপডেট করুন।
                </p>
            </div>

            <a href="{{ route('authority.shelters.create') }}"
               style="display:inline-block; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                Add Shelter (আশ্রয়কেন্দ্র যোগ করুন)
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
                  action="{{ route('authority.shelters.index') }}"
                  style="margin-bottom:24px; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:20px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:14px; align-items:end;">
                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Search (সার্চ)
                        </label>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Name, address, contact..."
                               style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Status (অবস্থা)
                        </label>

                        <select name="status"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Status</option>
                            <option value="active" @selected(request('status') === 'active')>Active (সক্রিয়)</option>
                            <option value="inactive" @selected(request('status') === 'inactive')>Inactive (নিষ্ক্রিয়)</option>
                            <option value="available" @selected(request('status') === 'available')>Available Space (জায়গা আছে)</option>
                            <option value="full" @selected(request('status') === 'full')>Full (পূর্ণ)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Facility (সুবিধা)
                        </label>

                        <select name="facility"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Facilities</option>
                            <option value="drinking_water" @selected(request('facility') === 'drinking_water')>Drinking Water (পানীয় পানি)</option>
                            <option value="toilet" @selected(request('facility') === 'toilet')>Toilet (টয়লেট)</option>
                            <option value="medical_support" @selected(request('facility') === 'medical_support')>Medical Support (চিকিৎসা সহায়তা)</option>
                            <option value="women_safe_space" @selected(request('facility') === 'women_safe_space')>Women Safe Space (নারীদের নিরাপদ স্থান)</option>
                            <option value="child_support" @selected(request('facility') === 'child_support')>Child Support (শিশু সহায়তা)</option>
                            <option value="electricity" @selected(request('facility') === 'electricity')>Electricity (বিদ্যুৎ)</option>
                            <option value="food_support" @selected(request('facility') === 'food_support')>Food Support (খাদ্য সহায়তা)</option>
                            <option value="pet_allowed" @selected(request('facility') === 'pet_allowed')>Pet Allowed (পোষা প্রাণী অনুমোদিত)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Minimum Capacity (সর্বনিম্ন ধারণক্ষমতা)
                        </label>

                        <input type="number"
                               name="min_capacity"
                               value="{{ request('min_capacity') }}"
                               min="0"
                               placeholder="Example: 100"
                               style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                    </div>
                </div>

                <div style="margin-top:16px; display:flex; justify-content:flex-end; gap:10px; flex-wrap:wrap;">
                    <a href="{{ route('authority.shelters.index') }}"
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
                    Showing {{ $shelters->count() }} of {{ $shelters->total() }} shelters
                    <br>
                    মোট {{ $shelters->total() }} আশ্রয়কেন্দ্রের মধ্যে {{ $shelters->count() }} টি দেখানো হচ্ছে
                </p>

                @if (request()->hasAny(['search', 'status', 'facility', 'min_capacity']))
                    <span style="background:#e0f2fe; color:#0369a1; padding:7px 12px; border-radius:999px; font-size:12px; font-weight:900;">
                        Filter Active (ফিল্টার চালু)
                    </span>
                @endif
            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; box-shadow:0 1px 3px rgba(15,23,42,0.08); overflow:hidden;">
                @if ($shelters->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Shelter</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Capacity</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Status</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Facilities</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Location</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($shelters as $shelter)
                                    @php
                                        $capacity = max((int) $shelter->capacity, 1);
                                        $occupancy = (int) $shelter->current_occupancy;
                                        $available = max($capacity - $occupancy, 0);
                                        $percentage = min(round(($occupancy / $capacity) * 100), 100);
                                        $facilities = is_array($shelter->facilities) ? $shelter->facilities : [];

                                        if (! $shelter->is_active) {
                                            $statusLabel = 'Inactive (নিষ্ক্রিয়)';
                                            $statusStyle = 'background:#f3f4f6;color:#374151;';
                                        } elseif ($occupancy >= $capacity) {
                                            $statusLabel = 'Full (পূর্ণ)';
                                            $statusStyle = 'background:#fee2e2;color:#b91c1c;';
                                        } else {
                                            $statusLabel = 'Available (উপলব্ধ)';
                                            $statusStyle = 'background:#dcfce7;color:#15803d;';
                                        }
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 18px; font-size:14px; color:#172033; min-width:240px;">
                                            <strong>{{ $shelter->name }}</strong>
                                            <br>
                                            <span style="font-size:12px; color:#64748b;">
                                                {{ $shelter->address }}
                                            </span>
                                            <br>
                                            <span style="font-size:12px; color:#64748b;">
                                                Contact: {{ $shelter->contact ?? 'N/A' }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569; min-width:180px;">
                                            <strong style="color:#172033;">
                                                {{ $occupancy }} / {{ $capacity }}
                                            </strong>

                                            <br>

                                            <span style="font-size:12px; color:#64748b;">
                                                Available: {{ $available }}
                                            </span>

                                            <div style="margin-top:8px; height:8px; background:#e5e7eb; border-radius:999px; overflow:hidden;">
                                                <div style="height:8px; width:{{ $percentage }}%; background:#0F766E; border-radius:999px;"></div>
                                            </div>

                                            <span style="font-size:12px; color:#64748b;">
                                                {{ $percentage }}% occupied
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <span style="{{ $statusStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ $statusLabel }}
                                            </span>

                                            @if ($shelter->is_demo)
                                                <br>
                                                <span style="display:inline-block; margin-top:6px; background:#e0f2fe; color:#0369a1; padding:4px 8px; border-radius:999px; font-size:11px; font-weight:900;">
                                                    Demo
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569; min-width:220px;">
                                            @if (count($facilities))
                                                <div style="display:flex; flex-wrap:wrap; gap:6px;">
                                                    @foreach ($facilities as $facility)
                                                        <span style="background:#f1f5f9; color:#334155; padding:5px 8px; border-radius:999px; font-size:11px; font-weight:800;">
                                                            {{ \App\Support\BilingualLabel::facility($facility) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span style="color:#64748b;">No facilities listed</span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569; min-width:180px;">
                                            {{ $shelter->latitude }}, {{ $shelter->longitude }}

                                            <br>

                                            <a href="https://www.google.com/maps?q={{ $shelter->latitude }},{{ $shelter->longitude }}"
                                               target="_blank"
                                               style="font-size:12px; color:#0F766E; font-weight:800; text-decoration:none;">
                                                Map (মানচিত্র)
                                            </a>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; white-space:nowrap;">
                                            <a href="{{ route('authority.shelters.edit', $shelter) }}"
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
                        {{ $shelters->links() }}
                    </div>
                @else
                    <div style="padding:42px 24px; text-align:center;">
                        <h3 style="font-size:20px; font-weight:900; color:#172033;">
                            No shelters found (কোনো আশ্রয়কেন্দ্র পাওয়া যায়নি)
                        </h3>

                        <p style="margin-top:8px; color:#64748b;">
                            Try changing or clearing the filter options.
                            <br>
                            ফিল্টার পরিবর্তন বা রিসেট করে আবার চেষ্টা করুন।
                        </p>

                        <div style="margin-top:22px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
                            <a href="{{ route('authority.shelters.index') }}"
                               style="display:inline-block; background:white; color:#172033; padding:11px 18px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                Clear Filters (ফিল্টার মুছুন)
                            </a>

                            <a href="{{ route('authority.shelters.create') }}"
                               style="display:inline-block; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                Add Shelter (আশ্রয়কেন্দ্র যোগ করুন)
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>