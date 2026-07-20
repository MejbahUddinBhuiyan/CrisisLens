<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <div>
                <h2 style="font-size:22px; font-weight:700; color:#172033;">
                    Submit Incident Report (ঘটনার রিপোর্ট জমা দিন)
                </h2>
                <p style="margin-top:6px; font-size:14px; color:#64748b;">
                    Report flood, cyclone, damage, blocked road, medical emergency, or shelter needs.
                    <br>
                    বন্যা, ঘূর্ণিঝড়, ক্ষতি, রাস্তা বন্ধ, চিকিৎসা জরুরি বা আশ্রয় প্রয়োজন সম্পর্কে রিপোর্ট করুন।
                </p>
            </div>

            <a href="{{ route('citizen.reports.index') }}"
               style="display:inline-block; border:1px solid #cbd5e1; background:white; color:#172033; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                My Reports (আমার রিপোর্ট)
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:1000px; margin:0 auto; padding:0 16px;">
            <div style="margin-bottom:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px;">
                <strong>Demo Safety Notice (ডেমো নিরাপত্তা বার্তা)</strong>
                <p style="margin-top:6px; font-size:14px;">
                    This is demonstration data for CrisisLens. Do not use this form for real emergency reporting.
                    <br>
                    এটি CrisisLens-এর ডেমো তথ্য। বাস্তব জরুরি রিপোর্টের জন্য এই ফর্ম ব্যবহার করবেন না।
                </p>
            </div>

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
                  action="{{ route('citizen.reports.store') }}"
                  enctype="multipart/form-data"
                  style="background:white; border:1px solid #e5e7eb; border-radius:14px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                @csrf

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
                    <div>
                        <label for="category" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Incident Category (ঘটনার ধরন)
                        </label>

                        <select id="category"
                                name="category"
                                required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                            <option value="">Select category (ধরন নির্বাচন করুন)</option>
                            <option value="flood" @selected(old('category') === 'flood')>Flood (বন্যা)</option>
                            <option value="cyclone" @selected(old('category') === 'cyclone')>Cyclone (ঘূর্ণিঝড়)</option>
                            <option value="road_blocked" @selected(old('category') === 'road_blocked')>Road Blocked (রাস্তা বন্ধ)</option>
                            <option value="building_damage" @selected(old('category') === 'building_damage')>Building Damage (ভবনের ক্ষতি)</option>
                            <option value="medical_emergency" @selected(old('category') === 'medical_emergency')>Medical Emergency (চিকিৎসা জরুরি)</option>
                            <option value="shelter_needed" @selected(old('category') === 'shelter_needed')>Shelter Needed (আশ্রয়কেন্দ্র প্রয়োজন)</option>
                            <option value="other" @selected(old('category') === 'other')>Other (অন্যান্য)</option>
                        </select>
                    </div>

                    <div>
                        <label for="urgency" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Urgency Level (জরুরিতার মাত্রা)
                        </label>

                        <select id="urgency"
                                name="urgency"
                                required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                            <option value="low" @selected(old('urgency') === 'low')>Low (কম)</option>
                            <option value="medium" @selected(old('urgency', 'medium') === 'medium')>Medium (মাঝারি)</option>
                            <option value="high" @selected(old('urgency') === 'high')>High (উচ্চ)</option>
                            <option value="critical" @selected(old('urgency') === 'critical')>Critical (গুরুতর)</option>
                        </select>
                    </div>

                    <div>
                        <label for="latitude" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Latitude (অক্ষাংশ)
                        </label>

                        <input id="latitude"
                               name="latitude"
                               type="number"
                               step="0.0000001"
                               min="-90"
                               max="90"
                               value="{{ old('latitude', '23.8103') }}"
                               required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>

                    <div>
                        <label for="longitude" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                            Longitude (দ্রাঘিমাংশ)
                        </label>

                        <input id="longitude"
                               name="longitude"
                               type="number"
                               step="0.0000001"
                               min="-180"
                               max="180"
                               value="{{ old('longitude', '90.4125') }}"
                               required
                               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">
                    </div>
                </div>

                <div style="margin-top:20px;">
                    <label for="description" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                        Description (বিবরণ)
                    </label>

                    <textarea id="description"
                              name="description"
                              rows="5"
                              required
                              placeholder="Describe what happened, what help is needed, and any visible damage..."
                              style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">{{ old('description') }}</textarea>

                    <p style="margin-top:6px; font-size:12px; color:#64748b;">
                        Minimum 10 characters. Do not include sensitive personal information unless necessary.
                        <br>
                        কমপক্ষে ১০ অক্ষর লিখুন। প্রয়োজন না হলে সংবেদনশীল ব্যক্তিগত তথ্য দেবেন না।
                    </p>
                </div>

                <div style="margin-top:20px;">
                    <label for="images" style="display:block; font-size:14px; font-weight:700; color:#172033;">
                        Upload Images (ছবি আপলোড করুন)
                    </label>

                    <input id="images"
                           name="images[]"
                           type="file"
                           multiple
                           accept="image/jpeg,image/png,image/webp"
                           style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:8px; padding:10px;">

                    <p style="margin-top:6px; font-size:12px; color:#64748b;">
                        Maximum 5 images. Supported: JPG, PNG, WEBP. Maximum size: 5MB each.
                        <br>
                        সর্বোচ্চ ৫টি ছবি। JPG, PNG, WEBP সমর্থিত। প্রতিটি ছবির সর্বোচ্চ সাইজ ৫MB।
                    </p>
                </div>

                <div style="margin-top:32px; display:flex; gap:12px; justify-content:flex-end; align-items:center; flex-wrap:wrap;">
                    <a href="{{ route('citizen.reports.index') }}"
                       style="display:inline-block; border:1px solid #cbd5e1; background:white; color:#172033; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                        Cancel (বাতিল)
                    </a>

                    <button type="submit"
                            style="display:inline-block; border:none; background:#0F766E; color:white; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer;">
                        Submit Report (রিপোর্ট জমা দিন)
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>