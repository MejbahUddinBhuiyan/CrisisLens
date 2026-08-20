<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Public Alerts - CrisisLens</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(0, 106, 78, 0.08), transparent 32%),
                radial-gradient(circle at bottom right, rgba(244, 42, 65, 0.08), transparent 32%),
                #f8fafc;
            color: #172033;
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 1080px;
            margin: 0 auto;
            padding: 0 18px;
        }

        .nav {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 10px rgba(15, 23, 42, 0.04);
        }

        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s ease;
        }

        .brand:hover {
            transform: scale(1.03);
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #006A4E;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            position: relative;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.15);
        }

        .brand-logo::after {
            content: "";
            width: 17px;
            height: 17px;
            border-radius: 999px;
            background: #F42A41;
            position: absolute;
            right: 7px;
            top: 12px;
        }

        .brand-logo span {
            position: relative;
            z-index: 2;
            font-size: 13px;
        }

        .brand-text {
            line-height: 1.05;
        }

        .brand-title {
            font-size: 21px;
            font-weight: 900;
            letter-spacing: -0.6px;
        }

        .brand-subtitle {
            margin-top: 3px;
            font-size: 11px;
            color: #64748b;
            font-weight: 700;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
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

        .header {
            padding: 46px 0 28px;
        }

        .badge {
            display: inline-block;
            background: #fee2e2;
            color: #b91c1c;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 900;
            transition: all 0.25s ease;
        }

        .badge:hover {
            background: #fecaca;
            transform: translateY(-2px);
        }

        .header h1 {
            margin: 16px 0 0;
            font-size: 38px;
            line-height: 1.15;
            color: #172033;
        }

        .header p {
            margin-top: 12px;
            color: #64748b;
            line-height: 1.8;
            font-size: 16px;
        }

        .notice {
            background: #fffbeb;
            border: 1px solid #fcd34d;
            color: #92400e;
            border-radius: 14px;
            padding: 16px;
            line-height: 1.7;
            margin-bottom: 24px;
            transition: all 0.25s ease;
        }

        .notice:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px rgba(245, 158, 11, 0.14);
        }

        .alert-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
            transition: all 0.25s ease;
        }

        .alert-card:hover {
            transform: translateY(-5px);
            border-color: #fecaca;
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.10);
        }

        .alert-top {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .alert-card h2 {
            margin: 0;
            font-size: 22px;
            color: #172033;
        }

        .pill {
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
            transition: all 0.22s ease;
        }

        .alert-card:hover .pill {
            transform: scale(1.05);
        }

        .safe {
            background: #dcfce7;
            color: #15803d;
        }

        .advisory {
            background: #fef3c7;
            color: #b45309;
        }

        .warning {
            background: #ffedd5;
            color: #c2410c;
        }

        .critical {
            background: #fee2e2;
            color: #b91c1c;
        }

        .message {
            margin-top: 16px;
            color: #172033;
            line-height: 1.8;
            font-size: 15px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px;
        }

        .meta {
            margin-top: 14px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        .empty {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 42px 24px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
        }

        .empty h2 {
            margin: 0;
            font-size: 24px;
            color: #172033;
        }

        .empty p {
            margin-top: 10px;
            color: #64748b;
            line-height: 1.7;
        }

        .footer {
            background: #0f172a;
            color: white;
            padding: 28px 0;
            margin-top: 44px;
        }

        .footer p {
            margin: 6px 0 0;
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.7;
        }

        @media (max-width: 720px) {
            .header h1 {
                font-size: 32px;
            }

            .nav-inner {
                align-items: flex-start;
                flex-direction: column;
            }

            .nav-actions {
                width: 100%;
            }

            .btn {
                text-align: center;
            }

            .alert-top {
                flex-direction: column;
            }

            .footer div[style*="text-align:right"] {
                text-align: left !important;
            }
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="container nav-inner">
            <a href="{{ url('/') }}" class="brand">
                <div class="brand-logo">
                    <span>CL</span>
                </div>

                <div class="brand-text">
                    <div class="brand-title">
                        <span style="color:#006A4E;">Crisis</span><span style="color:#F42A41;">Lens</span>
                    </div>
                    <div class="brand-subtitle">Disaster Intelligence Platform</div>
                </div>
            </a>

            <div class="nav-actions">
                <a href="{{ url('/') }}" class="btn btn-secondary">
                    Home (হোম)
                </a>

                <a href="{{ route('public.shelters.index') }}" class="btn btn-secondary">
                    Shelters (আশ্রয়কেন্দ্র)
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        Dashboard (ড্যাশবোর্ড)
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        Login (লগইন)
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <main class="container">
        <div class="header">
            <span class="badge">Official Public Notice Area (জনসাধারণের সতর্কতা এলাকা)</span>

            <h1>Public Alerts (জনসাধারণের সতর্কতা)</h1>

            <p>
                View active disaster alerts and safety instructions.
                <br>
                সক্রিয় দুর্যোগ সতর্কতা এবং নিরাপত্তা নির্দেশনা দেখুন।
            </p>
        </div>

        <div class="notice">
            <strong>Demo Safety Notice (ডেমো নিরাপত্তা বার্তা):</strong>
            These alerts are demonstration data unless confirmed by official authority.
            <br>
            এই সতর্কতাগুলো সরকারি কর্তৃপক্ষ দ্বারা নিশ্চিত না হওয়া পর্যন্ত ডেমো তথ্য হিসেবে বিবেচিত হবে।
        </div>

        @if ($alerts->count())
            @foreach ($alerts as $alert)
                @php
                    $riskClass = match($alert->risk_level) {
                        'Safe' => 'safe',
                        'Advisory' => 'advisory',
                        'Warning' => 'warning',
                        'Critical' => 'critical',
                        default => 'advisory',
                    };
                @endphp

                <article class="alert-card">
                    <div class="alert-top">
                        <div>
                            <h2>{{ $alert->title }}</h2>

                            <div class="meta">
                                Published (প্রকাশিত):
                                {{ $alert->published_at?->format('M d, Y h:i A') ?? 'N/A' }}
                            </div>
                        </div>

                        <span class="pill {{ $riskClass }}">
                            {{ \App\Support\BilingualLabel::alertRiskLevel($alert->risk_level) }}
                        </span>
                    </div>

                    <div class="message">
                        {{ $alert->message }}
                    </div>

                    <div class="meta">
                        Published by (প্রকাশ করেছেন): {{ $alert->publisher?->name ?? 'Authority' }}

                        @if ($alert->expires_at)
                            <br>
                            Expires At (মেয়াদ শেষ):
                            {{ $alert->expires_at->format('M d, Y h:i A') }}
                        @endif
                    </div>
                </article>
            @endforeach

            <div style="margin: 24px 0;">
                {{ $alerts->links() }}
            </div>
        @else
            <div class="empty">
                <h2>No active alerts (কোনো সক্রিয় সতর্কতা নেই)</h2>
                <p>
                    Published disaster alerts will appear here.
                    <br>
                    প্রকাশিত দুর্যোগ সতর্কতা এখানে দেখা যাবে।
                </p>

                <div style="margin-top:20px;">
                    <a href="{{ route('public.shelters.index') }}" class="btn btn-primary">
                        View Shelters (আশ্রয়কেন্দ্র দেখুন)
                    </a>
                </div>
            </div>
        @endif
    </main>

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