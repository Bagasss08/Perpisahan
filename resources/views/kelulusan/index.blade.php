<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Kelulusan – MI Ma'arif NU Banteran</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Amiri:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --green: #1a8a4a;
            --green-dark: #1a6b38;
            --green-light: #e8f5ee;
            --green-mid: #2fb265;
            --gold: #b8870a;
            --gold-light: #fef7e0;
            --gold-mid: #e8b020;
            --white: #ffffff;
            --off-white: #f5f8f6;
            --text-dark: #1a2e22;
            --text-mid: #3d5a47;
            --text-muted: #7a9484;
            --border: rgba(26, 138, 74, 0.14);
            --shadow-md: 0 8px 40px rgba(26, 138, 74, 0.12);
            --radius: 16px;
        }

        html,
        body {
            min-height: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--off-white);
            color: var(--text-dark);
        }

        body {
            background-image:
                radial-gradient(ellipse at 15% 10%, rgba(26, 138, 74, 0.07) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 90%, rgba(200, 150, 10, 0.05) 0%, transparent 55%);
        }

        /* ── PAGE WRAPPER ── */
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1rem;
        }

        .card-container {
            width: 100%;
            max-width: 430px;
        }

        /* ── TOP BADGE ── */
        .top-badge {
            text-align: center;
            margin-bottom: 1.25rem;
        }

        .top-badge span {
            display: inline-block;
            background: var(--green-light);
            color: var(--green);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            padding: 5px 15px;
            border-radius: 100px;
            border: 1px solid rgba(26, 138, 74, 0.22);
        }

        /* ── MAIN CARD ── */
        .main-card {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* ── CARD HEADER ── */
        .card-header {
            background: linear-gradient(150deg, #1a5e30 0%, #1a8a4a 55%, #22a356 100%);
            padding: 2.25rem 2rem 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* decorative circles */
        .card-header::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, 0.1);
        }

        .deco-circle {
            position: absolute;
            bottom: 20px;
            left: -20px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            pointer-events: none;
        }

        /* white wave at bottom */
        .card-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 32px;
            background: var(--white);
            border-radius: 28px 28px 0 0;
        }

        /* ── LOGO ── */
        .logo-outer {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.13);
            border: 2px solid rgba(255, 255, 255, 0.32);
            margin-bottom: 1.1rem;
            position: relative;
        }

        .logo-outer img {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            object-fit: cover;
            background: #fff;
            display: block;
        }

        /* verified badge */
        .logo-badge {
            position: absolute;
            bottom: 3px;
            right: 3px;
            width: 24px;
            height: 24px;
            background: var(--gold-mid);
            border-radius: 50%;
            border: 2.5px solid var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: #fff;
            font-weight: 800;
            line-height: 1;
        }

        .school-name-ar {
            font-family: 'Amiri', serif;
            color: rgba(255, 255, 255, 0.72);
            font-size: 14px;
            margin-bottom: 6px;
            letter-spacing: 0.02em;
            line-height: 1.6;
        }

        .school-name {
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.015em;
            line-height: 1.2;
        }

        .school-sub {
            color: rgba(255, 255, 255, 0.65);
            font-size: 12.5px;
            font-weight: 500;
            margin-top: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .school-sub::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
        }

        .school-sub::after {
            content: '';
            display: inline-block;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
        }

        /* ── CARD BODY ── */
        .card-body {
            padding: 1.6rem 1.75rem 2rem;
        }

        /* ── COUNTDOWN ── */
        .countdown-section {
            background: var(--gold-light);
            border: 1px solid rgba(184, 135, 10, 0.2);
            border-radius: var(--radius);
            padding: 1.1rem 1.15rem 1rem;
            margin-bottom: 1.75rem;
        }

        .countdown-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--gold);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .live-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--gold-mid);
            flex-shrink: 0;
            animation: blink 1.4s ease-in-out infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        /* tiles row */
        .countdown-tiles {
            display: grid;
            grid-template-columns: 1fr auto 1fr auto 1fr auto 1fr;
            align-items: center;
            gap: 0;
        }

        .tile {
            background: var(--white);
            border: 1px solid rgba(184, 135, 10, 0.2);
            border-radius: 10px;
            padding: 9px 4px 7px;
            text-align: center;
        }

        .tile-num {
            font-size: 24px;
            font-weight: 800;
            color: var(--gold);
            line-height: 1;
            font-variant-numeric: tabular-nums;
        }

        .tile-lbl {
            font-size: 9px;
            font-weight: 700;
            color: var(--gold);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            opacity: 0.65;
            margin-top: 3px;
        }

        .tile-sep {
            color: var(--gold);
            font-size: 18px;
            font-weight: 700;
            opacity: 0.45;
            text-align: center;
            padding: 0 5px;
            margin-bottom: 10px;
        }

        .countdown-sub {
            text-align: center;
            font-size: 11px;
            color: #9a7010;
            margin-top: 9px;
            font-weight: 600;
        }

        /* opened state */
        .countdown-opened {
            display: none;
            text-align: center;
            padding: 0.25rem 0;
        }

        .countdown-opened .open-emoji {
            font-size: 24px;
            margin-bottom: 4px;
        }

        .countdown-opened p {
            font-size: 13px;
            color: #8a7010;
            font-weight: 700;
        }

        /* ── ERROR ALERT ── */
        .alert-error {
            background: #fff0f0;
            border: 1px solid #f5c2c2;
            border-radius: 10px;
            padding: 10px 14px 10px 12px;
            font-size: 13px;
            color: #b91c1c;
            font-weight: 500;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.5;
        }

        .alert-error-icon {
            font-size: 15px;
            flex-shrink: 0;
            margin-top: 1px;
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

        .divider span {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* ── FORM ── */
        .form-group {
            margin-bottom: 1.05rem;
        }

        label.form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 6px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            display: flex;
            align-items: center;
        }

        .form-input {
            width: 100%;
            height: 48px;
            padding: 0 14px 0 42px;
            background: var(--off-white);
            border: 1.5px solid rgba(26, 138, 74, 0.18);
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
            -webkit-appearance: none;
            appearance: none;
        }

        .form-input:focus {
            border-color: var(--green);
            background: var(--white);
            box-shadow: 0 0 0 3.5px rgba(26, 138, 74, 0.1);
        }

        .form-input::placeholder {
            color: var(--text-muted);
            font-weight: 400;
        }

        .form-input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0.4;
            cursor: pointer;
        }

        /* ── SUBMIT BUTTON ── */
        .btn-submit {
            width: 100%;
            height: 50px;
            margin-top: 1.5rem;
            background: linear-gradient(135deg, var(--green-dark), var(--green));
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 18px rgba(26, 138, 74, 0.32);
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 22px rgba(26, 138, 74, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(26, 138, 74, 0.2);
        }

        .btn-submit svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* ── CARD FOOTER ── */
        .card-footer {
            border-top: 1px solid var(--border);
            padding: 1rem 1.75rem;
            text-align: center;
        }

        .footer-text {
            font-size: 11.5px;
            color: var(--text-muted);
            line-height: 1.65;
        }

        .footer-text strong {
            color: var(--green);
            font-weight: 700;
        }

        /* ── BOTTOM NOTE ── */
        .bottom-note {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1.75;
        }

        /* ─────────────────────────────
           RESPONSIVE — MOBILE
        ───────────────────────────── */
        @media (max-width: 480px) {
            .page-wrapper {
                padding: 1.5rem 0.85rem;
                align-items: flex-start;
            }

            .card-container {
                max-width: 100%;
            }

            .card-header {
                padding: 2rem 1.5rem 2.25rem;
            }

            .logo-outer {
                width: 84px;
                height: 84px;
                margin-bottom: 0.9rem;
            }

            .logo-outer img {
                width: 66px;
                height: 66px;
            }

            .logo-badge {
                width: 21px;
                height: 21px;
                font-size: 10px;
            }

            .school-name-ar {
                font-size: 13px;
            }

            .school-name {
                font-size: 16px;
            }

            .school-sub {
                font-size: 12px;
            }

            .card-body {
                padding: 1.4rem 1.25rem 1.75rem;
            }

            .countdown-section {
                padding: 1rem 1rem 0.9rem;
            }

            .tile-num {
                font-size: 20px;
            }

            .tile-lbl {
                font-size: 8.5px;
            }

            .tile-sep {
                font-size: 16px;
                padding: 0 3px;
            }

            .card-footer {
                padding: 0.9rem 1.25rem;
            }
        }

        @media (max-width: 360px) {
            .tile-num {
                font-size: 17px;
            }

            .tile-sep {
                padding: 0 2px;
                font-size: 14px;
            }

            .tile {
                padding: 8px 2px 6px;
                border-radius: 8px;
            }
        }
    </style>
</head>

<body>

    <div class="page-wrapper">
        <div class="card-container">

            <!-- top badge -->
            <div class="top-badge">
                <span>📋 Pengumuman Kelulusan 2026</span>
            </div>

            <div class="main-card">

                <!-- ── HEADER ── -->
                <div class="card-header">
                    <span class="deco-circle"></span>

                    <div class="logo-outer">
                        <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo MI Ma'arif NU Banteran">
                        <div class="logo-badge">✓</div>
                    </div>

                    <div class="school-name-ar">مدرسة الإبتدائية معارف نهضة العلماء</div>
                    <div class="school-name">MI Ma'arif NU Banteran</div>
                    <div class="school-sub">Kecamatan Sumbang, Banyumas</div>
                </div>

                <!-- ── BODY ── -->
                <div class="card-body">

                    <!-- Countdown -->
                    <div class="countdown-section">
                        <div class="countdown-label">
                            <span class="live-dot"></span>
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
                            Selasa, 02 Juni 2026 &nbsp;·&nbsp; Pukul 15.00 WIB
                        </div>

                        <div class="countdown-opened" id="countdown-opened">
                            <div class="open-emoji">🎉</div>
                            <p>Pengumuman Resmi Sudah Dibuka!</p>
                        </div>
                    </div>

                    <!-- Error session -->
                    @if(session('error'))
                        <div class="alert-error">
                            <span class="alert-error-icon">⚠️</span>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Divider -->
                    <div class="divider">
                        <span>Masukkan data siswa</span>
                    </div>

                    <!-- Form -->
                    <div id="form-kelulusan" style="display:none;">
                        <form method="POST" action="{{ route('cek.kelulusan') }}">
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="nisn">NISN</label>
                                <div class="input-wrap">
                                    <span class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="5" width="20" height="14" rx="3" />
                                            <circle cx="8.5" cy="12" r="1.5" />
                                            <path d="M13 10.5h4M13 13.5h4" />
                                        </svg>
                                    </span>
                                    <input class="form-input" type="text" id="nisn" name="nisn" inputmode="numeric"
                                        autocomplete="off" placeholder="Masukkan NISN siswa" maxlength="10" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                <div class="input-wrap">
                                    <span class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" />
                                            <path d="M16 2v4M8 2v4M3 10h18" />
                                        </svg>
                                    </span>
                                    <input class="form-input" type="date" id="tanggal_lahir" name="tanggal_lahir"
                                        required>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.35-4.35" />
                                </svg>
                                Cek Kelulusan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- ── FOOTER ── -->
                <div class="card-footer">
                    <p class="footer-text">
                        Data kelulusan hanya dapat diakses oleh siswa yang terdaftar.<br>
                        Gunakan <strong>NISN</strong> dan <strong>tanggal lahir</strong> sesuai rapor.
                    </p>
                </div>

            </div>

            <div class="bottom-note">
                © 2026 MI Ma'arif NU Banteran &nbsp;·&nbsp; Kementerian Agama RI<br>
                Dibuat dengan ❤️ untuk siswa-siswi kelas VI
            </div>

        </div>
    </div>

    <script>
        (function () {
            // Target: 2 Juni 2026, pukul 15:00 WIB (UTC+7)
            // UBAH TANGGAL DI SINI
            const TANGGAL_PENGUMUMAN = '2026-06-02T15:00:00+07:00';

            var target = new Date(TANGGAL_PENGUMUMAN).getTime();

            var elTiles = document.getElementById('countdown-tiles');
            var elOpened = document.getElementById('countdown-opened');
            var elForm = document.getElementById('form-kelulusan');
            var elLabel = document.getElementById('countdown-label-text');
            var elSub = document.getElementById('countdown-sub');

            var elHari = document.getElementById('cd-hari');
            var elJam = document.getElementById('cd-jam');
            var elMenit = document.getElementById('cd-menit');
            var elDetik = document.getElementById('cd-detik');

            function pad(n) { return n < 10 ? '0' + n : '' + n; }

            function tick() {
                var diff = target - Date.now();

                if (diff <= 0) {

                    // countdown selesai
                    elTiles.style.display = 'none';
                    elSub.style.display = 'none';
                    elOpened.style.display = 'block';
                    elForm.style.display = 'block';

                    elLabel.textContent = '🎉 Pengumuman resmi sudah dibuka!';

                    return;
                }

                // countdown masih berjalan
                elForm.style.display = 'none';

                var d = Math.floor(diff / 86400000);
                var h = Math.floor((diff % 86400000) / 3600000);
                var m = Math.floor((diff % 3600000) / 60000);
                var s = Math.floor((diff % 60000) / 1000);

                elHari.textContent = pad(d);
                elJam.textContent = pad(h);
                elMenit.textContent = pad(m);
                elDetik.textContent = pad(s);

                setTimeout(tick, 1000);
            }

            tick();
        }());
    </script>

</body>

</html>