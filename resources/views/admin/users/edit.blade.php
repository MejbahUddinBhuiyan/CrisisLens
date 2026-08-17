<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Edit User (ব্যবহারকারী সম্পাদনা)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Update user information, password, and role.
                    <br>
                    ব্যবহারকারীর তথ্য, পাসওয়ার্ড এবং রোল আপডেট করুন।
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
                  action="{{ route('admin.users.update', $user) }}"
                  style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                @csrf
                @method('PATCH')

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
                    <div>
                        <label for="name" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Full Name (পূর্ণ নাম)
                        </label>

                        <input id="name"
                               name="name"
                               type="text"
                               value="{{ old('name', $user->name) }}"
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
                               value="{{ old('email', $user->email) }}"
                               required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="password" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            New Password (নতুন পাসওয়ার্ড)
                        </label>

                        <input id="password"
                               name="password"
                               type="password"
                               placeholder="Leave blank to keep old password"
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="password_confirmation" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Confirm New Password (নতুন পাসওয়ার্ড নিশ্চিত করুন)
                        </label>

                        <input id="password_confirmation"
                               name="password_confirmation"
                               type="password"
                               placeholder="Leave blank to keep old password"
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
                                <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()?->name) === $role->name)>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="margin-top:24px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:14px;">
                    <div style="font-size:13px; color:#64748b; line-height:1.8;">
                        <strong>User ID:</strong> {{ $user->id }} <br>
                        <strong>Created:</strong> {{ $user->created_at->format('M d, Y h:i A') }} <br>
                        <strong>Email Verified:</strong> {{ $user->email_verified_at ? 'Yes' : 'No' }}
                    </div>
                </div>

                <div style="margin-top:32px; display:flex; gap:12px; justify-content:flex-end; align-items:center; flex-wrap:wrap;">
                    <a href="{{ route('admin.users.index') }}"
                       style="display:inline-block; border:1px solid #cbd5e1; background:white; color:#172033; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                        Cancel (বাতিল)
                    </a>

                    <button type="submit"
                            style="display:inline-block; border:none; background:#0F766E; color:white; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer;">
                        Update User (ব্যবহারকারী আপডেট করুন)
                    </button>
                </div>
            </form>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Security Notice (নিরাপত্তা বার্তা):</strong>
                Changing a user's role immediately changes their access permissions.
                <br>
                ব্যবহারকারীর রোল পরিবর্তন করলে সাথে সাথে তার প্রবেশাধিকার পরিবর্তন হবে।
            </div>
        </div>
    </div>
</x-app-layout>