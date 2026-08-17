<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Add User (ব্যবহারকারী যোগ করুন)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Create a new user and assign a role.
                    <br>
                    নতুন ব্যবহারকারী তৈরি করুন এবং রোল নির্ধারণ করুন।
                </p>
            </div>

            <a href="{{ route('admin.users.index') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                Back to Users (ব্যবহারকারীতে ফিরে যান)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:900px; margin:0 auto; padding:0 16px;">
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
                  action="{{ route('admin.users.store') }}"
                  style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                @csrf

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
                    <div>
                        <label for="name" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Full Name (পূর্ণ নাম)
                        </label>

                        <input id="name"
                               name="name"
                               type="text"
                               value="{{ old('name') }}"
                               required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="email" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Email (ইমেইল)
                        </label>

                        <input id="email"
                               name="email"
                               type="email"
                               value="{{ old('email') }}"
                               required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="password" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Password (পাসওয়ার্ড)
                        </label>

                        <input id="password"
                               name="password"
                               type="password"
                               required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="password_confirmation" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Confirm Password (পাসওয়ার্ড নিশ্চিত করুন)
                        </label>

                        <input id="password_confirmation"
                               name="password_confirmation"
                               type="password"
                               required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="role" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Role (রোল)
                        </label>

                        <select id="role"
                                name="role"
                                required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                            <option value="">Select Role (রোল নির্বাচন করুন)</option>

                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @selected(old('role') === $role->name)>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="margin-top:24px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:14px;">
                    <h3 style="font-size:14px; font-weight:800; color:#172033;">
                        Role Meaning (রোলের অর্থ)
                    </h3>

                    <ul style="margin-top:8px; padding-left:20px; color:#64748b; line-height:1.8; font-size:14px;">
                        <li><strong>Citizen:</strong> submit reports, view alerts and shelters.</li>
                        <li><strong>Emergency Responder:</strong> view verified reports and resolve incidents.</li>
                        <li><strong>Authority Administrator:</strong> verify reports, manage shelters, publish alerts.</li>
                        <li><strong>Super Administrator:</strong> manage the full system and users.</li>
                    </ul>
                </div>

                <div style="margin-top:32px; display:flex; gap:12px; justify-content:flex-end; align-items:center; flex-wrap:wrap;">
                    <a href="{{ route('admin.users.index') }}"
                       style="display:inline-block; border:1px solid #cbd5e1; background:white; color:#172033; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                        Cancel (বাতিল)
                    </a>

                    <button type="submit"
                            style="display:inline-block; border:none; background:#0F766E; color:white; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer;">
                        Save User (ব্যবহারকারী সংরক্ষণ করুন)
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>