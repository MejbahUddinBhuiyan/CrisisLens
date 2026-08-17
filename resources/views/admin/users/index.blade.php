<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    User Management (ব্যবহারকারী ব্যবস্থাপনা)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Create users and assign system roles.
                    <br>
                    ব্যবহারকারী তৈরি করুন এবং সিস্টেম রোল নির্ধারণ করুন।
                </p>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a href="{{ route('admin.dashboard') }}"
                   style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                    Admin Dashboard (অ্যাডমিন ড্যাশবোর্ড)
                </a>

                <a href="{{ route('admin.users.create') }}"
                   style="display:inline-block; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                    Add User (ব্যবহারকারী যোগ করুন)
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
                @if ($users->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        User (ব্যবহারকারী)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Role (রোল)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Email Verified (ইমেইল যাচাই)
                                    </th>

                                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Created (তৈরি)
                                    </th>

                                    <th style="padding:14px 20px; text-align:right; font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">
                                        Action (কাজ)
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    @php
                                        $roleName = $user->roles->first()?->name ?? 'No Role';

                                        $roleStyle = match($roleName) {
                                            'Super Administrator' => 'background:#fee2e2;color:#b91c1c;',
                                            'Authority Administrator' => 'background:#fef3c7;color:#b45309;',
                                            'Emergency Responder' => 'background:#e0f2fe;color:#0369a1;',
                                            'Citizen' => 'background:#dcfce7;color:#15803d;',
                                            default => 'background:#f3f4f6;color:#374151;',
                                        };
                                    @endphp

                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 20px; font-size:14px; color:#172033;">
                                            <strong>{{ $user->name }}</strong>
                                            <div style="margin-top:4px; font-size:12px; color:#64748b;">
                                                {{ $user->email }}
                                            </div>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            <span style="{{ $roleStyle }} padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                {{ $roleName }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px;">
                                            @if ($user->email_verified_at)
                                                <span style="background:#dcfce7; color:#15803d; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                    Verified (যাচাই হয়েছে)
                                                </span>
                                            @else
                                                <span style="background:#fef3c7; color:#b45309; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:700;">
                                                    Pending (অপেক্ষমাণ)
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 20px; font-size:14px; color:#475569;">
                                            {{ $user->created_at->format('M d, Y h:i A') }}
                                        </td>

                                        <td style="padding:16px 20px; text-align:right;">
                                            <a href="{{ route('admin.users.edit', $user) }}"
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
                        {{ $users->links() }}
                    </div>
                @else
                    <div style="padding:40px 24px; text-align:center;">
                        <h3 style="font-size:20px; font-weight:800; color:#172033;">
                            No users found (কোনো ব্যবহারকারী পাওয়া যায়নি)
                        </h3>

                        <p style="margin-top:8px; font-size:14px; color:#64748b;">
                            Create users and assign roles.
                            <br>
                            ব্যবহারকারী তৈরি করুন এবং রোল নির্ধারণ করুন।
                        </p>

                        <a href="{{ route('admin.users.create') }}"
                           style="display:inline-block; margin-top:22px; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                            Add First User (প্রথম ব্যবহারকারী যোগ করুন)
                        </a>
                    </div>
                @endif
            </div>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Admin Notice (অ্যাডমিন নোট):</strong>
                Assign roles carefully because each role controls access to important emergency features.
                <br>
                সতর্কতার সাথে রোল নির্ধারণ করুন, কারণ প্রতিটি রোল গুরুত্বপূর্ণ জরুরি ফিচারে প্রবেশাধিকার নিয়ন্ত্রণ করে।
            </div>
        </div>
    </div>
</x-app-layout>