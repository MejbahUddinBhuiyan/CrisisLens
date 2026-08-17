<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Create Alert (সতর্কতা তৈরি করুন)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Create a public disaster alert for citizens.
                    <br>
                    নাগরিকদের জন্য জনসাধারণের দুর্যোগ সতর্কতা তৈরি করুন।
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
                  action="{{ route('authority.alerts.store') }}"
                  style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                @csrf

                <div>
                    <label for="title" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                        Alert Title (সতর্কতার শিরোনাম)
                    </label>
                    <input id="title" name="title" type="text" value="{{ old('title') }}" required
                           placeholder="Example: Flood warning near Dhanmondi area"
                           style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                </div>

                <div style="margin-top:20px;">
                    <label for="message" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                        Alert Message (সতর্কতার বার্তা)
                    </label>
                    <textarea id="message" name="message" rows="6" required
                              placeholder="Write clear instructions for citizens..."
                              style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">{{ old('message') }}</textarea>
                    <p style="margin-top:6px; font-size:12px; color:#64748b;">
                        Write short, clear, and actionable instructions.
                        <br>
                        সংক্ষিপ্ত, পরিষ্কার এবং করণীয় নির্দেশনা লিখুন।
                    </p>
                </div>

                <div style="margin-top:20px; display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:20px;">
                    <div>
                        <label for="risk_level" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Risk Level (ঝুঁকির মাত্রা)
                        </label>
                        <select id="risk_level" name="risk_level" required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                            <option value="Safe" @selected(old('risk_level') === 'Safe')>Safe (নিরাপদ)</option>
                            <option value="Advisory" @selected(old('risk_level') === 'Advisory')>Advisory (সতর্কতামূলক)</option>
                            <option value="Warning" @selected(old('risk_level', 'Warning') === 'Warning')>Warning (সতর্কতা)</option>
                            <option value="Critical" @selected(old('risk_level') === 'Critical')>Critical (গুরুতর ঝুঁকি)</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Status (অবস্থা)
                        </label>
                        <select id="status" name="status" required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                            <option value="draft" @selected(old('status') === 'draft')>Draft (খসড়া)</option>
                            <option value="published" @selected(old('status', 'published') === 'published')>Published (প্রকাশিত)</option>
                            <option value="cancelled" @selected(old('status') === 'cancelled')>Cancelled (বাতিল)</option>
                        </select>
                    </div>

                    <div>
                        <label for="expires_at" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Expires At (মেয়াদ শেষ)
                        </label>
                        <input id="expires_at" name="expires_at" type="datetime-local" value="{{ old('expires_at') }}"
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>
                </div>

                <div style="margin-top:20px; display:grid; gap:12px;">
                    <label style="display:flex; gap:8px; align-items:center;">
                        <input type="checkbox" name="requires_human_approval" value="1" @checked(old('requires_human_approval', true))>
                        <span style="font-size:14px; font-weight:700; color:#172033;">
                            Requires Human Approval (মানব অনুমোদন প্রয়োজন)
                        </span>
                    </label>

                    <label style="display:flex; gap:8px; align-items:center;">
                        <input type="checkbox" name="is_approved" value="1" @checked(old('is_approved', true))>
                        <span style="font-size:14px; font-weight:700; color:#172033;">
                            Approved for Public View (জনসাধারণের জন্য অনুমোদিত)
                        </span>
                    </label>
                </div>

                <div style="margin-top:32px; display:flex; gap:12px; justify-content:flex-end; align-items:center; flex-wrap:wrap;">
                    <a href="{{ route('authority.alerts.index') }}"
                       style="display:inline-block; border:1px solid #cbd5e1; background:white; color:#172033; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                        Cancel (বাতিল)
                    </a>

                    <button type="submit"
                            style="display:inline-block; border:none; background:#0F766E; color:white; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer;">
                        Save Alert (সতর্কতা সংরক্ষণ করুন)
                    </button>
                </div>
            </form>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Important (গুরুত্বপূর্ণ):</strong>
                Critical alerts are automatically treated as requiring human approval.
                <br>
                গুরুতর ঝুঁকির সতর্কতা স্বয়ংক্রিয়ভাবে মানব অনুমোদন প্রয়োজন হিসেবে বিবেচিত হবে।
            </div>
        </div>
    </div>
</x-app-layout>