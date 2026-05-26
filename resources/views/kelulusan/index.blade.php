@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        min-height: 100vh;
        background: #0c1445;
        overflow-x: hidden;
    }

    /* ── Background layer ── */
    .bg-canvas {
        position: fixed;
        inset: 0;
        z-index: 0;
        background:
            radial-gradient(ellipse 80% 60% at 20% 10%, rgba(22,78,220,0.35) 0%, transparent 60%),
            radial-gradient(ellipse 60% 50% at 80% 80%, rgba(109,40,217,0.28) 0%, transparent 55%),
            radial-gradient(ellipse 50% 40% at 50% 50%, rgba(6,78,59,0.15) 0%, transparent 60%),
            linear-gradient(160deg, #0c1445 0%, #0f172a 100%);
        pointer-events: none;
    }

    .bg-canvas canvas {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
    }

    /* ── Wrapper ── */
    .page-wrap {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.25rem;
        gap: 1.5rem;
    }

    /* ── Header sekolah ── */
    .school-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 0.85rem 1.5rem;
        width: 100%;
        max-width: 520px;
        animation: slide-down 0.7s cubic-bezier(0.16,1,0.3,1) both;
    }

    @keyframes slide-down {
        from { opacity: 0; transform: translateY(-24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .school-emblem {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background: linear-gradient(135deg, #1d4ed8, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(109,40,217,0.4);
    }

    .school-emblem svg { width: 28px; height: 28px; }

    .school-info { line-height: 1.3; }

    .school-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: rgba(255,255,255,0.45);
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .school-name {
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
    }

    .school-sub {
        font-size: 0.78rem;
        color: rgba(255,255,255,0.5);
        font-weight: 500;
    }

    /* ── Kartu utama ── */
    .main-card {
        width: 100%;
        max-width: 520px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 24px;
        padding: 2.5rem 2.25rem;
        animation: slide-up 0.8s cubic-bezier(0.16,1,0.3,1) 0.1s both;
        position: relative;
        overflow: hidden;
    }

    .main-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #06b6d4);
        border-radius: 24px 24px 0 0;
    }

    @keyframes slide-up {
        from { opacity: 0; transform: translateY(32px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Judul ── */
    .card-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.6rem, 5vw, 2.1rem);
        font-weight: 700;
        color: #fff;
        text-align: center;
        line-height: 1.25;
        margin-bottom: 0.4rem;
    }

    .card-title span {
        background: linear-gradient(135deg, #60a5fa, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .card-subtitle {
        text-align: center;
        color: rgba(255,255,255,0.55);
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    /* ── Divider ── */
    .divider {
        height: 1px;
        background: rgba(255,255,255,0.08);
        margin: 1.75rem 0;
    }

    /* ── Countdown ── */
    .countdown-section { margin-bottom: 2rem; }

    .countdown-heading {
        font-size: 0.75rem;
        font-weight: 700;
        color: rgba(255,255,255,0.4);
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: center;
        margin-bottom: 1rem;
    }

    .countdown-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.6rem;
    }

    .cd-box {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 14px;
        padding: 0.85rem 0.5rem 0.7rem;
        text-align: center;
        transition: border-color 0.3s;
    }

    .cd-box.active { border-color: rgba(99,102,241,0.5); }

    .cd-num {
        font-family: 'Playfair Display', serif;
        font-size: 1.9rem;
        font-weight: 700;
        color: #fff;
        line-height: 1;
        display: block;
        transition: transform 0.2s cubic-bezier(0.34,1.56,0.64,1);
    }

    .cd-num.bump { transform: scale(1.25); }

    .cd-label {
        font-size: 0.65rem;
        font-weight: 600;
        color: rgba(255,255,255,0.4);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        display: block;
        margin-top: 4px;
    }

    /* Aksen warna per kotak */
    .cd-box:nth-child(1) .cd-num { color: #93c5fd; }
    .cd-box:nth-child(2) .cd-num { color: #a5b4fc; }
    .cd-box:nth-child(3) .cd-num { color: #c4b5fd; }
    .cd-box:nth-child(4) .cd-num { color: #67e8f9; }

    /* Banner sudah dibuka */
    .opened-banner {
        display: none;
        background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(5,150,105,0.15));
        border: 1px solid rgba(16,185,129,0.4);
        border-radius: 14px;
        padding: 1rem 1.25rem;
        text-align: center;
        margin-bottom: 2rem;
    }

    .opened-banner p {
        font-size: 0.95rem;
        font-weight: 700;
        color: #6ee7b7;
    }

    /* ── Form fields ── */
    .form-group { margin-bottom: 1.1rem; }

    .field-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: rgba(255,255,255,0.6);
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 0.5rem;
    }

    .input-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: rgba(255,255,255,0.3);
        pointer-events: none;
    }

    .field-input {
        width: 100%;
        padding: 0.85rem 1rem 0.85rem 2.8rem;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: #fff;
        outline: none;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        -webkit-appearance: none;
        appearance: none;
    }

    .field-input::placeholder { color: rgba(255,255,255,0.2); font-weight: 500; }

    .field-input:focus {
        border-color: rgba(99,102,241,0.7);
        background: rgba(255,255,255,0.09);
        box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
    }

    /* Warna teks input date di Chrome agar terlihat */
    .field-input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(0.7);
        cursor: pointer;
    }

    /* ── Error ── */
    .error-alert {
        display: flex;
        align-items: flex-start;
        gap: 0.6rem;
        background: rgba(239,68,68,0.12);
        border: 1px solid rgba(239,68,68,0.3);
        border-radius: 12px;
        padding: 0.85rem 1rem;
        margin-bottom: 1.25rem;
    }

    .error-alert svg { width: 16px; height: 16px; color: #f87171; flex-shrink: 0; margin-top: 1px; }
    .error-alert p  { font-size: 0.875rem; color: #fca5a5; font-weight: 600; line-height: 1.4; }

    /* ── Tombol submit ── */
    .btn-submit {
        width: 100%;
        padding: 1rem;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #3b82f6 0%, #6d28d9 100%);
        color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 4px 20px rgba(99,102,241,0.35);
        letter-spacing: 0.3px;
    }

    .btn-submit svg { width: 18px; height: 18px; }

    .btn-submit:hover {
        opacity: 0.92;
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(99,102,241,0.5);
    }

    .btn-submit:active { transform: translateY(0); opacity: 1; }

    /* ── Footer ── */
    .page-footer {
        font-size: 0.75rem;
        font-weight: 600;
        color: rgba(255,255,255,0.2);
        text-align: center;
        animation: slide-up 0.8s ease 0.4s both;
    }

    /* ── Responsive ── */
    @media (max-width: 440px) {
        .main-card { padding: 2rem 1.25rem; }
        .cd-num    { font-size: 1.5rem; }
        .school-header { padding: 0.75rem 1rem; }
    }

    .bg-canvas,
.bg-canvas canvas {
    pointer-events: none;
}

.main-card {
    position: relative;
    z-index: 10;
}
.main-card form{
    position: relative;
    z-index: 999;
}
</style>
@endpush

@section('content')

<div class="bg-canvas">
    <canvas id="starCanvas"></canvas>
</div>

<div class="page-wrap">

    {{-- Header Sekolah --}}
    <div class="school-header">
        <div class="school-emblem">
            <svg viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 2L3 8v1.5h22V8L14 2z" fill="white" opacity="0.9"/>
                <rect x="5"  y="11" width="3" height="11" rx="0.75" fill="white" opacity="0.8"/>
                <rect x="12.5" y="11" width="3" height="11" rx="0.75" fill="white" opacity="0.8"/>
                <rect x="20" y="11" width="3" height="11" rx="0.75" fill="white" opacity="0.8"/>
                <rect x="3"  y="22" width="22" height="2.5" rx="1.25" fill="white" opacity="0.9"/>
                <circle cx="14" cy="7.5" r="1.8" fill="#fbbf24"/>
            </svg>
        </div>
        <div class="school-info">
            <p class="school-label">Madrasah Ibtidaiyah</p>
            <p class="school-name">MI Ma'arif NU Banteran</p>
            <p class="school-sub">Pengumuman Kelulusan Resmi</p>
        </div>
    </div>

    {{-- Kartu Utama --}}
    <div class="main-card">

        <h1 class="card-title">Cek <span>Kelulusan</span> Kamu</h1>
        <p class="card-subtitle">
            Masukkan NISN dan tanggal lahir untuk melihat hasil kelulusan tahun ini.
        </p>

        {{-- Countdown --}}
        <div class="countdown-section">
            <p class="countdown-heading" id="cdHeading">Pengumuman dibuka dalam</p>
            <div class="countdown-row" id="countdownRow">
                <div class="cd-box">
                    <span class="cd-num" id="cdDays">00</span>
                    <span class="cd-label">Hari</span>
                </div>
                <div class="cd-box">
                    <span class="cd-num" id="cdHours">00</span>
                    <span class="cd-label">Jam</span>
                </div>
                <div class="cd-box">
                    <span class="cd-num" id="cdMins">00</span>
                    <span class="cd-label">Menit</span>
                </div>
                <div class="cd-box">
                    <span class="cd-num" id="cdSecs">00</span>
                    <span class="cd-label">Detik</span>
                </div>
            </div>
            <div class="opened-banner" id="openedBanner">
                <p>✓ Pengumuman telah dibuka — silakan cek hasil kelulusanmu.</p>
            </div>
        </div>

        <div class="divider"></div>

        {{-- Form --}}
        <form action="{{ route('cek.kelulusan') }}" method="POST">
            @csrf

            @if ($errors->any())
            <div class="error-alert">
                <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                <p>{{ $errors->first() }}</p>
            </div>
            @endif

            <div class="form-group">
                <label class="field-label" for="nisn">NISN</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg>
                    <input
                        type="text"
                        id="nisn"
                        name="nisn"
                        class="field-input"
                        placeholder="Masukkan 10 digit NISN"
                        maxlength="10"
                        inputmode="numeric"
                       
                        value="{{ old('nisn') }}"
                        required
                        autocomplete="off"
                    >
                </div>
            </div>

            <div class="form-group">
                <label class="field-label" for="tanggal_lahir">Tanggal Lahir</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                    <input
                        type="date"
                        id="tanggal_lahir"
                        name="tanggal_lahir"
                        class="field-input"
                        value="{{ old('tanggal_lahir') }}"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9 9a2 2 0 114 0 2 2 0 01-4 0z"/><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a4 4 0 00-3.446 6.032l-2.261 2.26a1 1 0 101.414 1.415l2.261-2.261A4 4 0 1011 5z" clip-rule="evenodd"/></svg>
                Lihat Hasil Kelulusan
            </button>
        </form>

    </div>

    <p class="page-footer">
        &copy; {{ date('Y') }} MI Ma'arif NU Banteran &nbsp;&middot;&nbsp; Tahun Pelajaran 2025/2026
    </p>

</div>

<script>
(function () {

    /* ── Partikel bintang ringan di background ── */
    const canvas = document.getElementById('starCanvas');
    const ctx    = canvas.getContext('2d');
    let W, H, stars = [];

    function resize() {
        W = canvas.width  = window.innerWidth;
        H = canvas.height = window.innerHeight;
    }

    function initStars() {
        stars = Array.from({ length: 90 }, () => ({
            x:   Math.random() * W,
            y:   Math.random() * H,
            r:   Math.random() * 1.4 + 0.4,
            a:   Math.random(),
            da:  (Math.random() * 0.006 + 0.002) * (Math.random() > 0.5 ? 1 : -1),
            dy:  Math.random() * 0.12 + 0.04,
        }));
    }

    function drawStars() {
        ctx.clearRect(0, 0, W, H);
        for (const s of stars) {
            s.a  += s.da;
            s.y  -= s.dy;
            if (s.a > 1)  { s.a = 1;  s.da *= -1; }
            if (s.a < 0)  { s.a = 0;  s.da *= -1; }
            if (s.y < -4) { s.y = H + 4; s.x = Math.random() * W; }

            ctx.beginPath();
            ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(180,200,255,${s.a * 0.6})`;
            ctx.fill();
        }
        requestAnimationFrame(drawStars);
    }

    resize();
    initStars();
    drawStars();
    window.addEventListener('resize', () => { resize(); initStars(); });

    /* ── Countdown ── */
    const TARGET   = new Date("May 30, 2026 08:00:00").getTime();
    const elDays   = document.getElementById('cdDays');
    const elHours  = document.getElementById('cdHours');
    const elMins   = document.getElementById('cdMins');
    const elSecs   = document.getElementById('cdSecs');
    const cdRow    = document.getElementById('countdownRow');
    const banner   = document.getElementById('openedBanner');
    const cdHead   = document.getElementById('cdHeading');
    let   prevSecs = -1;

    function pad(n) { return String(n).padStart(2, '0'); }

    function bump(el) {
        el.classList.remove('bump');
        void el.offsetWidth;
        el.classList.add('bump');
        setTimeout(() => el.classList.remove('bump'), 250);
    }

    function tick() {
        const dist = TARGET - Date.now();

        if (dist <= 0) {
            cdRow.style.display  = 'none';
            cdHead.style.display = 'none';
            banner.style.display = 'block';
            return;
        }

        const d = Math.floor(dist / 86400000);
        const h = Math.floor((dist % 86400000) / 3600000);
        const m = Math.floor((dist % 3600000)  / 60000);
        const s = Math.floor((dist % 60000)    / 1000);

        elDays.textContent  = pad(d);
        elHours.textContent = pad(h);
        elMins.textContent  = pad(m);

        if (s !== prevSecs) {
            const prev = prevSecs;
            elSecs.textContent = pad(s);
            bump(elSecs);
            if (s === 59) bump(elMins);
            if (s === 59 && m === 59) bump(elHours);
            prevSecs = s;
        }
    }

    tick();
    setInterval(tick, 1000);

    /* ── Validasi NISN: hanya angka ── */
    document.getElementById('nisn').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });

})();
</script>
@endsection