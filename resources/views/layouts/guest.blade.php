<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CrisisLens - Disaster Intelligence Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background:
                    radial-gradient(circle at top left, rgba(0, 106, 78, 0.12), transparent 32%),
                    radial-gradient(circle at bottom right, rgba(244, 42, 65, 0.10), transparent 32%),
                    #f8fafc;
            }

            .guest-topbar {
                width: 100%;
                background: white;
                border-bottom: 1px solid #e5e7eb;
                padding: 14px 0;
            }

            .guest-topbar-inner {
                max-width: 1100px;
                margin: 0 auto;
                padding: 0 18px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
                flex-wrap: wrap;
            }

            .guest-brand {
                display: flex;
                align-items: center;
                gap: 10px;
                text-decoration: none;
            }

            .guest-brand-icon {
                width: 38px;
                height: 38px;
                border-radius: 11px;
                background: #006A4E;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 13px;
                font-weight: 900;
                position: relative;
                box-shadow: 0 2px 8px rgba(15,23,42,0.15);
            }

            .guest-brand-icon::after {
                content: "";
                width: 15px;
                height: 15px;
                border-radius: 999px;
                background: #F42A41;
                position: absolute;
                right: 7px;
                top: 11px;
            }

            .guest-brand-icon span {
                position: relative;
                z-index: 2;
            }

            .guest-brand-title {
                font-size: 19px;
                font-weight: 900;
                letter-spacing: -0.6px;
            }

            .guest-brand-subtitle {
                margin-top: 2px;
                font-size: 11px;
                color: #64748b;
                font-weight: 700;
            }

            .guest-nav-links {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                align-items: center;
            }

            .guest-nav-link {
                display: inline-block;
                padding: 9px 13px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 800;
                text-decoration: none;
                color: #172033;
                background: white;
                border: 1px solid #cbd5e1;
            }

            .guest-nav-link.primary {
                background: #006A4E;
                color: white;
                border-color: #006A4E;
            }

            .guest-auth-card {
                background: white;
                border: 1px solid #e5e7eb;
                box-shadow: 0 18px 40px rgba(15,23,42,0.08);
            }

            .guest-help-links {
                margin-top: 18px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 10px;
            }

            .guest-help-links a {
                font-size: 13px;
                font-weight: 800;
                color: #006A4E;
                text-decoration: none;
            }

            @media (max-width: 640px) {
                .guest-topbar-inner {
                    align-items: flex-start;
                    flex-direction: column;
                }

                .guest-nav-links {
                    width: 100%;
                }

                .guest-nav-link {
                    flex: 1;
                    text-align: center;
                }
            }
        </style>
    </head>

    <body class="font-sans text-gray-900 antialiased">
        <div class="guest-topbar">
            <div class="guest-topbar-inner">
                <a href="{{ url('/') }}" class="guest-brand">
                    <div class="guest-brand-icon">
                        <span>CL</span>
                    </div>

                    <div>
                        <div class="guest-brand-title">
                            <span style="color:#006A4E;">Crisis</span><span style="color:#F42A41;">Lens</span>
                        </div>

                        <div class="guest-brand-subtitle">
                            Disaster Intelligence Platform
                        </div>
                    </div>
                </a>

                <div class="guest-nav-links">
                    <a href="{{ url('/') }}" class="guest-nav-link">
                        Home (হোম)
                    </a>

                    <a href="{{ route('public.alerts.index') }}" class="guest-nav-link">
                        Alerts (সতর্কতা)
                    </a>

                    <a href="{{ route('public.shelters.index') }}" class="guest-nav-link">
                        Shelters (আশ্রয়কেন্দ্র)
                    </a>

                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="guest-nav-link primary">
                            Login (লগইন)
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div style="text-align:center; margin-bottom:18px;">
                <a href="/" style="display:flex; justify-content:center; text-decoration:none;">
                    <x-application-logo />
                </a>

                <div style="text-align:center; margin-top:16px; margin-bottom:8px;">
                    <h1 style="font-size:22px; font-weight:900; color:#172033; margin:0;">
                        Welcome to CrisisLens
                    </h1>

                    <p style="font-size:14px; color:#64748b; margin-top:6px; line-height:1.6;">
                        Disaster Intelligence Platform for Bangladesh
                        <br>
                        বাংলাদেশের জন্য দুর্যোগ বুদ্ধিমত্তা প্ল্যাটফর্ম
                    </p>
                </div>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-6 py-4 overflow-hidden sm:rounded-lg guest-auth-card">
                {{ $slot }}
            </div>

            <div class="guest-help-links">
                <a href="{{ url('/') }}">
                    Back to Home (হোমে ফিরুন)
                </a>

                <span style="color:#cbd5e1;">|</span>

                <a href="{{ route('public.alerts.index') }}">
                    Public Alerts (সতর্কতা)
                </a>

                <span style="color:#cbd5e1;">|</span>

                <a href="{{ route('public.shelters.index') }}">
                    Shelter Directory (আশ্রয়কেন্দ্র)
                </a>
            </div>

            <p style="margin-top:18px; margin-bottom:28px; text-align:center; font-size:12px; color:#64748b; line-height:1.6;">
                Public alerts and shelters do not require login.
                <br>
                জনসাধারণের সতর্কতা ও আশ্রয়কেন্দ্র দেখতে লগইন প্রয়োজন নেই।
            </p>
        </div>
    </body>
</html>