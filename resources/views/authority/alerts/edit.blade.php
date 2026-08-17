<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Edit Alert (সতর্কতা সম্পাদনা)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Update alert risk level, message, status, and approval.
                    <br>
                    সতর্কতার ঝুঁকির মাত্রা, বার্তা, অবস্থা এবং অনুমোদন আপডেট করুন।
                </p>
            </div>

            <a href="{{ route('authority.alerts.index') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                Back to Alerts (সতর্কতায় ফিরে যান)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1000px; margin:0 auto; padding:0 16px;">
            @if ($errors->any())
                <div style="margin-bottom:24px; border:1px solid #fecaca; background:#fef2f2; color:#b91c1c; padding:16px; border-radius:12px;">
                    <strong>Please fix the following problems (নিচের সমস্যাগুলো ঠিক করুন):</strong>
                    <ul style="margin-top:8px; padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li style="font-size:14px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('authority.alerts.update', $alert) }}"
                  style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                @csrf
                @method('PATCH')

                <div>
                    <label for="title" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                        Alert Title (সতর্কতার শিরোনাম)
                    </label>
                    <input id="title" name="title" type="text" value="{{ old('title', $alert->title) }}" required
                           style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                </div>

                <div style="margin-top:20px;">
                    <label for="message" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                        Alert Message (সতর্কতার বার্তা)
                    </label>
                    <textarea id="message" name="message" rows="6" required
                              style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">{{ old('message', $alert->message) }}</textarea>
                </div>

                <div style="margin-top:20px; display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:20px;">
                    <div>
                        <label for="risk_level" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Risk Level (ঝুঁকির মাত্রা)
                        </label>
                        <select id="risk_level" name="risk_level" required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                            <option value="Safe" @selected(old('risk_level', $alert->risk_level) === 'Safe')>Safe (নিরাপদ)</option>
                            <option value="Advisory" @selected(old('risk_level', $alert->risk_level) === 'Advisory')>Advisory (সতর্কতামূলক)</option>
                            <option value="Warning" @selected(old('risk_level', $alert->risk_level) === 'Warning')>Warning (সতর্কতা)</option>
                            <option value="Critical" @selected(old('risk_level', $alert->risk_level) === 'Critical')>Critical (গুরুতর ঝুঁকি)</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Status (অবস্থা)
                        </label>
                        <select id="status" name="status" required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                            <option value="draft" @selected(old('status', $alert->status) === 'draft')>Draft (খসড়া)</option>
                            <option value="published" @selected(old('status', $alert->status) === 'published')>Published (প্রকাশিত)</option>
                            <option value="cancelled" @selected(old('status', $alert->status) === 'cancelled')>Cancelled (বাতিল)</option>
                        </select>
                    </div>

                    <div>
                        <label for="expires_at" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Expires At (মেয়াদ শেষ)
                        </label>
                        <input id="expires_at"
                               name="expires_at"
                               type="datetime-local"
                               value="{{ old('expires_at', $alert->expires_at?->format('Y-m-d\TH:i')) }}"
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>
                </div>

                <div style="margin-top:20px; display:grid; gap:12px;">
                    <label style="display:flex; gap:8px; align-items:center;">
                        <input type="checkbox" name="requires_human_approval" value="1" @checked(old('requires_human_approval', $alert->requires_human_approval))>
                        <span style="font-size:14px; font-weight:700; color:#172033;">
                            Requires Human Approval (মানব অনুমোদন প্রয়োজন)
                        </span>
                    </label>

                    <label style="display:flex; gap:8px; align-items:center;">
                        <input type="checkbox" name="is_approved" value="1" @checked(old('is_approved', $alert->is_approved))>
                        <span style="font-size:14px; font-weight:700; color:#172033;">
                            Approved for Public View (জনসাধারণের জন্য অনুমোদিত)
                        </span>
                    </label>
                </div>

                <div style="margin-top:20px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:14px;">
                    <div style="font-size:13px; color:#64748b; line-height:1.8;">
                        <strong>Created by (তৈরি করেছেন):</strong> {{ $alert->publisher?->name ?? 'N/A' }} <br>
                        <strong>Approved by (অনুমোদন করেছেন):</strong> {{ $alert->approver?->name ?? 'N/A' }} <br>
                        <strong>Published at (প্রকাশের সময়):</strong> {{ $alert->published_at?->format('M d, Y h:i A') ?? 'Not published' }}
                    </div>
                </div>

                <div style="margin-top:32px; display:flex; gap:12px; justify-content:flex-end; align-items:center; flex-wrap:wrap;">
                    <a href="{{ route('authority.alerts.index') }}"
                       style="display:inline-block; border:1px solid #cbd5e1; background:white; color:#172033; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                        Cancel (বাতিল)
                    </a>

                    <button type="submit"
                            style="display:inline-block; border:none; background:#0F766E; color:white; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer;">
                        Update Alert (সতর্কতা আপডেট করুন)
                    </button>
                </div>
            </form>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Important (গুরুত্বপূর্ণ):</strong>
                Only published and approved alerts will appear in the citizen alert page.
                <br>
                শুধুমাত্র প্রকাশিত এবং অনুমোদিত সতর্কতাগুলো নাগরিক সতর্কতা পেজে দেখা যাবে।
            </div>
        </div>
    </div>
</x-app-layout>