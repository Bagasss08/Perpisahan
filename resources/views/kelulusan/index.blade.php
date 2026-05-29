<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Kelulusan – MI Ma'arif NU Banteran</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:       #1a8a4a;
            --green-light: #e8f5ee;
            --green-mid:   #2fb265;
            --gold:        #c8960a;
            --gold-light:  #fef7e0;
            --gold-mid:    #e8b020;
            --white:       #ffffff;
            --off-white:   #f8faf9;
            --text-dark:   #1a2e22;
            --text-mid:    #3d5a47;
            --text-muted:  #7a9484;
            --border:      rgba(26,138,74,0.15);
            --shadow-sm:   0 2px 12px rgba(26,138,74,0.08);
            --shadow-md:   0 8px 32px rgba(26,138,74,0.13);
            --radius:      16px;
        }

        html, body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--off-white);
            color: var(--text-dark);
        }

        /* ── BG PATTERN ── */
        body {
            background-color: var(--off-white);
            background-image:
                radial-gradient(circle at 20% 20%, rgba(26,138,74,0.06) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(200,150,10,0.05) 0%, transparent 50%);
        }

        /* ── GRID LAYOUT ── */
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .card-container {
            width: 100%;
            max-width: 420px;
        }

        /* ── TOP BADGE ── */
        .top-badge {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .top-badge span {
            display: inline-block;
            background: var(--green-light);
            color: var(--green);
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 100px;
            border: 1px solid rgba(26,138,74,0.2);
        }

        /* ── MAIN CARD ── */
        .main-card {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* ── HEADER SECTION ── */
        .card-header {
            background: linear-gradient(135deg, #1a6b38 0%, #1a8a4a 60%, #24a85a 100%);
            padding: 2rem 1.75rem 1.5rem;
            text-align: center;
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: -1px; left: 0; right: 0;
            height: 28px;
            background: var(--white);
            border-radius: 24px 24px 0 0;
        }

        /* decorative corner dots */
        .card-header::before {
            content: '';
            position: absolute;
            top: 12px; right: 16px;
            width: 60px; height: 60px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,0.15);
        }

        .logo-wrap {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .logo-ring {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            border: 2px solid rgba(255,255,255,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            position: relative;
        }

        .logo-ring img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            background: white;
        }

        /* gold dot badge */
        .logo-ring::after {
            content: '✓';
            position: absolute;
            bottom: 2px; right: 2px;
            width: 22px; height: 22px;
            background: var(--gold-mid);
            border-radius: 50%;
            border: 2px solid var(--white);
            color: white;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .school-name-ar {
            font-family: 'Amiri', serif;
            color: rgba(255,255,255,0.7);
            font-size: 13px;
            margin-bottom: 4px;
            letter-spacing: 0.03em;
        }

        .school-name {
            color: #ffffff;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.01em;
            line-height: 1.25;
        }

        .school-sub {
            color: rgba(255,255,255,0.7);
            font-size: 12px;
            font-weight: 500;
            margin-top: 3px;
        }

        /* ── BODY ── */
        .card-body {
            padding: 1.5rem 1.75rem 2rem;
        }

        /* ── COUNTDOWN ── */
        .countdown-section {
            background: var(--gold-light);
            border: 1px solid rgba(200,150,10,0.2);
            border-radius: var(--radius);
            padding: 1rem 1.25rem;
            margin-bottom: 1.75rem;
        }

        .countdown-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--gold);
            letter-spacing: 0.07em;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 0.65rem;
        }

        .countdown-label span {
            vertical-align: middle;
        }

        .countdown-dot {
            display: inline-block;
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--gold-mid);
            margin-right: 6px;
            animation: pulse 1.4s infinite;
            vertical-align: middle;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.4; transform: scale(0.85); }
        }

        .countdown-tiles {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .tile {
            flex: 1;
            background: var(--white);
            border: 1px solid rgba(200,150,10,0.18);
            border-radius: 10px;
            padding: 8px 4px 6px;
            text-align: center;
            min-width: 0;
        }

        .tile-num {
            font-size: 22px;
            font-weight: 800;
            color: var(--gold);
            line-height: 1;
            font-variant-numeric: tabular-nums;
            letter-spacing: -0.02em;
        }

        .tile-lbl {
            font-size: 9.5px;
            font-weight: 600;
            color: var(--gold);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            opacity: 0.7;
            margin-top: 3px;
        }

        .tile-sep {
            color: var(--gold);
            font-size: 20px;
            font-weight: 700;
            align-self: center;
            opacity: 0.5;
            margin-top: -6px;
            flex-shrink: 0;
        }

        .countdown-sub {
            text-align: center;
            font-size: 11px;
            color: #a07010;
            margin-top: 8px;
            font-weight: 500;
        }

        /* locked overlay */
        .countdown-locked {
            display: none;
            text-align: center;
            padding: 4px 0;
        }

        .countdown-locked .lock-icon {
            font-size: 22px;
            margin-bottom: 4px;
        }

        .countdown-locked p {
            font-size: 12px;
            color: #a07010;
            font-weight: 600;
        }

        /* ── DIVIDER ── */
        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.25rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider-text {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.05em;
            white-space: nowrap;
        }

        /* ── ERROR ── */
        .alert-error {
            background: #fef0f0;
            border: 1px solid #fccaca;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            color: #c0392b;
            font-weight: 500;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .alert-error::before {
            content: '⚠';
            flex-shrink: 0;
            font-size: 14px;
        }

        /* ── FORM ── */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 6px;
            letter-spacing: 0.01em;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: var(--text-muted);
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            height: 48px;
            padding: 0 14px 0 42px;
            background: var(--off-white);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            -webkit-appearance: none;
        }

        .form-input:focus {
            border-color: var(--green);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(26,138,74,0.1);
        }

        .form-input::placeholder {
            color: var(--text-muted);
            font-weight: 400;
        }

        /* date input calendar icon color */
        .form-input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0.5;
            cursor: pointer;
        }

        /* ── SUBMIT BTN ── */
        .btn-submit {
            width: 100%;
            height: 50px;
            margin-top: 1.5rem;
            background: linear-gradient(135deg, #1a6b38, #1a8a4a);
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14.5px;
            font-weight: 700;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 16px rgba(26,138,74,0.3);
            transition: transform 0.15s, box-shadow 0.15s, opacity 0.15s;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26,138,74,0.38);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(26,138,74,0.25);
        }

        .btn-submit svg {
            width: 18px; height: 18px;
            flex-shrink: 0;
        }

        /* disabled state before countdown ends */
        .btn-submit.disabled-locked {
            background: linear-gradient(135deg, #aaa, #bbb);
            box-shadow: none;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ── FOOTER ── */
        .card-footer {
            border-top: 1px solid var(--border);
            padding: 1rem 1.75rem;
            text-align: center;
        }

        .footer-text {
            font-size: 11.5px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .footer-text strong {
            color: var(--green);
            font-weight: 700;
        }

        /* ── BOTTOM INFO ── */
        .bottom-info {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 440px) {
            .card-body { padding: 1.25rem 1.25rem 1.75rem; }
            .card-header { padding: 1.5rem 1.25rem 1.25rem; }
            .tile-num { font-size: 19px; }
        }
    </style>
</head>
<body>

<div class="page-wrapper">
    <div class="card-container">

        <!-- top badge -->
        <div class="top-badge">
            <span>📋 Pengumuman Kelulusan 2025</span>
        </div>

        <div class="main-card">

            <!-- Header -->
            <div class="card-header">
                <div class="logo-wrap">
                    <div class="logo-ring">
                        <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo MI Ma'arif NU Banteran">
                    </div>
                </div>
                <div class="school-name-ar">مدرسة الإبتدائية معارف نهضة العلماء</div>
                <div class="school-name">MI Ma'arif NU Banteran</div>
                <div class="school-sub">Kecamatan Sumbang, Banyumas</div>
            </div>

            <!-- Body -->
            <div class="card-body">

                <!-- Countdown -->
                <div class="countdown-section">
                    <div class="countdown-label">
                        <span class="countdown-dot"></span>
                        <span id="countdown-label-text">Pengumuman dibuka dalam</span>
                    </div>

                    <div class="countdown-tiles" id="countdown-tiles">
                        <div class="tile">
                            <div class="tile-num" id="cd-hari">--</div>
                            <div class="tile-lbl">Hari</div>
                        </div>
                        <div class="tile-sep">:</div>
                        <div class="tile">
                            <div class="tile-num" id="cd-jam">--</div>
                            <div class="tile-lbl">Jam</div>
                        </div>
                        <div class="tile-sep">:</div>
                        <div class="tile">
                            <div class="tile-num" id="cd-menit">--</div>
                            <div class="tile-lbl">Menit</div>
                        </div>
                        <div class="tile-sep">:</div>
                        <div class="tile">
                            <div class="tile-num" id="cd-detik">--</div>
                            <div class="tile-lbl">Detik</div>
                        </div>
                    </div>

                    <div class="countdown-sub" id="countdown-sub">
                        Senin, 02 Juni 2025 &nbsp;•&nbsp; Pukul 15.00 WIB
                    </div>

                    <div class="countdown-locked" id="countdown-locked">
                        <div class="lock-icon">🎉</div>
                        <p>Pengumuman Sudah Dibuka!</p>
                    </div>
                </div>

                <!-- Error alert -->
                @if(session('error'))
                    <div class="alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Divider -->
                <div class="divider">
                    <span class="divider-text">Masukkan data siswa</span>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('cek.kelulusan') }}" id="form-kelulusan">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="nisn">NISN</label>
                        <div class="input-wrap">
                            <span class="input-icon">
                                <!-- id card icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="5" width="20" height="14" rx="3"/>
                                    <circle cx="8" cy="12" r="2"/>
                                    <path d="M13 12h4M13 15.5h4"/>
                                </svg>
                            </span>
                            <input
                                class="form-input"
                                type="text"
                                id="nisn"
                                name="nisn"
                                inputmode="numeric"
                                autocomplete="off"
                                placeholder="Masukkan NISN siswa"
                                maxlength="10"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                        <div class="input-wrap">
                            <span class="input-icon">
                                <!-- calendar icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                            </span>
                            <input
                                class="form-input"
                                type="date"
                                id="tanggal_lahir"
                                name="tanggal_lahir"
                                required
                            >
                        </div>
                    </div>

                    <button type="submit" class="btn-submit" id="btn-cek">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                        Cek Kelulusan
                    </button>

                </form>

            </div>

            <!-- Footer -->
            <div class="card-footer">
                <p class="footer-text">
                    Data kelulusan hanya dapat diakses oleh siswa yang terdaftar.<br>
                    Gunakan <strong>NISN</strong> dan <strong>tanggal lahir</strong> yang sesuai rapor.
                </p>
            </div>

        </div>

        <!-- bottom -->
        <div class="bottom-info">
            © 2025 MI Ma'arif NU Banteran &nbsp;·&nbsp; Kementerian Agama RI<br>
            Dibuat dengan ❤️ untuk siswa-siswi kelas VI
        </div>

    </div>
</div>

<script>
(function() {
    // Target: 2 Juni 2025, pukul 15:00 WIB (UTC+7)
    var target = new Date('2025-06-02T15:00:00+07:00').getTime();

    var tiles     = document.getElementById('countdown-tiles');
    var locked    = document.getElementById('countdown-locked');
    var labelText = document.getElementById('countdown-label-text');
    var subText   = document.getElementById('countdown-sub');
    var btn       = document.getElementById('btn-cek');

    var cdHari  = document.getElementById('cd-hari');
    var cdJam   = document.getElementById('cd-jam');
    var cdMenit = document.getElementById('cd-menit');
    var cdDetik = document.getElementById('cd-detik');

    function pad(n) { return n < 10 ? '0' + n : '' + n; }

    function tick() {
        var now  = Date.now();
        var diff = target - now;

        if (diff <= 0) {
            // Pengumuman sudah dibuka
            tiles.style.display  = 'none';
            subText.style.display = 'none';
            locked.style.display = 'block';
            labelText.textContent = '🎉 Pengumuman resmi sudah dibuka!';
            if (btn.classList.contains('disabled-locked')) {
                btn.classList.remove('disabled-locked');
            }
            return;
        }

        var days    = Math.floor(diff / 86400000);
        var hours   = Math.floor((diff % 86400000) / 3600000);
        var minutes = Math.floor((diff % 3600000) / 60000);
        var seconds = Math.floor((diff % 60000) / 1000);

        cdHari.textContent  = pad(days);
        cdJam.textContent   = pad(hours);
        cdMenit.textContent = pad(minutes);
        cdDetik.textContent = pad(seconds);

        setTimeout(tick, 1000);
    }

    tick();
})();
</script>

</body>
</html>