<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Safety Guides - CrisisLens</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(0,106,78,0.08), transparent 32%),
                radial-gradient(circle at bottom right, rgba(244,42,65,0.08), transparent 32%),
                #f8fafc;
            color: #172033;
        }

        a { text-decoration: none; }

        .container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 18px;
        }

        .nav {
            background: rgba(255,255,255,0.94);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
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
            transition: all 0.25s ease;
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

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(15,23,42,0.10);
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
        }

        .header h1 {
            margin: 16px 0 0;
            font-size: 38px;
        }

        .header p {
            margin-top: 12px;
            color: #64748b;
            line-height: 1.8;
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
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 18px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(15,23,42,0.08);
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: #99f6e4;
            box-shadow: 0 18px 36px rgba(15,23,42,0.10);
        }

        .pill {
            display: inline-block;
            background: #f1f5f9;
            color: #334155;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 900;
        }

        .card h2 {
            margin: 14px 0 0;
            font-size: 21px;
            color: #172033;
        }

        .preview {
            margin-top: 12px;
            color: #64748b;
            line-height: 1.7;
            font-size: 14px;
        }

        .footer {
            background: #0f172a;
            color: white;
            padding: 28px 0;
            margin-top: 44px;
        }

        .footer p {
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.7;
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="container nav-inner">
            <a href="{{ url('/') }}" class="brand">
                <span style="color:#006A4E;">Crisis</span><span style="color:#F42A41;">Lens</span>
            </a>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a href="{{ url('/') }}" class="btn btn-secondary">Home (হোম)</a>
                <a href="{{ route('public.alerts.index') }}" class="btn btn-secondary">Alerts (সতর্কতা)</a>
                <a href="{{ route('public.shelters.index') }}" class="btn btn-secondary">Shelters (আশ্রয়কেন্দ্র)</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endauth
            </div>
        </div>
    </div>

    <main class="container">
        <div class="header">
            <span class="badge">Emergency Knowledge Center (জরুরি জ্ঞানকেন্দ্র)</span>

            <h1>Safety Guides (নিরাপত্তা গাইড)</h1>

            <p>
                Read verified emergency safety instructions for flood, cyclone, first aid, evacuation, and shelters.
                <br>
                বন্যা, ঘূর্ণিঝড়, প্রাথমিক চিকিৎসা, সরিয়ে নেওয়া এবং আশ্রয়কেন্দ্র সম্পর্কিত যাচাইকৃত নিরাপত্তা নির্দেশিকা পড়ুন।
            </p>
        </div>

        <div class="notice">
            <strong>Safety Notice:</strong>
            These guides are for awareness and preparation. During emergencies, follow official authority instructions.
            <br>
            এই গাইডগুলো সচেতনতা ও প্রস্তুতির জন্য। জরুরি অবস্থায় সরকারি কর্তৃপক্ষের নির্দেশনা অনুসরণ করুন।
        </div>

        @if ($documents->count())
            <div class="grid">
                @foreach ($documents as $document)
                    <article class="card">
                        <span class="pill">
                            {{ ucfirst(str_replace('_', ' ', $document->category)) }}
                        </span>

                        <h2>{{ $document->title }}</h2>

                        <div class="preview">
                            {{ \Illuminate\Support\Str::limit(strip_tags($document->content), 160) }}
                        </div>

                        <div style="margin-top:18px;">
                            <a href="{{ route('public.safety-guides.show', $document) }}" class="btn btn-primary">
                                Read Guide (গাইড পড়ুন)
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div style="margin:24px 0;">
                {{ $documents->links() }}
            </div>
        @else
            <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:42px 24px; text-align:center;">
                <h2>No safety guides available (কোনো নিরাপত্তা গাইড নেই)</h2>
                <p style="color:#64748b;">
                    Verified safety guides will appear here.
                </p>
            </div>
        @endif
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