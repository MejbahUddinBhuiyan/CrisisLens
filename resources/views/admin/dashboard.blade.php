<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px; font-weight:700; color:#172033;">
                Super Admin Dashboard (সুপার অ্যাডমিন ড্যাশবোর্ড)
            </h2>
            <p style="margin-top:6px; font-size:14px; color:#64748b;">
                Manage users, roles, reports, shelters, and alerts.
                <br>
                ব্যবহারকারী, রোল, রিপোর্ট, আশ্রয়কেন্দ্র এবং সতর্কতা পরিচালনা করুন।
            </p>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 16px;">

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                <p style="font-size:14px; font-weight:700; color:#b91c1c;">
                    CrisisLens System Control (CrisisLens সিস্টেম নিয়ন্ত্রণ)
                </p>

                <h1 style="margin-top:8px; font-size:26px; font-weight:800; color:#172033;">
                    Full System Administration
                    <br>
                    সম্পূর্ণ সিস্টেম প্রশাসন
                </h1>

                <p style="margin-top:10px; color:#64748b; line-height:1.7;">
                    Use this dashboard to manage users, assign roles, review authority features, monitor shelters, and manage public alerts.
                    <br>
                    ব্যবহারকারী পরিচালনা, রোল নির্ধারণ, কর্তৃপক্ষের ফিচার দেখা, আশ্রয়কেন্দ্র পর্যবেক্ষণ এবং সতর্কতা পরিচালনার জন্য এই ড্যাশবোর্ড ব্যবহার করুন।
                </p>
            </div>
            <div style="margin-top:24px; display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px;">
    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Users (ব্যবহারকারী)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#172033;">{{ $stats['total_users'] ?? 0 }}</h3>
    </div>

    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Reports (রিপোর্ট)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#0369a1;">{{ $stats['total_reports'] ?? 0 }}</h3>
    </div>

    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Pending (অপেক্ষমাণ)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#b45309;">{{ $stats['pending_reports'] ?? 0 }}</h3>
    </div>

    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Resolved (সমাধান)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#15803d;">{{ $stats['resolved_reports'] ?? 0 }}</h3>
    </div>

    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Shelters (আশ্রয়কেন্দ্র)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#0F766E;">{{ $stats['active_shelters'] ?? 0 }}</h3>
    </div>

    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Alerts (সতর্কতা)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#b91c1c;">{{ $stats['published_alerts'] ?? 0 }}</h3>
    </div>
</div>

            <div style="margin-top:24px; display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
                <a href="{{ route('admin.users.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#fee2e2; color:#b91c1c; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        U
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Manage Users (ব্যবহারকারী পরিচালনা)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        Create users, update accounts, and assign roles.
                        <br>
                        ব্যবহারকারী তৈরি, অ্যাকাউন্ট আপডেট এবং রোল নির্ধারণ করুন।
                    </p>
                </a>

                <a href="{{ route('authority.reports.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#e0f2fe; color:#0369a1; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        R
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Review Reports (রিপোর্ট পর্যালোচনা)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        View citizen reports and authority validation workflow.
                        <br>
                        নাগরিক রিপোর্ট এবং কর্তৃপক্ষ যাচাই প্রক্রিয়া দেখুন।
                    </p>
                </a>

                <a href="{{ route('responder.reports.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#fef3c7; color:#b45309; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        E
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Emergency Response (জরুরি সাড়া)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        Monitor responder workflow and resolved reports.
                        <br>
                        রেসপন্ডার কার্যক্রম এবং সমাধান করা রিপোর্ট পর্যবেক্ষণ করুন।
                    </p>
                </a>

                <a href="{{ route('authority.shelters.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#dcfce7; color:#15803d; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        S
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Manage Shelters (আশ্রয়কেন্দ্র পরিচালনা)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        Add and update shelter capacity, facilities, and status.
                        <br>
                        আশ্রয়কেন্দ্রের ধারণক্ষমতা, সুবিধা এবং অবস্থা আপডেট করুন।
                    </p>
                </a>

                <a href="{{ route('authority.alerts.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#fee2e2; color:#b91c1c; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        !
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Manage Alerts (সতর্কতা পরিচালনা)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        Create, publish, and update public disaster alerts.
                        <br>
                        জনসাধারণের দুর্যোগ সতর্কতা তৈরি, প্রকাশ এবং আপডেট করুন।
                    </p>
                </a>
            </div>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Super Admin Notice (সুপার অ্যাডমিন নোট):</strong>
                Role changes immediately affect user access. Assign permissions carefully.
                <br>
                রোল পরিবর্তন করলে সাথে সাথে ব্যবহারকারীর প্রবেশাধিকার পরিবর্তন হয়। সতর্কতার সাথে অনুমতি নির্ধারণ করুন।
            </div>
        </div>
    </div>
</x-app-layout>