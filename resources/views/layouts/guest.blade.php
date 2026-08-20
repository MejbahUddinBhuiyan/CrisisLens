<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CrisisLens - Disaster Intelligence Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
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

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
