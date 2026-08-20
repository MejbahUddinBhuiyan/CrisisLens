<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $emergencyDocument->title }} - CrisisLens</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #172033;
        }

        a { text-decoration: none; }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 18px;
        }

        .nav {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 0;
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
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 9px;
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

        .article {
            margin-top: 34px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 1px 3px rgba(15,23,42,0.08);
        }

        .pill {
            display: inline-block;
            background: #ccfbf1;
            color: #0F766E;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 900;
        }

        h1 {
            font-size: 36px;
            margin: 18px 0 0;
            line-height: 1.2;
        }

        .meta {
            margin-top: 12px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
        }

        .content {
            margin-top: 24px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 20px;
            white-space: pre-line;
            line-height: 1.9;
            color: #172033;
            font-size: 16px;
        }

        .footer {
            background: #0f172a;
            color: white;
            padding: 28px 0;
            margin-top: 44px;
        }

        .footer p {
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="container nav-inner">
            <a href="{{ url('/') }}" class="brand">
                <span style="color:#006A4E;">Crisis</span><span style="color:#F42A41;">Lens</span>
            </a>

            <div>
                <a href="{{ route('public.safety-guides.index') }}" class="btn btn-secondary">
                    All Guides (সব গাইড)
                </a>

                <a href="{{ route('public.alerts.index') }}" class="btn btn-primary">
                    Alerts (সতর্কতা)
                </a>
            </div>
        </div>
    </div>

    <main class="container">
        <article class="article">
            <span class="pill">
                {{ ucfirst(str_replace('_', ' ', $emergencyDocument->category)) }}
            </span>

            <h1>{{ $emergencyDocument->title }}</h1>

            <div class="meta">
                Language: {{ $emergencyDocument->language }}
                <br>
                Updated: {{ $emergencyDocument->updated_at->format('M d, Y h:i A') }}
            </div>

            <div class="content">
                {{ $emergencyDocument->content }}
            </div>
        </article>
    </main>

    <footer class="footer">
        <div class="container">
            <strong style="font-size:18px;">
                <span style="color:#22c55e;">Crisis</span><span style="color:#ef4444;">Lens</span>
            </strong>

            <p>
                © 2026 CrisisLens. All rights reserved.
                <br>
                Developed by <strong style="color:white;">Mejbah Uddin Bhuiyan</strong>
            </p>
        </div>
    </footer>
</body>
</html>