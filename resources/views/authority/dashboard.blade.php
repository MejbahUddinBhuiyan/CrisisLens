<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px; font-weight:700; color:#172033;">
                Authority Administrator Dashboard (কর্তৃপক্ষ প্রশাসক ড্যাশবোর্ড)
            </h2>
            <p style="margin-top:6px; font-size:14px; color:#64748b;">
                Validate reports, manage shelters, and publish public alerts.
                <br>
                রিপোর্ট যাচাই করুন, আশ্রয়কেন্দ্র পরিচালনা করুন এবং জনসাধারণের সতর্কতা প্রকাশ করুন।
            </p>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 16px;">

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                <p style="font-size:14px; font-weight:700; color:#b45309;">
                    Authority Control Panel (কর্তৃপক্ষ নিয়ন্ত্রণ প্যানেল)
                </p>

                <h1 style="margin-top:8px; font-size:26px; font-weight:800; color:#172033;">
                    Report Validation & Alert Publishing
                    <br>
                    রিপোর্ট যাচাই ও সতর্কতা প্রকাশ
                </h1>

                <p style="margin-top:10px; color:#64748b; line-height:1.7;">
                    Use this dashboard to review citizen reports, compare AI predictions, manage shelters, and publish approved alerts.
                    <br>
                    নাগরিক রিপোর্ট পর্যালোচনা, AI পূর্বাভাস যাচাই, আশ্রয়কেন্দ্র পরিচালনা এবং অনুমোদিত সতর্কতা প্রকাশ করতে এই ড্যাশবোর্ড ব্যবহার করুন।
                </p>
            </div>

            <div style="margin-top:24px; display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
                <a href="{{ route('authority.reports.index') }}"
                   style="display:block; background:white; border:1px solid #e5e7eb; border-radius:14px; padding:22px; text-decoration:none; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                    <div style="width:44px; height:44px; border-radius:12px; background:#e0f2fe; color:#0369a1; display:flex; align-items:center; justify-content:center; font-weight:900;">
                        R
                    </div>

                    <h3 style="margin-top:16px; font-size:18px; font-weight:800; color:#172033;">
                        Review Reports (রিপোর্ট পর্যালোচনা)
                    </h3>

                    <p style="margin-top:8px; font-size:14px; color:#64748b; line-height:1.6;">
                        Review citizen reports, AI prediction, images, and validation status.
                        <br>
                        নাগরিক রিপোর্ট, AI পূর্বাভাস, ছবি এবং যাচাই অবস্থা পর্যালোচনা করুন।
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
                        Add shelters, update capacity, occupancy, facilities, and availability.
                        <br>
                        আশ্রয়কেন্দ্র যোগ করুন, ধারণক্ষমতা, অবস্থানকারী, সুবিধা এবং অবস্থা আপডেট করুন।
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
                        Create, publish, edit, and approve public disaster alerts.
                        <br>
                        জনসাধারণের দুর্যোগ সতর্কতা তৈরি, প্রকাশ, সম্পাদনা এবং অনুমোদন করুন।
                    </p>
                </a>
            </div>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Emergency Responsibility Notice (জরুরি দায়িত্ব সতর্কতা):</strong>
                Public alerts and verified information should only be published after authority review.
                <br>
                জনসাধারণের সতর্কতা এবং যাচাইকৃত তথ্য শুধুমাত্র কর্তৃপক্ষের পর্যালোচনার পর প্রকাশ করা উচিত।
            </div>
        </div>
    </div>
</x-app-layout>