<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Emergency Safety Guides (জরুরি নিরাপত্তা গাইড)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Create and manage public safety instructions for disasters.
                    <br>
                    দুর্যোগের জন্য জনসাধারণের নিরাপত্তা নির্দেশিকা তৈরি ও পরিচালনা করুন।
                </p>
            </div>

            <a href="{{ route('authority.emergency-documents.create') }}"
               style="display:inline-block; background:#0F766E; color:white; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                Create Guide (গাইড তৈরি করুন)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 16px;">

            @if (session('success'))
                <div style="margin-bottom:24px; border:1px solid #bbf7d0; background:#f0fdf4; color:#15803d; padding:16px; border-radius:12px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background:white; border:1px solid #e5e7eb; border-radius:14px; overflow:hidden; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                @if ($documents->count())
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Title</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Category</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Language</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Status</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Created</th>
                                    <th style="padding:14px 18px; text-align:left; font-size:12px; color:#64748b; text-transform:uppercase;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($documents as $document)
                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:16px 18px; font-size:14px; color:#172033; font-weight:800;">
                                            {{ $document->title }}
                                            <br>
                                            <span style="font-size:12px; color:#64748b;">
                                                By {{ $document->uploader?->name ?? 'Authority' }}
                                            </span>
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569;">
                                            {{ ucfirst(str_replace('_', ' ', $document->category)) }}
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569;">
                                            {{ $document->language }}
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            @if ($document->is_active && $document->is_verified)
                                                <span style="background:#dcfce7; color:#15803d; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:800;">
                                                    Public
                                                </span>
                                            @elseif ($document->is_active)
                                                <span style="background:#fef3c7; color:#b45309; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:800;">
                                                    Active but Unverified
                                                </span>
                                            @else
                                                <span style="background:#f3f4f6; color:#374151; padding:5px 10px; border-radius:999px; font-size:12px; font-weight:800;">
                                                    Hidden
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px; color:#475569;">
                                            {{ $document->created_at->format('M d, Y') }}
                                        </td>

                                        <td style="padding:16px 18px; font-size:14px;">
                                            <a href="{{ route('authority.emergency-documents.edit', $document) }}"
                                               style="display:inline-block; background:#0F766E; color:white; padding:8px 12px; border-radius:8px; font-size:13px; font-weight:800; text-decoration:none;">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="border-top:1px solid #e5e7eb; padding:16px 20px;">
                        {{ $documents->links() }}
                    </div>
                @else
                    <div style="padding:42px 24px; text-align:center;">
                        <h3 style="font-size:20px; font-weight:900; color:#172033;">
                            No safety guides yet (এখনও কোনো নিরাপত্তা গাইড নেই)
                        </h3>

                        <p style="margin-top:8px; color:#64748b;">
                            Create your first public emergency safety guide.
                        </p>

                        <a href="{{ route('authority.emergency-documents.create') }}"
                           style="display:inline-block; margin-top:20px; background:#0F766E; color:white; padding:11px 18px; border-radius:8px; font-size:14px; font-weight:800; text-decoration:none;">
                            Create First Guide
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>