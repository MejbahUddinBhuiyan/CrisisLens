<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Add Shelter (আশ্রয়কেন্দ্র যোগ করুন)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Add a new emergency shelter with capacity, location, facilities, and status.
                    <br>
                    ধারণক্ষমতা, অবস্থান, সুবিধা এবং অবস্থা সহ নতুন জরুরি আশ্রয়কেন্দ্র যোগ করুন।
                </p>
            </div>

            <a href="{{ route('authority.shelters.index') }}"
               style="display:inline-block; background:white; color:#172033; padding:10px 16px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                Back to Shelters (আশ্রয়কেন্দ্রে ফিরে যান)
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
                  action="{{ route('authority.shelters.store') }}"
                  style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                @csrf

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
                    <div>
                        <label for="name" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Shelter Name (আশ্রয়কেন্দ্রের নাম)
                        </label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required
                               placeholder="Example: Dhaka Govt School Shelter"
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="status" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Status (অবস্থা)
                        </label>
                        <select id="status" name="status" required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                            <option value="available" @selected(old('status') === 'available')>Available (উপলব্ধ)</option>
                            <option value="limited" @selected(old('status') === 'limited')>Limited (সীমিত)</option>
                            <option value="full" @selected(old('status') === 'full')>Full (পূর্ণ)</option>
                            <option value="closed" @selected(old('status') === 'closed')>Closed (বন্ধ)</option>
                        </select>
                    </div>

                    <div>
                        <label for="capacity" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Capacity (ধারণক্ষমতা)
                        </label>
                        <input id="capacity" name="capacity" type="number" min="0" value="{{ old('capacity', 100) }}" required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="current_occupancy" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Current Occupancy (বর্তমান অবস্থানকারী)
                        </label>
                        <input id="current_occupancy" name="current_occupancy" type="number" min="0" value="{{ old('current_occupancy', 0) }}" required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="latitude" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Latitude (অক্ষাংশ)
                        </label>
                        <input id="latitude" name="latitude" type="number" step="0.0000001" min="-90" max="90" value="{{ old('latitude', '23.8103') }}" required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="longitude" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Longitude (দ্রাঘিমাংশ)
                        </label>
                        <input id="longitude" name="longitude" type="number" step="0.0000001" min="-180" max="180" value="{{ old('longitude', '90.4125') }}" required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="contact_phone" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Contact Phone (যোগাযোগ নম্বর)
                        </label>
                        <input id="contact_phone" name="contact_phone" type="text" value="{{ old('contact_phone') }}"
                               placeholder="Example: 017XXXXXXXX"
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="contact_email" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Contact Email (যোগাযোগ ইমেইল)
                        </label>
                        <input id="contact_email" name="contact_email" type="email" value="{{ old('contact_email') }}"
                               placeholder="Example: shelter@example.com"
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>
                </div>

                <div style="margin-top:20px;">
                    <label for="address" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                        Address (ঠিকানা)
                    </label>
                    <textarea id="address" name="address" rows="3" required
                              placeholder="Write full shelter address..."
                              style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">{{ old('address') }}</textarea>
                </div>

                <div style="margin-top:20px;">
                    <label style="display:block; font-size:14px; font-weight:700; color:#172033;">
                        Facilities (সুবিধাসমূহ)
                    </label>

                    @php
                        $oldFacilities = old('facilities', []);
                        $facilityOptions = [
                            'drinking_water',
                            'toilet',
                            'medical_support',
                            'women_safe_space',
                            'child_support',
                            'electricity',
                            'food_support',
                            'pet_allowed',
                        ];
                    @endphp

                    <div style="margin-top:10px; display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:10px;">
                        @foreach ($facilityOptions as $facility)
                            <label style="display:flex; gap:8px; align-items:center; border:1px solid #e5e7eb; padding:10px; border-radius:8px;">
                                <input type="checkbox"
                                       name="facilities[]"
                                       value="{{ $facility }}"
                                       @checked(in_array($facility, $oldFacilities))>
                                <span style="font-size:14px; color:#172033;">
                                    {{ \App\Support\BilingualLabel::facility($facility) }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div style="margin-top:20px;">
                    <label style="display:flex; gap:8px; align-items:center;">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))>
                        <span style="font-size:14px; font-weight:700; color:#172033;">
                            Active Shelter (সক্রিয় আশ্রয়কেন্দ্র)
                        </span>
                    </label>
                </div>

                <div style="margin-top:32px; display:flex; gap:12px; justify-content:flex-end; align-items:center; flex-wrap:wrap;">
                    <a href="{{ route('authority.shelters.index') }}"
                       style="display:inline-block; border:1px solid #cbd5e1; background:white; color:#172033; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                        Cancel (বাতিল)
                    </a>

                    <button type="submit"
                            style="display:inline-block; border:none; background:#0F766E; color:white; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer;">
                        Save Shelter (আশ্রয়কেন্দ্র সংরক্ষণ করুন)
                    </button>
                </div>
            </form>

            <div style="margin-top:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Demo Safety Notice (ডেমো নিরাপত্তা বার্তা):</strong>
                Shelter data should be verified before being shown as real emergency information.
                <br>
                বাস্তব জরুরি তথ্য হিসেবে দেখানোর আগে আশ্রয়কেন্দ্রের তথ্য যাচাই করা উচিত।
            </div>
        </div>
    </div>
</x-app-layout>