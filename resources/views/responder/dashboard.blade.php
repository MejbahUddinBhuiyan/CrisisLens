<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px; font-weight:700; color:#172033;">
                Emergency Responder Dashboard (জরুরি রেসপন্ডার ড্যাশবোর্ড)
            </h2>
            <p style="margin-top:6px; font-size:14px; color:#64748b;">
                View verified reports and update emergency response progress.
                <br>
                যাচাইকৃত রিপোর্ট দেখুন এবং জরুরি সাড়া দেওয়ার অগ্রগতি আপডেট করুন।
            </p>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 16px;">

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                <p style="font-size:14px; font-weight:700; color:#0369a1;">
                    Responder Operations Panel (রেসপন্ডার অপারেশন প্যানেল)
                </p>

                <h1 style="margin-top:8px; font-size:26px; font-weight:800; color:#172033;">
                    Field Response & Resolution Tracking
                    <br>
                    মাঠ পর্যায়ে সাড়া ও সমাধান ট্র্যাকিং
                </h1>

                <p style="margin-top:10px; color:#64748b; line-height:1.7;">
                    Use this dashboard to view verified citizen reports, check AI predictions, open map locations, and update response status.
                    <br>
                    যাচাইকৃত নাগরিক রিপোর্ট দেখতে, AI পূর্বাভাস যাচাই করতে, মানচিত্রে অবস্থান দেখতে এবং সাড়া দেওয়ার অবস্থা আপডেট করতে এই ড্যাশবোর্ড ব্যবহার করুন।
                </p>
            </div>
            <div style="margin-top:24px; display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px;">
    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Verified Reports (যাচাইকৃত রিপোর্ট)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#15803d;">{{ $stats['verified_reports'] ?? 0 }}</h3>
    </div>

    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Under Review (পর্যালোচনাধীন)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#0369a1;">{{ $stats['under_review_reports'] ?? 0 }}</h3>
    </div>

    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Resolved (সমাধান)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#374151;">{{ $stats['resolved_reports'] ?? 0 }}</h3>
    </div>

    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Active Shelters (সক্রিয় আশ্রয়কেন্দ্র)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#0F766E;">{{ $stats['active_shelters'] ?? 0 }}</h3>
    </div>

    <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:18px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
        <p style="margin:0; font-size:13px; font-weight:700; color:#64748b;">Active Alerts (সক্রিয় সতর্কতা)</p>
        <h3 style="margin:8px 0 0; font-size:28px; font-weight:900; color:#b91c1c;">{{ $stats['active_alerts'] ?? 0 }}</h3>
    </div>
</div>

            <div style="margin-top:24px; display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
                <a href="{{ route('responder.reports.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#e0f2fe; color:#0369a1; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        R
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Verified Reports (যাচাইকৃত রিপোর্ট)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        View reports verified by authority and update response progress.
                        <br>
                        কর্তৃপক্ষ যাচাই করা রিপোর্ট দেখুন এবং সাড়া দেওয়ার অগ্রগতি আপডেট করুন।
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
                        View active shelters, capacity, contact details, and map locations.
                        <br>
                        সক্রিয় আশ্রয়কেন্দ্র, ধারণক্ষমতা, যোগাযোগ এবং মানচিত্র দেখুন।
                    </p>
                </a>

                <a href="{{ route('citizen.alerts.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#fee2e2; color:#b91c1c; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        !
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Public Alerts (জনসাধারণের সতর্কতা)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        View active disaster alerts and public safety instructions.
                        <br>
                        সক্রিয় দুর্যোগ সতর্কতা ও জননিরাপত্তা নির্দেশনা দেখুন।
                    </p>
                </a>
            </div>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Responder Safety Notice (রেসপন্ডার নিরাপত্তা বার্তা):</strong>
                Field response should follow official emergency protocols and authority instructions.
                <br>
                মাঠ পর্যায়ে সাড়া দেওয়ার সময় সরকারি জরুরি প্রোটোকল এবং কর্তৃপক্ষের নির্দেশনা অনুসরণ করা উচিত।
            </div>
        </div>
    </div>
</x-app-layout>