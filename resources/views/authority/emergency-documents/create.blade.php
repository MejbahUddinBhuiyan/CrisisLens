<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px; font-weight:700; color:#172033;">
                Create Emergency Safety Guide (জরুরি নিরাপত্তা গাইড তৈরি)
            </h2>
            <p style="margin-top:6px; font-size:14px; color:#64748b;">
                Add public instructions for flood, cyclone, first aid, evacuation, and shelter rules.
            </p>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:900px; margin:0 auto; padding:0 16px;">

            @if ($errors->any())
                <div style="margin-bottom:24px; border:1px solid #fecaca; background:#fef2f2; color:#b91c1c; padding:16px; border-radius:12px;">
                    <strong>Please fix the following:</strong>
                    <ul style="margin-top:8px; padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li style="font-size:14px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('authority.emergency-documents.store') }}"
                  style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                @csrf

                @include('authority.emergency-documents.partials.form', [
                    'document' => null,
                    'buttonText' => 'Create Guide (গাইড তৈরি করুন)'
                ])
            </form>
        </div>
    </div>
</x-app-layout>