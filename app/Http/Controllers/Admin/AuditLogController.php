<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;

class AuditLogController extends Controller
{
    public function index(): View
    {
        $activities = Activity::query()
            ->with('causer')
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('description', 'like', '%' . $search . '%')
                        ->orWhere('event', 'like', '%' . $search . '%')
                        ->orWhere('subject_type', 'like', '%' . $search . '%')
                        ->orWhere('log_name', 'like', '%' . $search . '%')
                        ->orWhereHas('causer', function ($causerQuery) use ($search) {
                            $causerQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when(request('event'), function ($query, $event) {
                $query->where('event', $event);
            })
            ->when(request('subject_type'), function ($query, $subjectType) {
                $query->where('subject_type', $subjectType);
            })
            ->when(request('date'), function ($query, $date) {
                $query->whereDate('created_at', $date);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $events = Activity::query()
            ->whereNotNull('event')
            ->select('event')
            ->distinct()
            ->orderBy('event')
            ->pluck('event');

        $subjectTypes = Activity::query()
            ->whereNotNull('subject_type')
            ->select('subject_type')
            ->distinct()
            ->orderBy('subject_type')
            ->pluck('subject_type');

        return view('admin.audit-logs.index', compact('activities', 'events', 'subjectTypes'));
    }
}