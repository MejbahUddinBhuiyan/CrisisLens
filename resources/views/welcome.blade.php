<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CrisisLens - Disaster Intelligence Platform</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #172033;
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 18px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 10px rgba(15, 23, 42, 0.04);
        }

        .navbar-inner {
            height: 72px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.25s ease;
        }

        .brand:hover {
            transform: scale(1.03);
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            background: #0F766E;
            color: white;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            font-size: 18px;
            transition: all 0.25s ease;
        }

        .brand:hover .brand-logo {
            box-shadow: 0 8px 22px rgba(0, 106, 78, 0.25);
        }

        .brand-title {
            font-size: 20px;
            font-weight: 900;
            color: #172033;
        }

        .brand-subtitle {
            font-size: 12px;
            color: #64748b;
            margin-top: 2px;
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 800;
            border: 1px solid transparent;
            transition: all 0.25s ease;
        }

        .btn-primary {
            background: #0F766E;
            color: white;
        }

        .btn-primary:hover {
            background: #006A4E;
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(0, 106, 78, 0.22);
        }

        .btn-secondary {
            background: white;
            color: #172033;
            border-color: #cbd5e1;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #006A4E;
            color: #006A4E;
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(220, 38, 38, 0.22);
        }

        .hero {
            padding: 72px 0 52px;
            overflow: hidden;
            background:
                radial-gradient(circle at top left, rgba(15, 118, 110, 0.12), transparent 35%),
                radial-gradient(circle at bottom right, rgba(220, 38, 38, 0.10), transparent 35%),
                #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 36px;
            align-items: center;
        }

        .badge {
            display: inline-block;
            background: #ccfbf1;
            color: #0F766E;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 900;
            transition: all 0.25s ease;
        }

        .badge:hover {
            background: #99f6e4;
            transform: translateY(-2px);
        }

        .hero h1 {
            margin: 18px 0 0;
            font-size: 46px;
            line-height: 1.12;
            color: #172033;
        }

        .hero p {
            margin-top: 18px;
            font-size: 17px;
            line-height: 1.8;
            color: #475569;
        }

        .hero-actions {
            margin-top: 26px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            transition: all 0.25s ease;
        }

        .hero-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.12);
            border-color: #99f6e4;
        }

        .risk-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            padding: 14px 8px;
            border-bottom: 1px solid #e5e7eb;
            border-radius: 10px;
            transition: all 0.22s ease;
        }

        .risk-row:hover {
            background: #f8fafc;
            transform: translateX(4px);
        }

        .risk-row:last-child {
            border-bottom: none;
        }

        .risk-title {
            font-weight: 900;
            color: #172033;
        }

        .risk-text {
            margin-top: 4px;
            font-size: 13px;
            color: #64748b;
        }

        .risk-pill {
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 900;
            white-space: nowrap;
            transition: all 0.22s ease;
        }

        .risk-row:hover .risk-pill {
            transform: scale(1.05);
        }

        .pill-warning {
            background: #ffedd5;
            color: #c2410c;
        }

        .pill-safe {
            background: #dcfce7;
            color: #15803d;
        }

        .pill-critical {
            background: #fee2e2;
            color: #b91c1c;
        }

        .section {
            padding: 58px 0;
        }

        .section-title {
            text-align: center;
            max-width: 760px;
            margin: 0 auto 32px;
        }

        .section-title h2 {
            margin: 0;
            font-size: 32px;
            color: #172033;
        }

        .section-title p {
            margin-top: 12px;
            color: #64748b;
            line-height: 1.7;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-6px);
            border-color: #99f6e4;
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.10);
        }

        .icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            margin-bottom: 16px;
            transition: all 0.25s ease;
        }

        .card:hover .icon {
            transform: scale(1.08) rotate(-2deg);
        }

        .icon-teal {
            background: #ccfbf1;
            color: #0F766E;
        }

        .icon-red {
            background: #fee2e2;
            color: #b91c1c;
        }

        .icon-blue {
            background: #e0f2fe;
            color: #0369a1;
        }

        .icon-green {
            background: #dcfce7;
            color: #15803d;
        }

        .card h3 {
            margin: 0;
            font-size: 18px;
            color: #172033;
        }

        .card p {
            margin-top: 10px;
            color: #64748b;
            line-height: 1.7;
            font-size: 14px;
        }

        .guide {
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
        }

        .guide-list {
            margin: 14px 0 0;
            padding-left: 18px;
            color: #475569;
            line-height: 1.9;
            font-size: 14px;
        }

        .notice {
            background: #fffbeb;
            border: 1px solid #fcd34d;
            color: #92400e;
            border-radius: 14px;
            padding: 18px;
            line-height: 1.7;
            transition: all 0.25s ease;
        }

        .notice:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px rgba(245, 158, 11, 0.14);
        }

        .footer {
            background: #0f172a;
            color: white;
            padding: 28px 0;
            margin-top: 20px;
        }

        .footer p {
            margin: 6px 0 0;
            color: #cbd5e1;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .hero-grid,
            .grid-3,
            .grid-4 {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 34px;
            }

            .navbar-inner {
                height: auto;
                padding: 14px 0;
                align-items: flex-start;
                flex-direction: column;
            }

            .nav-actions {
                justify-content: flex-start;
            }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="container navbar-inner">
            <div class="brand">
                <div class="brand-logo">CL</div>
                <div>
                    <div class="brand-title">
                        <span style="color:#006A4E;">Crisis</span><span style="color:#F42A41;">Lens</span>
                    </div>
                    <div class="brand-subtitle">Disaster Intelligence Platform</div>
                </div>
            </div>

            <div class="nav-actions">
                <a href="#guide" class="btn btn-secondary">User Guide (ব্যবহার নির্দেশিকা)</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        Dashboard (ড্যাশবোর্ড)
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">
                        Login (লগইন)
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-primary">
                        Register (রেজিস্টার)
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container hero-grid">
            <div>
                <span class="badge">AI Assisted Disaster Response (AI সহায়তাপ্রাপ্ত দুর্যোগ সাড়া)</span>

                <h1>
                    CrisisLens helps citizens, authorities, and responders act faster during disasters.
                    <br>
                    CrisisLens দুর্যোগের সময় দ্রুত সিদ্ধান্ত নিতে সাহায্য করে।
                </h1>

                <p>
                    CrisisLens is a bilingual emergency platform for reporting incidents, viewing public alerts,
                    finding shelters, and supporting authority-based disaster response.
                    <br>
                    CrisisLens হলো একটি দ্বিভাষিক জরুরি প্ল্যাটফর্ম যেখানে নাগরিক রিপোর্ট জমা দিতে পারে,
                    সতর্কতা দেখতে পারে, আশ্রয়কেন্দ্র খুঁজতে পারে এবং কর্তৃপক্ষ দ্রুত ব্যবস্থা নিতে পারে।
                </p>

                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn btn-danger">
                        Submit Incident Report (ঘটনার রিপোর্ট জমা দিন)
                    </a>

                    <a href="{{ route('public.alerts.index') }}" class="btn btn-primary">
                        Public Alerts (জনসাধারণের সতর্কতা)
                    </a>

                    <a href="{{ route('public.shelters.index') }}" class="btn btn-secondary">
                        Shelter Directory (আশ্রয়কেন্দ্র তালিকা)
                    </a>
                </div>

                <p style="font-size:14px; margin-top:14px; color:#64748b;">
                    To submit and track reports, citizens need an account.
                    <br>
                    রিপোর্ট জমা দিতে এবং নিজের রিপোর্ট ট্র্যাক করতে নাগরিকের অ্যাকাউন্ট প্রয়োজন।
                </p>
            </div>

            <div class="hero-card">
                <h3 style="margin:0; font-size:20px; color:#172033;">
                    CrisisLens Workflow (CrisisLens কার্যপ্রবাহ)
                </h3>

                <div style="margin-top:16px;">
                    <div class="risk-row">
                        <div>
                            <div class="risk-title">Citizen Report (নাগরিক রিপোর্ট)</div>
                            <div class="risk-text">Citizen submits incident details and images.</div>
                        </div>
                        <span class="risk-pill pill-warning">Report</span>
                    </div>

                    <div class="risk-row">
                        <div>
                            <div class="risk-title">AI Prediction (AI পূর্বাভাস)</div>
                            <div class="risk-text">System gives a demo flood-risk prediction.</div>
                        </div>
                        <span class="risk-pill pill-critical">AI</span>
                    </div>

                    <div class="risk-row">
                        <div>
                            <div class="risk-title">Authority Review (কর্তৃপক্ষ যাচাই)</div>
                            <div class="risk-text">Authority approves or rejects reports.</div>
                        </div>
                        <span class="risk-pill pill-safe">Verify</span>
                    </div>

                    <div class="risk-row">
                        <div>
                            <div class="risk-title">Responder Action (রেসপন্ডার সাড়া)</div>
                            <div class="risk-text">Responder marks reports under review or resolved.</div>
                        </div>
                        <span class="risk-pill pill-warning">Resolve</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>What CrisisLens Provides (CrisisLens কী সুবিধা দেয়)</h2>
                <p>
                    A complete disaster-response cycle from citizen reporting to authority verification and responder action.
                    <br>
                    নাগরিক রিপোর্ট থেকে কর্তৃপক্ষ যাচাই এবং রেসপন্ডার সাড়া পর্যন্ত সম্পূর্ণ দুর্যোগ ব্যবস্থাপনা প্রক্রিয়া।
                </p>
            </div>

            <div class="grid-4">
                <div class="card">
                    <div class="icon icon-teal">R</div>
                    <h3>Incident Reports (ঘটনার রিপোর্ট)</h3>
                    <p>
                        Citizens can submit reports with category, urgency, location, description, and images.
                        <br>
                        নাগরিকরা ধরন, জরুরিতা, অবস্থান, বিবরণ ও ছবি সহ রিপোর্ট জমা দিতে পারে।
                    </p>
                </div>

                <div class="card">
                    <div class="icon icon-red">AI</div>
                    <h3>AI Risk Prediction (AI ঝুঁকি পূর্বাভাস)</h3>
                    <p>
                        AI service provides demo flood-risk prediction and confidence score.
                        <br>
                        AI সার্ভিস ডেমো বন্যা ঝুঁকি পূর্বাভাস এবং আস্থা স্কোর দেয়।
                    </p>
                </div>

                <div class="card">
                    <div class="icon icon-green">S</div>
                    <h3>Shelter Directory (আশ্রয়কেন্দ্র তালিকা)</h3>
                    <p>
                        Users can see active shelters, available capacity, contact, facilities, and map location.
                        <br>
                        ব্যবহারকারীরা সক্রিয় আশ্রয়কেন্দ্র, খালি আসন, যোগাযোগ, সুবিধা ও মানচিত্র দেখতে পারে।
                    </p>
                </div>

                <div class="card">
                    <div class="icon icon-blue">!</div>
                    <h3>Public Alerts (জনসাধারণের সতর্কতা)</h3>
                    <p>
                        Citizens can view published and approved public disaster alerts.
                        <br>
                        নাগরিকরা প্রকাশিত ও অনুমোদিত দুর্যোগ সতর্কতা দেখতে পারে।
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="guide" class="section guide">
        <div class="container">
            <div class="section-title">
                <h2>User Guide (ব্যবহার নির্দেশিকা)</h2>
                <p>
                    Learn how each user type should use CrisisLens.
                    <br>
                    CrisisLens-এ কোন ব্যবহারকারী কীভাবে কাজ করবে তা জানুন।
                </p>
            </div>

            <div class="grid-3">
                <div class="card">
                    <div class="icon icon-teal">C</div>
                    <h3>Citizen Guide (নাগরিক নির্দেশিকা)</h3>
                    <ul class="guide-list">
                        <li>View public alerts without login. / লগইন ছাড়াই সতর্কতা দেখুন।</li>
                        <li>View shelter directory without login. / লগইন ছাড়াই আশ্রয়কেন্দ্র দেখুন।</li>
                        <li>Create account to submit report. / রিপোর্ট জমা দিতে অ্যাকাউন্ট তৈরি করুন।</li>
                        <li>Track own report and AI status after login. / লগইনের পর নিজের রিপোর্ট ও AI অবস্থা দেখুন।</li>
                    </ul>
                </div>

                <div class="card">
                    <div class="icon icon-red">A</div>
                    <h3>Authority Guide (কর্তৃপক্ষ নির্দেশিকা)</h3>
                    <ul class="guide-list">
                        <li>Review citizen reports. / নাগরিক রিপোর্ট পর্যালোচনা করুন।</li>
                        <li>Approve or reject reports. / রিপোর্ট অনুমোদন বা বাতিল করুন।</li>
                        <li>Manage shelters and capacity. / আশ্রয়কেন্দ্র ও ধারণক্ষমতা পরিচালনা করুন।</li>
                        <li>Publish public alerts. / জনসাধারণের সতর্কতা প্রকাশ করুন।</li>
                    </ul>
                </div>

                <div class="card">
                    <div class="icon icon-blue">E</div>
                    <h3>Responder Guide (রেসপন্ডার নির্দেশিকা)</h3>
                    <ul class="guide-list">
                        <li>View verified reports. / যাচাইকৃত রিপোর্ট দেখুন।</li>
                        <li>Open location on map. / মানচিত্রে অবস্থান দেখুন।</li>
                        <li>Mark report under review. / রিপোর্ট পর্যালোচনাধীন করুন।</li>
                        <li>Mark report resolved. / রিপোর্ট সমাধান হয়েছে হিসেবে চিহ্নিত করুন।</li>
                    </ul>
                </div>
            </div>

            <div style="margin-top:24px;" class="notice">
                <strong>Account Rule (অ্যাকাউন্ট নিয়ম):</strong>
                Public alerts and shelter directory are open for everyone. But incident report submission and AI prediction tracking need citizen login.
                <br>
                জনসাধারণের সতর্কতা এবং আশ্রয়কেন্দ্র তালিকা সবার জন্য উন্মুক্ত। কিন্তু ঘটনার রিপোর্ট জমা দেওয়া এবং AI পূর্বাভাস ট্র্যাক করার জন্য নাগরিক লগইন প্রয়োজন।
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Quick Access (দ্রুত প্রবেশ)</h2>
                <p>
                    Choose what you want to do now.
                    <br>
                    আপনি এখন কী করতে চান তা নির্বাচন করুন।
                </p>
            </div>

            <div class="grid-3">
                <div class="card">
                    <div class="icon icon-red">!</div>
                    <h3>View Public Alerts (সতর্কতা দেখুন)</h3>
                    <p>See active disaster alerts and safety instructions.</p>
                    <a href="{{ route('public.alerts.index') }}" class="btn btn-primary">
                        Open Alerts (সতর্কতা খুলুন)
                    </a>
                </div>

                <div class="card">
                    <div class="icon icon-green">S</div>
                    <h3>Find Shelters (আশ্রয়কেন্দ্র খুঁজুন)</h3>
                    <p>Check shelter location, capacity, facilities, and contact details.</p>
                    <a href="{{ route('public.shelters.index') }}" class="btn btn-primary">
                        Open Shelters (আশ্রয়কেন্দ্র খুলুন)
                    </a>
                </div>

                <div class="card">
                    <div class="icon icon-teal">+</div>
                    <h3>Submit Report (রিপোর্ট জমা দিন)</h3>
                    <p>Create an account or login to submit and track your incident report.</p>

                    @auth
                        <a href="{{ route('citizen.reports.create') }}" class="btn btn-danger">
                            Submit Report (রিপোর্ট জমা দিন)
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-danger">
                            Register to Report (রিপোর্টের জন্য রেজিস্টার)
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

<footer class="footer">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:18px; flex-wrap:wrap;">
            <div>
                <strong style="font-size:18px;">
                    <span style="color:#22c55e;">Crisis</span><span style="color:#ef4444;">Lens</span>
                </strong>

                <p>
                    AI-assisted disaster intelligence and emergency response platform.
                    <br>
                    AI সহায়তাপ্রাপ্ত দুর্যোগ বুদ্ধিমত্তা ও জরুরি সাড়া প্ল্যাটফর্ম।
                </p>
            </div>

            <div style="text-align:right;">
                <p style="margin:0; color:#cbd5e1; font-size:14px; line-height:1.7;">
                    © 2026 CrisisLens. All rights reserved.
                    <br>
                    Developed by <strong style="color:white;">Mejbah Uddin Bhuiyan</strong>
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>