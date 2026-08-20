<div {{ $attributes->merge(['style' => 'display:flex; align-items:center; gap:10px;']) }}>
    <div style="
        width:42px;
        height:42px;
        border-radius:12px;
        background:#006A4E;
        display:flex;
        align-items:center;
        justify-content:center;
        position:relative;
        box-shadow:0 2px 8px rgba(15,23,42,0.15);
    ">
        <div style="
            width:18px;
            height:18px;
            border-radius:999px;
            background:#F42A41;
            position:absolute;
            right:8px;
            top:12px;
        "></div>

        <span style="
            position:relative;
            z-index:2;
            color:white;
            font-size:14px;
            font-weight:900;
            letter-spacing:-0.5px;
        ">
            CL
        </span>
    </div>

    <div style="line-height:1.05;">
        <div style="font-size:22px; font-weight:900; letter-spacing:-0.8px;">
            <span style="color:#006A4E;">Crisis</span><span style="color:#F42A41;">Lens</span>
        </div>

        <div style="font-size:11px; color:#64748b; font-weight:700; margin-top:3px;">
            Disaster Intelligence
        </div>
    </div>
</div>