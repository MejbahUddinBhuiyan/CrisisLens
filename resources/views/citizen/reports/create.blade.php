<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px; font-weight:700; color:#172033;">
                Submit Incident Report (ঘটনার রিপোর্ট জমা দিন)
            </h2>
            <p style="margin-top:6px; font-size:14px; color:#64748b;">
                Report flood, cyclone, road blockage, building damage, medical emergency, or shelter need.
                <br>
                বন্যা, ঘূর্ণিঝড়, রাস্তা বন্ধ, ভবনের ক্ষতি, চিকিৎসা জরুরি বা আশ্রয়ের প্রয়োজন সম্পর্কে রিপোর্ট করুন।
            </p>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:980px; margin:0 auto; padding:0 16px;">

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

            <div style="margin-bottom:24px; border:1px solid #fcd34d; background:#fffbeb; color:#92400e; padding:16px; border-radius:12px; line-height:1.7;">
                <strong>Safety Notice (নিরাপত্তা বার্তা):</strong>
                Submit clear and truthful information. If this is a life-threatening emergency, contact local emergency services immediately.
                <br>
                সঠিক ও সত্য তথ্য জমা দিন। এটি জীবনঝুঁকিপূর্ণ জরুরি অবস্থা হলে দ্রুত স্থানীয় জরুরি সেবার সাথে যোগাযোগ করুন।
            </div>

            <form method="POST"
                  action="{{ route('citizen.reports.store') }}"
                  enctype="multipart/form-data"
                  style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.08);">
                @csrf

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
                    <div>
                        <label for="category" style="display:block; font-size:14px; font-weight:800; color:#172033;">
                            Incident Category (ঘটনার ধরন)
                        </label>

                        <select id="category"
                                name="category"
                                required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:11px;">
                            <option value="">Select Category (ধরন নির্বাচন করুন)</option>
                            <option value="flood" @selected(old('category') === 'flood')>Flood (বন্যা)</option>
                            <option value="cyclone" @selected(old('category') === 'cyclone')>Cyclone (ঘূর্ণিঝড়)</option>
                            <option value="road_blocked" @selected(old('category') === 'road_blocked')>Road Blocked (রাস্তা বন্ধ)</option>
                            <option value="building_damage" @selected(old('category') === 'building_damage')>Building Damage (ভবনের ক্ষতি)</option>
                            <option value="medical_emergency" @selected(old('category') === 'medical_emergency')>Medical Emergency (চিকিৎসা জরুরি)</option>
                            <option value="shelter_needed" @selected(old('category') === 'shelter_needed')>Shelter Needed (আশ্রয় প্রয়োজন)</option>
                            <option value="other" @selected(old('category') === 'other')>Other (অন্যান্য)</option>
                        </select>

                        <div id="categoryHelp"
                             style="margin-top:10px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:12px; color:#64748b; font-size:13px; line-height:1.6;">
                            Select an incident category to see guidance.
                            <br>
                            নির্দেশনা দেখতে ঘটনার ধরন নির্বাচন করুন।
                        </div>
                    </div>

                    <div>
                        <label for="urgency" style="display:block; font-size:14px; font-weight:800; color:#172033;">
                            Urgency Level (জরুরিতা)
                        </label>

                        <select id="urgency"
                                name="urgency"
                                required
                                style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:11px;">
                            <option value="">Select Urgency (জরুরিতা নির্বাচন করুন)</option>
                            <option value="low" @selected(old('urgency') === 'low')>Low (কম)</option>
                            <option value="medium" @selected(old('urgency') === 'medium')>Medium (মাঝারি)</option>
                            <option value="high" @selected(old('urgency') === 'high')>High (উচ্চ)</option>
                            <option value="critical" @selected(old('urgency') === 'critical')>Critical (গুরুতর)</option>
                        </select>

                        <p style="margin-top:8px; font-size:13px; color:#64748b; line-height:1.6;">
                            Choose Critical only when there is serious danger to life, shelter, road access, or medical safety.
                            <br>
                            জীবন, আশ্রয়, রাস্তা বা চিকিৎসা নিরাপত্তার গুরুতর ঝুঁকি থাকলে Critical নির্বাচন করুন।
                        </p>
                    </div>
                </div>

                <div style="margin-top:22px;">
                    <label for="description" style="display:block; font-size:14px; font-weight:800; color:#172033;">
                        Incident Description (ঘটনার বিবরণ)
                    </label>

                    <textarea id="description"
                              name="description"
                              rows="6"
                              required
                              placeholder="Describe what happened, where it happened, how many people may be affected, and what help is needed."
                              style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:12px; line-height:1.7;">{{ old('description') }}</textarea>

                    <p style="margin-top:8px; font-size:13px; color:#64748b;">
                        Minimum 10 characters. Add clear details for faster authority review.
                        <br>
                        অন্তত ১০ অক্ষর লিখুন। দ্রুত যাচাইয়ের জন্য পরিষ্কার তথ্য দিন।
                    </p>
                </div>

                <div style="margin-top:22px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:14px; padding:18px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; gap:14px; flex-wrap:wrap;">
                        <div>
                            <h3 style="margin:0; font-size:17px; font-weight:900; color:#172033;">
                                Location Information (অবস্থান তথ্য)
                            </h3>

                            <p style="margin:6px 0 0; font-size:13px; color:#64748b; line-height:1.6;">
                                Use auto location or manually enter latitude and longitude.
                                <br>
                                অটো লোকেশন ব্যবহার করুন অথবা latitude ও longitude লিখুন।
                            </p>
                        </div>

                        <button type="button"
                                id="getLocationBtn"
                                style="border:none; background:#0F766E; color:white; padding:10px 15px; border-radius:9px; font-size:14px; font-weight:800; cursor:pointer;">
                            Use My Location (আমার লোকেশন ব্যবহার করুন)
                        </button>
                    </div>

                    <div id="locationStatus"
                         style="display:none; margin-top:14px; border-radius:10px; padding:12px; font-size:14px; line-height:1.6;">
                    </div>

                    <div style="margin-top:18px; display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:18px;">
                        <div>
                            <label for="latitude" style="display:block; font-size:14px; font-weight:800; color:#172033;">
                                Latitude (অক্ষাংশ)
                            </label>

                            <input id="latitude"
                                   name="latitude"
                                   type="number"
                                   step="any"
                                   value="{{ old('latitude') }}"
                                   required
                                   style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:11px;">
                        </div>

                        <div>
                            <label for="longitude" style="display:block; font-size:14px; font-weight:800; color:#172033;">
                                Longitude (দ্রাঘিমাংশ)
                            </label>

                            <input id="longitude"
                                   name="longitude"
                                   type="number"
                                   step="any"
                                   value="{{ old('longitude') }}"
                                   required
                                   style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:11px;">
                        </div>
                    </div>

                    <div id="mapPreviewBox"
                         style="display:none; margin-top:16px; background:white; border:1px solid #d1fae5; border-radius:12px; padding:14px;">
                        <strong style="color:#0F766E;">Map Preview (মানচিত্র প্রিভিউ):</strong>

                        <p id="mapPreviewText" style="margin:8px 0 12px; color:#64748b; font-size:14px;"></p>

                        <a id="mapPreviewLink"
                           href="#"
                           target="_blank"
                           style="display:inline-block; background:#0F766E; color:white; padding:9px 14px; border-radius:8px; font-size:13px; font-weight:800; text-decoration:none;">
                            Open in Google Maps (Google Maps-এ খুলুন)
                        </a>
                    </div>
                </div>

                <div style="margin-top:22px;">
                    <label for="images" style="display:block; font-size:14px; font-weight:800; color:#172033;">
                        Upload Images (ছবি আপলোড করুন)
                    </label>

                    <div style="margin-top:8px; border:2px dashed #cbd5e1; border-radius:14px; padding:20px; background:#f8fafc;">
                        <input id="images"
                               name="images[]"
                               type="file"
                               accept="image/png,image/jpeg,image/jpg,image/webp"
                               multiple
                               style="width:100%;">

                        <p style="margin:10px 0 0; font-size:13px; color:#64748b; line-height:1.6;">
                            You can upload up to 5 images. You may select images together or one by one.
                            <br>
                            সর্বোচ্চ ৫টি ছবি আপলোড করা যাবে। একসাথে অথবা একে একে ছবি নির্বাচন করা যাবে।
                        </p>

                        <p style="margin:6px 0 0; font-size:13px; color:#64748b; line-height:1.6;">
                            Allowed formats: JPG, JPEG, PNG, WEBP. Maximum 5MB each.
                            <br>
                            ফরম্যাট: JPG, JPEG, PNG, WEBP। প্রতিটি সর্বোচ্চ ৫MB।
                        </p>
                    </div>

                    <div id="imageCounter"
                         style="display:none; margin-top:12px; background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; border-radius:10px; padding:10px; font-size:13px; font-weight:800;">
                    </div>

                    <div id="imagePreview"
                         style="margin-top:14px; display:grid; grid-template-columns:repeat(auto-fit, minmax(120px, 1fr)); gap:12px;">
                    </div>
                </div>

                <div style="margin-top:26px; background:#eff6ff; border:1px solid #bfdbfe; color:#1d4ed8; padding:16px; border-radius:12px; line-height:1.7;">
                    <strong>AI Prediction Notice (AI পূর্বাভাস বার্তা):</strong>
                    After submission, CrisisLens will send this report to the AI service for demo flood-risk prediction.
                    The authority will still review the report manually.
                    <br>
                    রিপোর্ট জমা দেওয়ার পর CrisisLens ডেমো বন্যা ঝুঁকি পূর্বাভাসের জন্য AI সার্ভিসে পাঠাবে।
                    এরপরও কর্তৃপক্ষ রিপোর্টটি ম্যানুয়ালি যাচাই করবে।
                </div>

                <div style="margin-top:32px; display:flex; justify-content:flex-end; gap:12px; flex-wrap:wrap;">
                    <a href="{{ route('citizen.reports.index') }}"
                       style="display:inline-block; border:1px solid #cbd5e1; background:white; color:#172033; padding:11px 18px; border-radius:9px; font-size:14px; font-weight:800; text-decoration:none;">
                        Cancel (বাতিল)
                    </a>

                    <button type="submit"
                            style="border:none; background:#dc2626; color:white; padding:11px 18px; border-radius:9px; font-size:14px; font-weight:800; cursor:pointer;">
                        Submit Report (রিপোর্ট জমা দিন)
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const categoryHelp = document.getElementById('categoryHelp');
        const categoryInput = document.getElementById('category');

        const helpTexts = {
            flood: 'Flood: mention water level, affected road/house, trapped people, and urgent help needed. / বন্যা: পানির উচ্চতা, ক্ষতিগ্রস্ত রাস্তা/বাড়ি, আটকে পড়া মানুষ ও জরুরি সাহায্যের কথা লিখুন।',
            cyclone: 'Cyclone: mention wind damage, fallen trees, damaged house, blocked road, or injury. / ঘূর্ণিঝড়: বাতাসে ক্ষতি, গাছ পড়া, ঘর ক্ষতি, রাস্তা বন্ধ বা আহত ব্যক্তির কথা লিখুন।',
            road_blocked: 'Road Blocked: mention road name, cause, traffic condition, and alternative route if known. / রাস্তা বন্ধ: রাস্তার নাম, কারণ, যানজটের অবস্থা ও বিকল্প রাস্তা জানা থাকলে লিখুন।',
            building_damage: 'Building Damage: mention crack, collapse risk, injured people, and nearby danger. / ভবনের ক্ষতি: ফাটল, ধসের ঝুঁকি, আহত ব্যক্তি ও আশেপাশের ঝুঁকি লিখুন।',
            medical_emergency: 'Medical Emergency: mention number of affected people, symptoms/injury, and required support. / চিকিৎসা জরুরি: আক্রান্ত মানুষের সংখ্যা, লক্ষণ/আঘাত ও প্রয়োজনীয় সহায়তা লিখুন।',
            shelter_needed: 'Shelter Needed: mention number of people, vulnerable groups, current location, and urgent needs. / আশ্রয় প্রয়োজন: মানুষের সংখ্যা, শিশু/নারী/বৃদ্ধ, বর্তমান অবস্থান ও জরুরি প্রয়োজন লিখুন।',
            other: 'Other: clearly explain what happened and what help is needed. / অন্যান্য: কী ঘটেছে এবং কী সাহায্য দরকার তা পরিষ্কারভাবে লিখুন।'
        };

        categoryInput.addEventListener('change', function () {
            categoryHelp.innerHTML = helpTexts[this.value] ?? 'Select an incident category to see guidance.<br>নির্দেশনা দেখতে ঘটনার ধরন নির্বাচন করুন।';
        });

        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const getLocationBtn = document.getElementById('getLocationBtn');
        const locationStatus = document.getElementById('locationStatus');
        const mapPreviewBox = document.getElementById('mapPreviewBox');
        const mapPreviewText = document.getElementById('mapPreviewText');
        const mapPreviewLink = document.getElementById('mapPreviewLink');

        function showStatus(message, type = 'info') {
            locationStatus.style.display = 'block';
            locationStatus.innerHTML = message;

            if (type === 'success') {
                locationStatus.style.background = '#f0fdf4';
                locationStatus.style.border = '1px solid #bbf7d0';
                locationStatus.style.color = '#166534';
            } else if (type === 'error') {
                locationStatus.style.background = '#fef2f2';
                locationStatus.style.border = '1px solid #fecaca';
                locationStatus.style.color = '#b91c1c';
            } else {
                locationStatus.style.background = '#eff6ff';
                locationStatus.style.border = '1px solid #bfdbfe';
                locationStatus.style.color = '#1d4ed8';
            }
        }

        function updateMapPreview() {
            const lat = latitudeInput.value;
            const lng = longitudeInput.value;

            if (lat && lng) {
                const url = `https://www.google.com/maps?q=${lat},${lng}`;

                mapPreviewBox.style.display = 'block';
                mapPreviewText.innerHTML = `Latitude: ${lat}, Longitude: ${lng}`;
                mapPreviewLink.href = url;
            } else {
                mapPreviewBox.style.display = 'none';
            }
        }

        getLocationBtn.addEventListener('click', function () {
            if (!navigator.geolocation) {
                showStatus('Geolocation is not supported by this browser.<br>এই ব্রাউজারে লোকেশন সাপোর্ট নেই।', 'error');
                return;
            }

            showStatus('Getting your location. Please allow location permission.<br>আপনার লোকেশন নেওয়া হচ্ছে। লোকেশন পারমিশন দিন।', 'info');

            navigator.geolocation.getCurrentPosition(
                function (position) {
                    latitudeInput.value = position.coords.latitude.toFixed(7);
                    longitudeInput.value = position.coords.longitude.toFixed(7);

                    showStatus('Location added successfully.<br>লোকেশন সফলভাবে যোগ হয়েছে।', 'success');
                    updateMapPreview();
                },
                function () {
                    showStatus('Could not get location. Please allow permission or enter manually.<br>লোকেশন পাওয়া যায়নি। পারমিশন দিন অথবা ম্যানুয়ালি লিখুন।', 'error');
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        });

        latitudeInput.addEventListener('input', updateMapPreview);
        longitudeInput.addEventListener('input', updateMapPreview);
        updateMapPreview();

        const imagesInput = document.getElementById('images');
        const imagePreview = document.getElementById('imagePreview');
        const imageCounter = document.getElementById('imageCounter');

        let selectedImageFiles = [];

        imagesInput.addEventListener('change', function () {
            const newFiles = Array.from(this.files);

            newFiles.forEach(function (file) {
                if (!file.type.startsWith('image/')) {
                    return;
                }

                const alreadySelected = selectedImageFiles.some(function (selectedFile) {
                    return selectedFile.name === file.name &&
                           selectedFile.size === file.size &&
                           selectedFile.lastModified === file.lastModified;
                });

                if (!alreadySelected && selectedImageFiles.length < 5) {
                    selectedImageFiles.push(file);
                }
            });

            updateFileInput();
            renderImagePreview();
        });

        function updateFileInput() {
            const dataTransfer = new DataTransfer();

            selectedImageFiles.forEach(function (file) {
                dataTransfer.items.add(file);
            });

            imagesInput.files = dataTransfer.files;
        }

        function renderImagePreview() {
            imagePreview.innerHTML = '';

            if (selectedImageFiles.length > 0) {
                imageCounter.style.display = 'block';
                imageCounter.innerHTML = `${selectedImageFiles.length} image(s) selected. <br> ${selectedImageFiles.length}টি ছবি নির্বাচন করা হয়েছে।`;
            } else {
                imageCounter.style.display = 'none';
            }

            selectedImageFiles.forEach(function (file, index) {
                const reader = new FileReader();

                reader.onload = function (event) {
                    const wrapper = document.createElement('div');
                    wrapper.style.border = '1px solid #e5e7eb';
                    wrapper.style.borderRadius = '12px';
                    wrapper.style.overflow = 'hidden';
                    wrapper.style.background = 'white';
                    wrapper.style.boxShadow = '0 1px 3px rgba(15,23,42,0.08)';
                    wrapper.style.position = 'relative';

                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.width = '100%';
                    img.style.height = '110px';
                    img.style.objectFit = 'cover';
                    img.style.display = 'block';

                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.textContent = '×';
                    removeButton.title = 'Remove image';
                    removeButton.style.position = 'absolute';
                    removeButton.style.top = '6px';
                    removeButton.style.right = '6px';
                    removeButton.style.width = '26px';
                    removeButton.style.height = '26px';
                    removeButton.style.border = 'none';
                    removeButton.style.borderRadius = '999px';
                    removeButton.style.background = '#dc2626';
                    removeButton.style.color = 'white';
                    removeButton.style.fontWeight = '900';
                    removeButton.style.cursor = 'pointer';

                    removeButton.addEventListener('click', function () {
                        selectedImageFiles.splice(index, 1);
                        updateFileInput();
                        renderImagePreview();
                    });

                    const caption = document.createElement('div');
                    caption.textContent = file.name.length > 18 ? file.name.substring(0, 18) + '...' : file.name;
                    caption.style.padding = '8px';
                    caption.style.fontSize = '12px';
                    caption.style.color = '#64748b';

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeButton);
                    wrapper.appendChild(caption);

                    imagePreview.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            });

            if (selectedImageFiles.length >= 5) {
                const limitNotice = document.createElement('div');
                limitNotice.style.gridColumn = '1 / -1';
                limitNotice.style.background = '#fffbeb';
                limitNotice.style.border = '1px solid #fcd34d';
                limitNotice.style.color = '#92400e';
                limitNotice.style.borderRadius = '10px';
                limitNotice.style.padding = '12px';
                limitNotice.style.fontSize = '13px';
                limitNotice.innerHTML = 'Maximum 5 images selected. <br> সর্বোচ্চ ৫টি ছবি নির্বাচন করা হয়েছে।';

                imagePreview.appendChild(limitNotice);
            }
        }
    </script>
</x-app-layout>