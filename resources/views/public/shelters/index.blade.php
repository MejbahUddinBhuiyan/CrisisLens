<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Public Shelters - CrisisLens</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
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

        .nav {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 0;
        }

        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .brand {
            font-size: 22px;
            font-weight: 900;
            color: #0F766E;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 800;
        }

        .btn-primary {
            background: #0F766E;
            color: white;
        }

        .btn-secondary {
            background: white;
            color: #172033;
            border: 1px solid #cbd5e1;
        }

        .header {
            padding: 42px 0 26px;
        }

        .header h1 {
            margin: 0;
            font-size: 34px;
            color: #172033;
        }

        .header p {
            margin-top: 10px;
            color: #64748b;
            line-height: 1.7;
        }

        .notice {
            background: #fffbeb;
            border: 1px solid #fcd34d;
            color: #92400e;
            border-radius: 14px;
            padding: 16px;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
        }

        .top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: flex-start;
        }

        .card h2 {
            margin: 0;
            font-size: 20px;
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
        }

        .available { background: #dcfce7; color: #15803d; }
        .limited { background: #fef3c7; color: #b45309; }
        .full { background: #fee2e2; color: #b91c1c; }
        .closed { background: #f3f4f6; color: #374151; }

        .stats {
            margin-top: 18px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .stat {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
        }

        .stat-label {
            font-size: 12px;
            color: #64748b;
            font-weight: 800;
        }

        .stat-value {
            margin-top: 4px;
            font-size: 20px;
            font-weight: 900;
            color: #172033;
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
            border-radius: 14px;
            padding: 42px 24px;
            text-align: center;
        }

        @media (max-width: 520px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .top {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="container nav-inner">
            <a href="{{ url('/') }}" class="brand">CrisisLens</a>

            <div>
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
            </div>
        @endif
    </main>
</body>
</html>