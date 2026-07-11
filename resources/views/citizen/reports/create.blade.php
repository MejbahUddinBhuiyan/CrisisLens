<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Submit Incident Report
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Report flood, cyclone, damage, blocked road, medical emergency, or shelter needs.
                </p>
            </div>

            <a href="{{ route('citizen.reports.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                My Reports
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-800">
                <p class="font-semibold">Demo Safety Notice</p>
                <p class="mt-1 text-sm">
                    This is demonstration data for CrisisLens. Do not use this form for real emergency reporting.
                    In a real emergency, contact official emergency services immediately.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    <p class="font-semibold">Please fix the following problems:</p>
                    <ul class="mt-2 list-inside list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('citizen.reports.store') }}"
                  enctype="multipart/form-data"
                  class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700">
                            Incident Category
                        </label>
                        <select id="category"
                                name="category"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600">
                            <option value="">Select category</option>
                            <option value="flood" @selected(old('category') === 'flood')>Flood</option>
                            <option value="cyclone" @selected(old('category') === 'cyclone')>Cyclone</option>
                            <option value="road_blocked" @selected(old('category') === 'road_blocked')>Road Blocked</option>
                            <option value="building_damage" @selected(old('category') === 'building_damage')>Building Damage</option>
                            <option value="medical_emergency" @selected(old('category') === 'medical_emergency')>Medical Emergency</option>
                            <option value="shelter_needed" @selected(old('category') === 'shelter_needed')>Shelter Needed</option>
                            <option value="other" @selected(old('category') === 'other')>Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="urgency" class="block text-sm font-semibold text-gray-700">
                            Urgency Level
                        </label>
                        <select id="urgency"
                                name="urgency"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600">
                            <option value="low" @selected(old('urgency') === 'low')>Low</option>
                            <option value="medium" @selected(old('urgency', 'medium') === 'medium')>Medium</option>
                            <option value="high" @selected(old('urgency') === 'high')>High</option>
                            <option value="critical" @selected(old('urgency') === 'critical')>Critical</option>
                        </select>
                    </div>

                    <div>
                        <label for="latitude" class="block text-sm font-semibold text-gray-700">
                            Latitude
                        </label>
                        <input id="latitude"
                               name="latitude"
                               type="number"
                               step="0.0000001"
                               min="-90"
                               max="90"
                               value="{{ old('latitude', '23.8103') }}"
                               required
                               class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600">
                    </div>

                    <div>
                        <label for="longitude" class="block text-sm font-semibold text-gray-700">
                            Longitude
                        </label>
                        <input id="longitude"
                               name="longitude"
                               type="number"
                               step="0.0000001"
                               min="-180"
                               max="180"
                               value="{{ old('longitude', '90.4125') }}"
                               required
                               class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700">
                        Description
                    </label>
                    <textarea id="description"
                              name="description"
                              rows="5"
                              required
                              placeholder="Describe what happened, what help is needed, and any visible damage..."
                              class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600">{{ old('description') }}</textarea>
                    <p class="mt-2 text-xs text-gray-500">
                        Minimum 10 characters. Do not include sensitive personal information unless necessary.
                    </p>
                </div>

                <div class="mt-6">
                    <label for="images" class="block text-sm font-semibold text-gray-700">
                        Upload Images
                    </label>
                    <input id="images"
                           name="images[]"
                           type="file"
                           multiple
                           accept="image/jpeg,image/png,image/webp"
                           class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-teal-700 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-800">
                    <p class="mt-2 text-xs text-gray-500">
                        Maximum 5 images. Supported: JPG, PNG, WEBP. Maximum size: 5MB each.
                    </p>
                </div>

                <div style="margin-top: 32px; display: flex; gap: 12px; justify-content: flex-end; align-items: center; flex-wrap: wrap;">
                    <a href="{{ route('citizen.reports.index') }}"
                       style="display: inline-block; border: 1px solid #cbd5e1; background: white; color: #172033; padding: 10px 18px; border-radius: 8px; font-size: 14px; font-weight: 700; text-decoration: none;">
                        Cancel
                    </a>

                    <button type="submit"
                            style="display: inline-block; border: none; background: #0F766E; color: white; padding: 10px 18px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer;">
                        Submit Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>