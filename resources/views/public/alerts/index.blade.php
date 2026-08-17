<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Public Alerts - CrisisLens</title>
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
            max-width: 1050px;
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

        .alert-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
        }

        .alert-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .alert-card h2 {
            margin: 0;
            font-size: 21px;
            color: #172033;
        }

        .pill {
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
        }

        .safe { background: #dcfce7; color: #15803d; }
        .advisory { background: #fef3c7; color: #b45309; }
        .warning { background: #ffedd5; color: #c2410c; }
        .critical { background: #fee2e2; color: #b91c1c; }

        .message {
            margin-top: 16px;
            color: #172033;
            line-height: 1.8;
            font-size: 15px;
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
            border-radius: 14px;
            padding: 42px 24px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="container nav-inner">
            <a href="{{ url('/') }}" class="brand">CrisisLens</a>

            <div>
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
            </div>
        @endif
    </main>
</body>
</html>