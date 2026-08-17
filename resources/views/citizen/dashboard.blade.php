<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px; font-weight:700; color:#172033;">
                Citizen Dashboard (নাগরিক ড্যাশবোর্ড)
            </h2>
            <p style="margin-top:6px; font-size:14px; color:#64748b;">
                View alerts, submit incident reports, and find nearby shelters.
                <br>
                সতর্কতা দেখুন, ঘটনার রিপোর্ট জমা দিন এবং কাছাকাছি আশ্রয়কেন্দ্র খুঁজুন।
            </p>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 16px;">

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                <p style="font-size:14px; font-weight:700; color:#0F766E;">
                    CrisisLens Citizen Portal (CrisisLens নাগরিক পোর্টাল)
                </p>

                <h1 style="margin-top:8px; font-size:26px; font-weight:800; color:#172033;">
                    Current Disaster Risk & Safety Services
                    <br>
                    বর্তমান দুর্যোগ ঝুঁকি ও নিরাপত্তা সেবা
                </h1>

                <p style="margin-top:10px; color:#64748b; line-height:1.7;">
                    Use this dashboard to view public alerts, submit incident reports, check your reports, and find nearby shelters.
                    <br>
                    জনসাধারণের সতর্কতা দেখতে, ঘটনার রিপোর্ট জমা দিতে, নিজের রিপোর্ট দেখতে এবং কাছাকাছি আশ্রয়কেন্দ্র খুঁজতে এই ড্যাশবোর্ড ব্যবহার করুন।
                </p>
            </div>

            <div style="margin-top:24px; display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:20px;">
                <a href="{{ route('citizen.alerts.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#fee2e2; color:#b91c1c; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        !
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Public Alerts (জনসাধারণের সতর্কতা)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        View active disaster alerts and safety instructions.
                        <br>
                        সক্রিয় দুর্যোগ সতর্কতা ও নিরাপত্তা নির্দেশনা দেখুন।
                    </p>
                </a>

                <a href="{{ route('citizen.reports.create') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#ccfbf1; color:#0F766E; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        +
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Submit Report (রিপোর্ট জমা দিন)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        Report flood, cyclone, road block, damage, or emergency needs.
                        <br>
                        বন্যা, ঘূর্ণিঝড়, রাস্তা বন্ধ, ক্ষতি বা জরুরি প্রয়োজন রিপোর্ট করুন।
                    </p>
                </a>

                <a href="{{ route('citizen.reports.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#e0f2fe; color:#0369a1; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        R
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        My Reports (আমার রিপোর্ট)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        Track your submitted reports and AI prediction status.
                        <br>
                        আপনার জমা দেওয়া রিপোর্ট এবং AI পূর্বাভাসের অবস্থা দেখুন।
                    </p>
                </a>

                <a href="{{ route('citizen.shelters.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#dcfce7; color:#15803d; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        S
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Shelter Directory (আশ্রয়কেন্দ্র তালিকা)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        Find active shelters, available capacity, contact, and map location.
                        <br>
                        সক্রিয় আশ্রয়কেন্দ্র, খালি আসন, যোগাযোগ ও মানচিত্র দেখুন।
                    </p>
                </a>
            </div>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Demo Safety Notice (ডেমো নিরাপত্তা বার্তা):</strong>
                This system is currently for demonstration. Do not use it as real emergency information unless verified by authority.
                <br>
                এই সিস্টেম বর্তমানে ডেমোর জন্য। কর্তৃপক্ষ দ্বারা যাচাই না হলে এটি বাস্তব জরুরি তথ্য হিসেবে ব্যবহার করবেন না।
            </div>
        </div>
    </div>
</x-app-layout>