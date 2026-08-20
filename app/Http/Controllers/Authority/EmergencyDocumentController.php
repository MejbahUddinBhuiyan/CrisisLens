<?php

namespace App\Http\Controllers\Authority;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmergencyDocumentRequest;
use App\Models\EmergencyDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmergencyDocumentController extends Controller
{
public function index(): View
{
    $documents = EmergencyDocument::query()
        ->with('uploader')
        ->when(request('search'), function ($query, $search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('language', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhereHas('uploader', function ($uploaderQuery) use ($search) {
                        $uploaderQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
        })
        ->when(request('category'), function ($query, $category) {
            $query->where('category', $category);
        })
        ->when(request('language'), function ($query, $language) {
            $query->where('language', $language);
        })
        ->when(request('active_status'), function ($query, $status) {
            if ($status === 'active') {
                $query->where('is_active', true);
            }

            if ($status === 'inactive') {
                $query->where('is_active', false);
            }
        })
        ->when(request('verified_status'), function ($query, $status) {
            if ($status === 'verified') {
                $query->where('is_verified', true);
            }

            if ($status === 'unverified') {
                $query->where('is_verified', false);
            }
        })
        ->when(request('date'), function ($query, $date) {
            $query->whereDate('created_at', $date);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $categories = EmergencyDocument::query()
        ->whereNotNull('category')
        ->select('category')
        ->distinct()
        ->orderBy('category')
        ->pluck('category');

    return view('authority.emergency-documents.index', compact('documents', 'categories'));
}

    public function create(): View
    {
        return view('authority.emergency-documents.create');
    }

    public function store(StoreEmergencyDocumentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $document = EmergencyDocument::create([
            'uploaded_by' => Auth::id(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'language' => $validated['language'],
            'content' => $validated['content'],

            // We are saving guide content directly in database, not uploading a file.
            // But database columns disk/path cannot be null, so we store safe placeholder values.
            'disk' => 'database',
            'path' => 'content',

            'is_active' => $request->boolean('is_active'),
            'is_verified' => $request->boolean('is_verified'),
            'is_demo' => true,
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($document)
            ->event('created')
            ->log('emergency_document_created');

        return redirect()
            ->route('authority.emergency-documents.index')
            ->with('success', 'Emergency safety guide created successfully.');
    }

    public function edit(EmergencyDocument $emergencyDocument): View
    {
        return view('authority.emergency-documents.edit', compact('emergencyDocument'));
    }

    public function update(StoreEmergencyDocumentRequest $request, EmergencyDocument $emergencyDocument): RedirectResponse
    {
        $validated = $request->validated();

        $emergencyDocument->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'language' => $validated['language'],
            'content' => $validated['content'],

            // Keep safe placeholder values for database-based guides.
            'disk' => $emergencyDocument->disk ?: 'database',
            'path' => $emergencyDocument->path ?: 'content',

            'is_active' => $request->boolean('is_active'),
            'is_verified' => $request->boolean('is_verified'),
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($emergencyDocument)
            ->event('updated')
            ->log('emergency_document_updated');

        return redirect()
            ->route('authority.emergency-documents.index')
            ->with('success', 'Emergency safety guide updated successfully.');
    }
}