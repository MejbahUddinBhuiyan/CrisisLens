<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;">
            <div>
                <h2 style="font-size: 22px; font-weight: 700; color: #172033;">
                    My Incident Reports
                </h2>
                <p style="margin-top: 6px; font-size: 14px; color: #64748b;">
                    Track your submitted reports and their review status.
                </p>
            </div>

            <a href="{{ route('citizen.reports.create') }}"
               style="display: inline-block; background: #0F766E; color: white; padding: 10px 16px; border-radius: 8px; font-size: 14px; font-weight: 700; text-decoration: none;">
                Submit New Report
            </a>
        </div>
    </x-slot>

    <div style="padding: 32px 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 16px;">
            @if (session('success'))
                <div style="margin-bottom: 24px; border: 1px solid #bbf7d0; background: #f0fdf4; color: #15803d; padding: 16px; border-radius: 12px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 14px; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08); overflow: hidden;">
                @if ($reports->count())
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead style="background: #f8fafc;">
                                <tr>
                                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">
                                        Category
                                    </th>

                                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">
                                        Urgency
                                    </th>

                                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">
                                        Status
                                    </th>

                                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">
                                        AI Prediction
                                    </th>

                                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">
                                        Location
                                    </th>

                                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">
                                        Images
                                    </th>

                                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">
                                        Submitted
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($reports as $report)
                                    <tr style="border-top: 1px solid #e5e7eb;">
                                        <td style="padding: 16px 20px; font-size: 14px; font-weight: 700; color: #172033;">
                                            {{ str_replace('_', ' ', ucfirst($report->category)) }}
                                        </td>

                                        <td style="padding: 16px 20px; font-size: 14px;">
                                            @php
                                                $urgencyStyle = match($report->urgency) {
                                                    'low' => 'background:#f3f4f6;color:#374151;',
                                                    'medium' => 'background:#e0f2fe;color:#0369a1;',
                                                    'high' => 'background:#fef3c7;color:#b45309;',
                                                    'critical' => 'background:#fee2e2;color:#b91c1c;',
                                                    default => 'background:#f3f4f6;color:#374151;',
                                                };
                                            @endphp

                                            <span style="{{ $urgencyStyle }} padding: 5px 10px; border-radius: 999px; font-size: 12px; font-weight: 700;">
                                                {{ ucfirst($report->urgency) }}
                                            </span>
                                        </td>

                                        <td style="padding: 16px 20px; font-size: 14px;">
                                            <span style="background: #fef3c7; color: #b45309; padding: 5px 10px; border-radius: 999px; font-size: 12px; font-weight: 700;">
                                                {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                            </span>
                                        </td>

                                        <td style="padding: 16px 20px; font-size: 14px;">
                                            @php
                                                $prediction = $report->predictions->first();
                                                $predictionLabel = $prediction?->prediction ?? 'Processing';

                                                $predictionStyle = match($predictionLabel) {
                                                    'Safe' => 'background:#dcfce7;color:#15803d;',
                                                    'Advisory' => 'background:#fef3c7;color:#b45309;',
                                                    'Warning' => 'background:#ffedd5;color:#c2410c;',
                                                    'Critical' => 'background:#fee2e2;color:#b91c1c;',
                                                    'Unavailable' => 'background:#f3f4f6;color:#374151;',
                                                    default => 'background:#e0f2fe;color:#0369a1;',
                                                };
                                            @endphp

                                            <div>
                                                <span style="{{ $predictionStyle }} padding: 5px 10px; border-radius: 999px; font-size: 12px; font-weight: 700;">
                                                    {{ $predictionLabel }}
                                                </span>

                                                @if ($prediction)
                                                    <p style="margin-top: 6px; font-size: 12px; color: #64748b;">
                                                        Confidence: {{ $prediction->confidence_score ?? 'N/A' }}
                                                    </p>
                                                @else
                                                    <p style="margin-top: 6px; font-size: 12px; color: #64748b;">
                                                        Waiting for AI job
                                                    </p>
                                                @endif
                                            </div>
                                        </td>

                                        <td style="padding: 16px 20px; font-size: 14px; color: #475569;">
                                            {{ $report->latitude }}, {{ $report->longitude }}
                                        </td>

                                        <td style="padding: 16px 20px; font-size: 14px; color: #475569;">
                                            {{ $report->images_count ?? $report->images->count() }}
                                        </td>

                                        <td style="padding: 16px 20px; font-size: 14px; color: #475569;">
                                            {{ $report->created_at->format('M d, Y h:i A') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="border-top: 1px solid #e5e7eb; padding: 16px 20px;">
                        {{ $reports->links() }}
                    </div>
                @else
                    <div style="padding: 40px 24px; text-align: center;">
                        <div style="width: 48px; height: 48px; margin: 0 auto; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #ccfbf1; color: #0F766E; font-size: 20px; font-weight: 800;">
                            !
                        </div>

                        <h3 style="margin-top: 18px; font-size: 20px; font-weight: 800; color: #172033;">
                            No incident reports yet
                        </h3>

                        <p style="margin-top: 8px; font-size: 14px; color: #64748b;">
                            Submit a report to help authorities understand affected areas.
                        </p>

                        <a href="{{ route('citizen.reports.create') }}"
                           style="display: inline-block; margin-top: 22px; background: #0F766E; color: white; padding: 11px 18px; border-radius: 8px; font-size: 14px; font-weight: 700; text-decoration: none;">
                            Submit First Report
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>