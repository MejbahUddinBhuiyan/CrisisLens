<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Manage Users (ব্যবহারকারী পরিচালনা)
                </h2>

                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Search, filter, create, update, and assign user roles.
                    <br>
                    ব্যবহারকারী সার্চ, ফিল্টার, তৈরি, আপডেট এবং রোল নির্ধারণ করুন।
                </p>
            </div>

            <a href="{{ route('admin.users.create') }}"
               style="display:inline-block; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                Create User (ব্যবহারকারী তৈরি)
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
                  action="{{ route('admin.users.index') }}"
                  style="margin-bottom:24px; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:20px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(210px, 1fr)); gap:14px; align-items:end;">
                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Search (সার্চ)
                        </label>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Name or email..."
                               style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Role (রোল)
                        </label>

                        <select name="role"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Roles</option>

                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @selected(request('role') === $role->name)>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:800; color:#172033;">
                            Verification (ভেরিফিকেশন)
                        </label>

                        <select name="verification"
                                style="margin-top:7px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:10px;">
                            <option value="">All Users</option>
                            <option value="verified" @selected(request('verification') === 'verified')>
                                Verified (যাচাইকৃত)
                            </option>
                            <option value="unverified" @selected(request('verification') === 'unverified')>
                                Unverified (যাচাইকৃত নয়)
                            </option>
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
                    <a href="{{ route('admin.users.index') }}"
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
                    Showing {{ $users->count() }} of {{ $users->total() }} users
                    <br>
                    মোট {{ $users->total() }} ব্যবহারকারীর মধ্যে {{ $users->count() }} জন দেখানো হচ্ছে
                </p>

                @if (request()->hasAny(['search', 'role', 'verification', 'date']))
                    <span style="background:#e0f2fe; color:#0369a1; padding:7px 12px; border-radius:999px; font-size:12px; font-weight:900;">
                        Filter Active (ফিল্টার চালু)
                    </span>
                @endif
            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; box-shadow:0 1px 3px rgba(15,23,42,0.08); overflow:hidden;">
                @if ($users->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        User (ব্যবহারকারী)
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        Role (রোল)
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        Verification (যাচাই)
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        Created (তৈরি)
                                    </th>

                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">
                                        Action (কাজ)
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    @php
                                        $roleName = $user->roles->first()?->name ?? 'No Role';

                                        $roleStyle = match($roleName) {
                                            'Citizen' => 'background:#dcfce7;color:#15803d;',
                                            'Emergency Responder' => 'background:#fef3c7;color:#b45309;',
                                            'Authority Administrator' => 'background:#e0f2fe;color:#0369a1;',
                                            'Super Administrator' => 'background:#fee2e2;color:#b91c1c;',
                                            default => 'background:#f3f4f6;color:#374151;',
                                        };
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 18px; font-size:14px; color:#172033;">
                                            <strong>{{ $user->name }}</strong>

                                            <br>

                                            <span style="font-size:12px; color:#64748b;">
                                                {{ $user->email }}
                                            </span>

                                            @if (auth()->id() === $user->id)
                                                <span style="display:inline-block; margin-left:6px; background:#ccfbf1; color:#0F766E; padding:3px 7px; border-radius:999px; font-size:11px; font-weight:900;">
                                                    You
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <span style="{{ $roleStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900; white-space:nowrap;">
                                                {{ $roleName }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            @if ($user->email_verified_at)
                                                <span style="background:#dcfce7; color:#15803d; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900;">
                                                    Verified
                                                </span>

                                                <br>

                                                <span style="font-size:12px; color:#64748b;">
                                                    {{ $user->email_verified_at->format('M d, Y') }}
                                                </span>
                                            @else
                                                <span style="background:#fef3c7; color:#b45309; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:900;">
                                                    Unverified
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569; white-space:nowrap;">
                                            {{ $user->created_at->format('M d, Y h:i A') }}
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; white-space:nowrap;">
                                            <a href="{{ route('admin.users.edit', $user) }}"
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
                        {{ $users->links() }}
                    </div>
                @else
                    <div style="padding:42px 24px; text-align:center;">
                        <h3 style="font-size:20px; font-weight:900; color:#172033;">
                            No users found (কোনো ব্যবহারকারী পাওয়া যায়নি)
                        </h3>

                        <p style="margin-top:8px; color:#64748b;">
                            Try changing or clearing the filter options.
                            <br>
                            ফিল্টার পরিবর্তন বা রিসেট করে আবার চেষ্টা করুন।
                        </p>

                        <div style="margin-top:22px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
                            <a href="{{ route('admin.users.index') }}"
                               style="display:inline-block; background:white; color:#172033; padding:11px 18px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                Clear Filters (ফিল্টার মুছুন)
                            </a>

                            <a href="{{ route('admin.users.create') }}"
                               style="display:inline-block; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                                Create User (ব্যবহারকারী তৈরি)
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>