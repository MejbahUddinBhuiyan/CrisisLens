<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Public Shelters - CrisisLens</title>
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
            max-width: 1180px;
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

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(330px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-6px);
            border-color: #99f6e4;
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.10);
        }

        .top {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: flex-start;
        }

        .card h2 {
            margin: 0;
            font-size: 21px;
            color: #172033;
        }

        .address {
            margin-top: 8px;
            color: #64748b;
            line-height: 1.7;
            font-size: 14px;
        }

        .pill {
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
            transition: all 0.22s ease;
        }

        .card:hover .pill {
            transform: scale(1.05);
        }

        .available {
            background: #dcfce7;
            color: #15803d;
        }

        .limited {
            background: #fef3c7;
            color: #b45309;
        }

        .full {
            background: #fee2e2;
            color: #b91c1c;
        }

        .closed {
            background: #f3f4f6;
            color: #374151;
        }

        .stats {
            margin-top: 18px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .stat {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px;
            transition: all 0.22s ease;
        }

        .card:hover .stat {
            border-color: #d1fae5;
        }

        .stat-label {
            font-size: 12px;
            color: #64748b;
            font-weight: 800;
        }

        .stat-value {
            margin-top: 4px;
            font-size: 21px;
            font-weight: 900;
            color: #172033;
        }

        .capacity-bar {
            margin-top: 14px;
            height: 10px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
        }

        .capacity-fill {
            height: 100%;
            background: linear-gradient(90deg, #0F766E, #22c55e);
            border-radius: 999px;
        }

        .section-title {
            margin-top: 18px;
            font-size: 14px;
            font-weight: 900;
            color: #172033;
        }

        .facilities {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .facility {
            background: #f1f5f9;
            color: #334155;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            transition: all 0.22s ease;
        }

        .facility:hover {
            background: #ccfbf1;
            color: #006A4E;
            transform: translateY(-1px);
        }

        .contact {
            margin-top: 8px;
            color: #475569;
            line-height: 1.7;
            font-size: 14px;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
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

            .stats {
                grid-template-columns: 1fr;
            }

            .top {
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

                <a href="{{ route('public.alerts.index') }}" class="btn btn-secondary">
                    Alerts (সতর্কতা)
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
            <span class="badge">Public Shelter Support (জনসাধারণের আশ্রয় সহায়তা)</span>

            <h1>Shelter Directory (আশ্রয়কেন্দ্র তালিকা)</h1>

            <p>
                Find active shelters, available capacity, contact details, facilities, and map locations.
                <br>
                সক্রিয় আশ্রয়কেন্দ্র, খালি আসন, যোগাযোগ, সুবিধা এবং মানচিত্রে অবস্থান দেখুন।
            </p>
        </div>

        <div class="notice">
            <strong>Demo Safety Notice (ডেমো নিরাপত্তা বার্তা):</strong>
            Shelter information is demonstration data unless verified by official authority.
            <br>
            আশ্রয়কেন্দ্রের তথ্য সরকারি কর্তৃপক্ষ দ্বারা যাচাই না হওয়া পর্যন্ত ডেমো তথ্য হিসেবে বিবেচিত হবে।
        </div>

        @if ($shelters->count())
            <div class="grid">
                @foreach ($shelters as $shelter)
                    @php
                        $latestStatus = $shelter->statuses->first();
                        $statusValue = $latestStatus?->status ?? 'available';
                        $availableCapacity = max(0, $shelter->capacity - $shelter->current_occupancy);
                        $facilities = $shelter->facilities ?? [];
                        $mapsUrl = 'https://www.google.com/maps?q=' . $shelter->latitude . ',' . $shelter->longitude;
                        $capacity = max(1, (int) $shelter->capacity);
                        $occupied = min($capacity, max(0, (int) $shelter->current_occupancy));
                        $occupancyPercent = round(($occupied / $capacity) * 100);
                    @endphp

                    <article class="card">
                        <div class="top">
                            <div>
                                <h2>{{ $shelter->name }}</h2>
                                <div class="address">{{ $shelter->address }}</div>
                            </div>

                            <span class="pill {{ $statusValue }}">
                                {{ \App\Support\BilingualLabel::shelterStatus($statusValue) }}
                            </span>
                        </div>

                        <div class="stats">
                            <div class="stat">
                                <div class="stat-label">Capacity (ধারণক্ষমতা)</div>
                                <div class="stat-value">{{ $shelter->capacity }}</div>
                            </div>

                            <div class="stat">
                                <div class="stat-label">Occupied (বর্তমান)</div>
                                <div class="stat-value">{{ $shelter->current_occupancy }}</div>
                            </div>

                            <div class="stat">
                                <div class="stat-label">Available (খালি)</div>
                                <div class="stat-value" style="color:#0F766E;">{{ $availableCapacity }}</div>
                            </div>
                        </div>

                        <div class="capacity-bar" title="Occupancy {{ $occupancyPercent }}%">
                            <div class="capacity-fill" style="width: {{ $occupancyPercent }}%;"></div>
                        </div>

                        <div class="contact" style="font-size:13px; color:#64748b;">
                            Occupancy (ভর্তি): {{ $occupancyPercent }}%
                        </div>

                        <div class="section-title">Contact Information (যোগাযোগের তথ্য)</div>

                        <div class="contact">
                            @if ($shelter->contact_phone)
                                Phone (ফোন): {{ $shelter->contact_phone }} <br>
                            @endif

                            @if ($shelter->contact_email)
                                Email (ইমেইল): {{ $shelter->contact_email }}
                            @endif

                            @if (! $shelter->contact_phone && ! $shelter->contact_email)
                                No contact added (যোগাযোগের তথ্য নেই)
                            @endif
                        </div>

                        <div class="section-title">Facilities (সুবিধাসমূহ)</div>

                        @if (count($facilities))
                            <div class="facilities">
                                @foreach ($facilities as $facility)
                                    <span class="facility">
                                        {{ \App\Support\BilingualLabel::facility($facility) }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <div class="contact">
                                No facilities listed (কোনো সুবিধা তালিকাভুক্ত নেই)
                            </div>
                        @endif

                        <div class="actions">
                            <a href="{{ $mapsUrl }}" target="_blank" class="btn btn-primary">
                                View on Map (মানচিত্রে দেখুন)
                            </a>

                            @if ($shelter->contact_phone)
                                <a href="tel:{{ $shelter->contact_phone }}" class="btn btn-secondary">
                                    Call (কল করুন)
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            <div style="margin: 24px 0;">
                {{ $shelters->links() }}
            </div>
        @else
            <div class="empty">
                <h2>No active shelters available (সক্রিয় আশ্রয়কেন্দ্র নেই)</h2>
                <p>
                    Active shelters will appear here when authority adds them.
                    <br>
                    কর্তৃপক্ষ সক্রিয় আশ্রয়কেন্দ্র যোগ করলে এখানে দেখা যাবে।
                </p>

                <div style="margin-top:20px;">
                    <a href="{{ route('public.alerts.index') }}" class="btn btn-primary">
                        View Alerts (সতর্কতা দেখুন)
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