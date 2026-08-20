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
            ->latest()
            ->paginate(10);

        return view('authority.emergency-documents.index', compact('documents'));
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