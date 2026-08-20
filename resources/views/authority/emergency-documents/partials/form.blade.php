<div style="display:grid; gap:20px;">
    <div>
        <label style="display:block; font-size:14px; font-weight:800; color:#172033;">
            Guide Title (গাইড শিরোনাম)
        </label>

        <input type="text"
               name="title"
               value="{{ old('title', $document?->title) }}"
               required
               placeholder="Example: Flood Safety Guide"
               style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:11px;">
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:18px;">
        <div>
            <label style="display:block; font-size:14px; font-weight:800; color:#172033;">
                Category (ক্যাটাগরি)
            </label>

            <select name="category"
                    required
                    style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:11px;">
                <option value="">Select Category</option>
                <option value="flood_safety" @selected(old('category', $document?->category) === 'flood_safety')>Flood Safety (বন্যা নিরাপত্তা)</option>
                <option value="cyclone_preparation" @selected(old('category', $document?->category) === 'cyclone_preparation')>Cyclone Preparation (ঘূর্ণিঝড় প্রস্তুতি)</option>
                <option value="first_aid" @selected(old('category', $document?->category) === 'first_aid')>First Aid (প্রাথমিক চিকিৎসা)</option>
                <option value="evacuation" @selected(old('category', $document?->category) === 'evacuation')>Evacuation Guide (সরিয়ে নেওয়ার গাইড)</option>
                <option value="shelter_rules" @selected(old('category', $document?->category) === 'shelter_rules')>Shelter Rules (আশ্রয়কেন্দ্রের নিয়ম)</option>
                <option value="general_safety" @selected(old('category', $document?->category) === 'general_safety')>General Safety (সাধারণ নিরাপত্তা)</option>
            </select>
        </div>

        <div>
            <label style="display:block; font-size:14px; font-weight:800; color:#172033;">
                Language (ভাষা)
            </label>

            <select name="language"
                    required
                    style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:11px;">
                <option value="English-Bangla" @selected(old('language', $document?->language ?? 'English-Bangla') === 'English-Bangla')>English-Bangla</option>
                <option value="English" @selected(old('language', $document?->language) === 'English')>English</option>
                <option value="Bangla" @selected(old('language', $document?->language) === 'Bangla')>Bangla</option>
            </select>
        </div>
    </div>

    <div>
        <label style="display:block; font-size:14px; font-weight:800; color:#172033;">
            Guide Content (গাইড কনটেন্ট)
        </label>

        <textarea name="content"
                  rows="13"
                  required
                  placeholder="Write safety guide content here..."
                  style="margin-top:8px; width:100%; border:1px solid #cbd5e1; border-radius:9px; padding:12px; line-height:1.8;">{{ old('content', $document?->content) }}</textarea>

        <p style="margin-top:8px; color:#64748b; font-size:13px; line-height:1.6;">
            You can write English and Bangla together. Use short paragraphs and numbered steps.
            <br>
            ইংরেজি ও বাংলা একসাথে লিখতে পারেন। ছোট প্যারাগ্রাফ এবং নম্বরযুক্ত ধাপ ব্যবহার করুন।
        </p>
    </div>

    <div style="display:grid; gap:12px;">
        <label style="display:flex; align-items:center; gap:10px; font-size:14px; font-weight:800; color:#172033;">
            <input type="checkbox"
                   name="is_active"
                   value="1"
                   @checked(old('is_active', $document?->is_active ?? true))>
            Active / Visible when verified (সক্রিয়)
        </label>

        <label style="display:flex; align-items:center; gap:10px; font-size:14px; font-weight:800; color:#172033;">
            <input type="checkbox"
                   name="is_verified"
                   value="1"
                   @checked(old('is_verified', $document?->is_verified ?? true))>
            Verified for Public Display (জনসাধারণের জন্য যাচাইকৃত)
        </label>
    </div>

    <div style="margin-top:8px; display:flex; justify-content:flex-end; gap:12px; flex-wrap:wrap;">
        <a href="{{ route('authority.emergency-documents.index') }}"
           style="display:inline-block; background:white; color:#172033; padding:11px 18px; border:1px solid #cbd5e1; border-radius:9px; font-size:14px; font-weight:800; text-decoration:none;">
            Cancel (বাতিল)
        </a>

        <button type="submit"
                style="border:none; background:#0F766E; color:white; padding:11px 18px; border-radius:9px; font-size:14px; font-weight:800; cursor:pointer;">
            {{ $buttonText }}
        </button>
    </div>
</div>