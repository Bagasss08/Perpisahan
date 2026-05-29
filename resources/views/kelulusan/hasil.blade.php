@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --ig-bg: #fafafa;
        --ig-surface: #ffffff;
        --ig-border: #dbdbdb;
        --ig-text: #262626;
        --ig-muted: #8e8e8e;
        --ig-accent: #0095f6;
        --ig-red: #ff3040;
        --ig-topbar-h: 56px;
        --ig-bottomnav-h: 52px;
        --card-max: 480px;
    }

    /* ── PAGE ENTER ANIMATION ── */
    @keyframes pageSlideIn {
        from { opacity: 0; transform: translateY(32px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes overlayFadeOut {
        0%   { opacity: 1; }
        70%  { opacity: 1; }
        100% { opacity: 0; pointer-events: none; }
    }
    @keyframes celebrationBanner {
        0%   { opacity: 0; transform: translateY(-100%) scale(0.9); }
        15%  { opacity: 1; transform: translateY(0) scale(1.04); }
        25%  { transform: translateY(0) scale(1); }
        75%  { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(-40px); }
    }
    @keyframes glowPulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(86,171,47,0.4); }
        50%       { box-shadow: 0 0 0 16px rgba(86,171,47,0); }
    }
    @keyframes glowPulsePurple {
        0%, 100% { box-shadow: 0 0 0 0 rgba(139,92,246,0.4); }
        50%       { box-shadow: 0 0 0 16px rgba(139,92,246,0); }
    }

    /* ── TRANSITION OVERLAY ── */
    #page-overlay {
        position: fixed; inset: 0; z-index: 9999;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 20px;
        pointer-events: all;
    }
    #page-overlay.lulus-overlay {
        background: linear-gradient(135deg, #0d2414 0%, #0a1f0a 50%, #071510 100%);
        animation: overlayFadeOut 2.8s ease forwards;
    }
    #page-overlay.gagal-overlay {
        background: linear-gradient(135deg, #1a0d2e 0%, #0d071f 50%, #070410 100%);
        animation: overlayFadeOut 2.4s ease forwards;
    }

    .overlay-logo {
        width: 80px; height: 80px; border-radius: 50%;
        overflow: hidden; border: 3px solid rgba(255,255,255,0.2);
        animation: pageSlideIn 0.5s ease both;
    }
    .overlay-logo img { width: 100%; height: 100%; object-fit: cover; }

    .overlay-text {
        text-align: center;
        animation: pageSlideIn 0.5s 0.15s ease both;
    }
    .overlay-title-lulus {
        font-family: 'Playfair Display', serif;
        font-size: clamp(32px, 10vw, 52px);
        font-weight: 900;
        background: linear-gradient(135deg, #6dd400 0%, #a8e063 40%, #ffe066 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        line-height: 1.1; margin-bottom: 8px;
    }
    .overlay-title-gagal {
        font-family: 'Playfair Display', serif;
        font-size: clamp(24px, 8vw, 40px);
        font-weight: 900;
        background: linear-gradient(135deg, #c084fc 0%, #f472b6 50%, #818cf8 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        line-height: 1.1; margin-bottom: 8px;
    }
    .overlay-sub {
        color: rgba(255,255,255,0.6);
        font-family: 'DM Sans', sans-serif;
        font-size: 14px; letter-spacing: 0.04em;
    }
    .overlay-name {
        color: rgba(255,255,255,0.9);
        font-family: 'DM Sans', sans-serif;
        font-size: 18px; font-weight: 700;
        margin-top: 6px;
    }

    /* ── CELEBRATION BANNER ── */
    #celebration-banner {
        position: fixed; top: 0; left: 0; right: 0; z-index: 8888;
        background: linear-gradient(90deg, #56ab2f, #a8e063, #ffe066, #56ab2f);
        background-size: 200% auto;
        animation: celebrationBanner 3.5s 0.8s ease forwards, gradientShift 1.5s linear infinite;
        padding: 14px 20px;
        text-align: center;
        display: none;
    }
    #celebration-banner.show { display: block; }
    @keyframes gradientShift {
        to { background-position: 200% center; }
    }
    .banner-text {
        font-family: 'Playfair Display', serif;
        font-size: 16px; font-weight: 700;
        color: #0d2414; letter-spacing: 0.05em;
    }

    body {
        background: var(--ig-bg);
        font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        color: var(--ig-text);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        overflow-x: hidden;
    }

    /* ── MAIN CONTENT animate in ── */
    #main-content {
        animation: pageSlideIn 0.6s 0.3s ease both;
    }

    /* ── TOPBAR ── */
    .ig-topbar {
        position: sticky; top: 0; z-index: 200;
        background: var(--ig-surface);
        border-bottom: 1px solid var(--ig-border);
        display: flex; align-items: center; justify-content: space-between;
        padding: 0 16px; height: var(--ig-topbar-h);
        max-width: 100vw;
    }
    .ig-logo {
        font-family: 'Dancing Script', cursive;
        font-size: 26px; font-weight: 700; color: var(--ig-text);
        letter-spacing: -0.5px; text-decoration: none; line-height: 1;
    }
    .ig-top-icons { display: flex; align-items: center; gap: 16px; }
    .ig-icon-btn {
        background: none; border: none; cursor: pointer;
        color: var(--ig-text); padding: 6px; display: flex; align-items: center;
        position: relative; border-radius: 50%; transition: background 0.15s;
        -webkit-tap-highlight-color: transparent;
    }
    .ig-icon-btn:active { background: #f0f0f0; }
    .ig-icon-btn svg { width: 24px; height: 24px; }
    .notif-dot {
        width: 8px; height: 8px; background: var(--ig-red); border-radius: 50%;
        border: 1.5px solid #fff; position: absolute; top: 3px; right: 3px;
    }

    /* ── PAGE LAYOUT ── */
    .ig-page {
        display: flex; justify-content: center;
        padding: 12px 0 calc(var(--ig-bottomnav-h) + 16px);
    }
    @media (min-width: 600px) {
        .ig-page { padding: 24px 16px calc(var(--ig-bottomnav-h) + 24px); }
    }
    @media (min-width: 769px) {
        .ig-page { padding: 28px 16px 40px; }
    }
    .ig-feed { width: 100%; max-width: var(--card-max); }

    /* ── POST CARD ── */
    .post-card {
        background: var(--ig-surface);
        border-top: 1px solid var(--ig-border);
        border-bottom: 1px solid var(--ig-border);
    }
    @media (min-width: 600px) {
        .post-card {
            border: 1px solid var(--ig-border);
            border-radius: 10px;
            overflow: hidden;
        }
    }

    /* ── POST HEADER ── */
    .post-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 10px 12px;
    }
    .post-user { display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit; }
    .post-avatar-wrap {
        width: 42px; height: 42px; border-radius: 50%; padding: 2px;
        background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4);
        flex-shrink: 0; position: relative;
    }
    .post-avatar-inner {
        width: 100%; height: 100%; border-radius: 50%; border: 2px solid #fff;
        background: #efefef; overflow: hidden;
        display: flex; align-items: center; justify-content: center;
    }
    .post-avatar-inner img {
        width: 100%; height: 100%; object-fit: cover; border-radius: 50%;
    }
    .post-username { font-size: 13.5px; font-weight: 700; line-height: 1.3; }
    .post-location { font-size: 11px; color: var(--ig-text); line-height: 1.2; opacity: 0.75; }
    .post-more {
        background: none; border: none; cursor: pointer; font-size: 18px;
        color: var(--ig-text); font-weight: 700; letter-spacing: 2px;
        padding: 6px 10px; line-height: 1; border-radius: 4px; transition: background 0.15s;
        -webkit-tap-highlight-color: transparent;
    }
    .post-more:active { background: #f0f0f0; }

    /* ════════════════════════════════════════
       ── POST VISUAL ──
    ════════════════════════════════════════ */
    .post-visual {
        width: 100%;
        aspect-ratio: 1 / 1;
        position: relative; overflow: hidden;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
    }

    /* LULUS — deep navy with gold accents */
    .post-visual-lulus {
        background: radial-gradient(ellipse at 30% 20%, #1a3a4a 0%, #0d1f2d 40%, #071219 100%);
    }
    .post-visual-lulus .post-avatar-ring { animation: glowPulse 2s ease-in-out infinite; }

    /* BELUM LULUS — deep purple */
    .post-visual-gagal {
        background: radial-gradient(ellipse at 30% 20%, #2d1b4e 0%, #1a0f33 40%, #0d0620 100%);
    }
    .post-visual-gagal .post-avatar-ring { animation: glowPulsePurple 2s ease-in-out infinite; }

    /* ── Decorative rings ── */
    .deco-ring {
        position: absolute; border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.06);
        pointer-events: none;
    }
    .ring-1 { width: 500px; height: 500px; top: -180px; right: -180px; }
    .ring-2 { width: 350px; height: 350px; top: -100px; right: -100px; border-color: rgba(255,255,255,0.04); }
    .ring-3 { width: 500px; height: 500px; bottom: -200px; left: -180px; }

    /* ── Glowing orbs ── */
    .orb { position: absolute; border-radius: 50%; filter: blur(70px); pointer-events: none; }
    .post-visual-lulus .orb-1 { width: 260px; height: 260px; background: #1a7a3c; top: -60px; right: -40px; opacity: 0.5; }
    .post-visual-lulus .orb-2 { width: 200px; height: 200px; background: #d4a017; bottom: -40px; left: -20px; opacity: 0.3; }
    .post-visual-lulus .orb-3 { width: 150px; height: 150px; background: #56ab2f; top: 50%; left: 50%; transform: translate(-50%,-50%); opacity: 0.15; }
    .post-visual-gagal .orb-1 { width: 260px; height: 260px; background: #7b2ff7; top: -60px; right: -40px; opacity: 0.45; }
    .post-visual-gagal .orb-2 { width: 200px; height: 200px; background: #e040fb; bottom: -40px; left: -20px; opacity: 0.25; }
    .post-visual-gagal .orb-3 { width: 150px; height: 150px; background: #ff6b9d; top: 50%; left: 50%; transform: translate(-50%,-50%); opacity: 0.12; }

    /* ── Stars ── */
    .stars-layer { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .star {
        position: absolute; border-radius: 50%; background: #ffffff;
        animation: starTwinkle ease-in-out infinite;
    }
    @keyframes starTwinkle {
        0%, 100% { opacity: 0.15; transform: scale(0.8); }
        50%       { opacity: 0.9; transform: scale(1.2); }
    }

    /* ── Shine lines ── */
    .shine-line {
        position: absolute; pointer-events: none;
        width: 2px; height: 200%;
        background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.06), transparent);
        transform: rotate(35deg); top: -50%; left: 20%;
    }
    .shine-line-2 { left: 55%; background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.04), transparent); }

    /* ── Visual content wrapper ── */
    .visual-content {
        position: relative; z-index: 5;
        display: flex; flex-direction: column; align-items: center;
        width: 100%; padding: 16px 20px;
        text-align: center;
    }

    /* ── School badge (logo) ── */
    .visual-school-badge {
        display: flex; align-items: center; gap: 8px;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 100px;
        padding: 5px 14px 5px 6px;
        margin-bottom: 14px;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    .badge-logo {
        width: 28px; height: 28px; border-radius: 50%;
        overflow: hidden; flex-shrink: 0;
        border: 1.5px solid rgba(255,255,255,0.2);
    }
    .badge-logo img { width: 100%; height: 100%; object-fit: cover; }
    .badge-text {
        font-size: 10px; font-weight: 700; letter-spacing: 0.1em;
        text-transform: uppercase; color: rgba(255,255,255,0.8);
    }

    /* ── Big emoji ── */
    .visual-emoji {
        font-size: clamp(48px, 14vw, 62px); line-height: 1;
        display: block; margin-bottom: 12px;
        animation: floatEmoji 3s ease-in-out infinite;
        filter: drop-shadow(0 8px 24px rgba(0,0,0,0.3));
    }
    @keyframes floatEmoji {
        0%, 100% { transform: translateY(0) rotate(-3deg); }
        50%       { transform: translateY(-10px) rotate(3deg); }
    }

    /* ── Status text ── */
    .visual-status-wrap { position: relative; margin-bottom: 12px; }
    .visual-status {
        font-family: 'Playfair Display', serif;
        font-size: clamp(24px, 7vw, 40px);
        font-weight: 900; line-height: 1.05;
        letter-spacing: -0.01em; display: block;
    }
    .visual-status-lulus {
        background: linear-gradient(135deg, #6dd400 0%, #a8e063 40%, #ffe066 70%, #56ab2f 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        filter: drop-shadow(0 0 20px rgba(86,171,47,0.5));
    }
    .visual-status-gagal {
        background: linear-gradient(135deg, #c084fc 0%, #f472b6 50%, #818cf8 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        filter: drop-shadow(0 0 20px rgba(192,132,252,0.5));
    }

    /* ── Divider ── */
    .visual-divider { width: 60px; height: 2px; border-radius: 2px; margin: 2px auto 12px; }
    .post-visual-lulus .visual-divider { background: linear-gradient(90deg, transparent, #a8e063, transparent); }
    .post-visual-gagal .visual-divider { background: linear-gradient(90deg, transparent, #c084fc, transparent); }

    /* ── Name card ── */
    .visual-name-card {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 14px; padding: 11px 26px;
        backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
        margin-bottom: 8px; min-width: 160px;
    }
    .visual-name { color: #ffffff; font-size: 18px; font-weight: 700; letter-spacing: 0.01em; text-shadow: 0 2px 12px rgba(0,0,0,0.4); }
    .visual-meta { color: rgba(255,255,255,0.5); font-size: 11px; margin-top: 3px; letter-spacing: 0.06em; }

    /* ── Bottom stamp ── */
    .visual-stamp-row { display: flex; align-items: center; gap: 6px; margin-top: 10px; }
    .stamp-dot { width: 4px; height: 4px; border-radius: 50%; background: rgba(255,255,255,0.3); }
    .stamp-text { font-size: 9px; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(255,255,255,0.35); }

    /* ── Slide dots ── */
    .visual-dots {
        position: absolute; bottom: 12px; left: 0; right: 0;
        display: flex; justify-content: center; gap: 5px; z-index: 6;
    }
    .visual-dots span { width: 5px; height: 5px; border-radius: 50%; background: rgba(255,255,255,0.35); transition: all 0.2s; }
    .visual-dots span.active { background: #fff; width: 18px; border-radius: 3px; }

    /* ── Heart overlay ── */
    .heart-overlay { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; pointer-events: none; z-index: 10; }
    .heart-burst { font-size: 90px; opacity: 0; transform: scale(0.3); }
    .heart-burst.show { animation: heartBurst 0.7s ease forwards; }
    @keyframes heartBurst {
        0%   { opacity: 0; transform: scale(0.3); }
        30%  { opacity: 1; transform: scale(1.2); }
        60%  { opacity: 1; transform: scale(1); }
        100% { opacity: 0; transform: scale(1); }
    }

    /* ── ACTION BAR ── */
    .post-actions { display: flex; align-items: center; gap: 14px; padding: 10px 14px 6px; }
    .action-btn {
        background: none; border: none; cursor: pointer; padding: 4px;
        color: var(--ig-text); display: flex; align-items: center;
        -webkit-tap-highlight-color: transparent;
        transition: transform 0.15s, color 0.15s; border-radius: 4px;
        touch-action: manipulation;
    }
    .action-btn:active { opacity: 0.7; }
    .action-btn svg { width: 24px; height: 24px; }
    .action-btn-save { margin-left: auto; }
    .heart-btn.liked { color: var(--ig-red); }
    .heart-btn.pop { animation: heartPop 0.35s cubic-bezier(.36,.07,.19,.97); }
    @keyframes heartPop {
        0%   { transform: scale(1); }
        30%  { transform: scale(1.45); }
        60%  { transform: scale(0.92); }
        100% { transform: scale(1); }
    }

    /* ── POST META ── */
    .post-likes { padding: 2px 14px 5px; font-size: 13.5px; font-weight: 700; }
    .post-caption { padding: 0 14px 6px; font-size: 13.5px; line-height: 1.55; }
    .post-caption .uname { font-weight: 700; }
    .post-caption .hashtag { color: #00376b; }
    .post-comment-count { padding: 0 14px 5px; font-size: 13.5px; color: var(--ig-muted); cursor: pointer; }
    .post-comment { padding: 3px 14px; font-size: 13.5px; line-height: 1.4; }
    .post-comment .uname { font-weight: 700; }
    .post-timestamp { padding: 4px 14px 10px; font-size: 11px; color: var(--ig-muted); text-transform: uppercase; letter-spacing: 0.04em; }

    /* ── ADD COMMENT ── */
    .add-comment-bar {
        border-top: 1px solid #efefef; padding: 10px 14px;
        display: flex; align-items: center; gap: 10px;
    }
    .comment-avatar {
        width: 28px; height: 28px; border-radius: 50%; overflow: hidden;
        background: linear-gradient(135deg, #833ab4, #fd1d1d, #fcb045);
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; color: #fff; font-weight: 700; flex-shrink: 0;
    }
    .comment-input-wrap {
        flex: 1; display: flex; align-items: center;
        border: 1px solid var(--ig-border); border-radius: 20px;
        padding: 7px 12px; gap: 8px;
    }
    .comment-input {
        flex: 1; border: none; outline: none;
        font-size: 13px; font-family: inherit; color: var(--ig-text); background: transparent;
        min-width: 0;
    }
    .comment-input::placeholder { color: var(--ig-muted); }
    .comment-submit {
        background: none; border: none; cursor: pointer;
        font-size: 13px; font-weight: 700; color: var(--ig-accent);
        padding: 0; white-space: nowrap; transition: opacity 0.15s;
        -webkit-tap-highlight-color: transparent;
    }
    .comment-submit:active { opacity: 0.6; }

    /* ── ERROR STATE ── */
    .error-post {
        background: var(--ig-surface); border-top: 1px solid var(--ig-border);
        padding: 80px 24px; text-align: center;
    }
    @media (min-width: 600px) {
        .error-post { border: 1px solid var(--ig-border); border-radius: 10px; }
    }
    .error-emoji { font-size: 48px; margin-bottom: 12px; }
    .error-title { font-size: 16px; font-weight: 600; margin-bottom: 6px; }
    .error-desc { font-size: 14px; color: var(--ig-muted); }

    /* ── BOTTOM NAV ── */
    .ig-bottom-nav {
        position: fixed; bottom: 0; left: 0; right: 0; z-index: 100;
        background: var(--ig-surface); border-top: 1px solid var(--ig-border);
        display: flex; justify-content: space-around; align-items: center;
        height: var(--ig-bottomnav-h);
        padding-bottom: env(safe-area-inset-bottom, 0);
    }
    @media (min-width: 769px) { .ig-bottom-nav { display: none; } }
    .nav-btn {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        text-decoration: none; color: var(--ig-text); padding: 8px 14px;
        background: none; border: none; cursor: pointer;
        -webkit-tap-highlight-color: transparent; border-radius: 8px; transition: opacity 0.15s;
        touch-action: manipulation;
    }
    .nav-btn:active { opacity: 0.5; }
    .nav-btn svg { width: 24px; height: 24px; }
    .nav-btn.active svg { stroke-width: 2.5; }

    /* ── CONFETTI ── */
    .cf-piece {
        position: fixed; pointer-events: none; z-index: 9999;
        border-radius: 2px; top: -16px; animation: cfFall linear forwards;
    }
    @keyframes cfFall {
        0%   { transform: translateY(0) rotate(0deg); opacity: 1; }
        80%  { opacity: 1; }
        100% { transform: translateY(105vh) rotate(720deg); opacity: 0; }
    }

    /* ── RESPONSIVE TWEAKS ── */
    @media (max-width: 400px) {
        .visual-name { font-size: 16px; }
        .visual-meta { font-size: 10px; }
        .badge-text { font-size: 9px; }
        .visual-name-card { padding: 9px 18px; }
    }
    @media (min-width: 600px) {
        .ig-topbar { border-radius: 0; }
    }

    /* Safe area for notch phones */
    @supports (padding: max(0px)) {
        .ig-topbar { padding-left: max(16px, env(safe-area-inset-left)); padding-right: max(16px, env(safe-area-inset-right)); }
        .ig-bottom-nav { padding-bottom: max(env(safe-area-inset-bottom, 0px), 4px); }
    }
</style>
@endpush

@section('content')

{{-- ── PAGE TRANSITION OVERLAY ── --}}
@if($siswa)
<div
    id="page-overlay"
    class="{{ strtoupper(trim($siswa->status)) == 'LULUS' ? 'lulus-overlay' : 'gagal-overlay' }}"
    aria-hidden="true"
>
    <div class="overlay-logo">
        <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah" onerror="this.style.display='none'">
    </div>
    <div class="overlay-text">
        @if(strtoupper(trim($siswa->status)) == 'LULUS')
            <div class="overlay-title-lulus">🎉 SELAMAT!</div>
            <div class="overlay-name">{{ $siswa->nama }}</div>
            <div class="overlay-sub">Dinyatakan LULUS — Tahun Ajaran 2025/2026</div>
        @else
            <div class="overlay-title-gagal">💪 TETAP SEMANGAT!</div>
            <div class="overlay-name">{{ $siswa->nama }}</div>
            <div class="overlay-sub">Masih ada jalan — Jangan berhenti berjuang</div>
        @endif
    </div>
</div>
@endif

{{-- ── CELEBRATION BANNER (LULUS ONLY) ── --}}
@if($siswa && strtoupper(trim($siswa->status)) == 'LULUS')
<div id="celebration-banner" class="show" aria-hidden="true">
    <div class="banner-text">🎓 Selamat {{ $siswa->nama }} — Dinyatakan LULUS! Semoga sukses selalu ✨</div>
</div>
@endif

{{-- ── TOPBAR ── --}}
<header class="ig-topbar" role="banner">
    <a href="/" class="ig-logo" aria-label="Kembali ke beranda">Instagram</a>
    <div class="ig-top-icons">
        <button class="ig-icon-btn" aria-label="Notifikasi">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/>
            </svg>
            <span class="notif-dot" aria-hidden="true"></span>
        </button>
        <button class="ig-icon-btn" aria-label="Direct messages">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
        </button>
    </div>
</header>

{{-- ── PAGE ── --}}
<div class="ig-page">
    <main class="ig-feed" id="main-content" role="main">

        @if($siswa)

        <article class="post-card" role="article" aria-label="Postingan pengumuman kelulusan">

            {{-- Post Header --}}
            <div class="post-header">
                <div class="post-user" role="link" aria-label="Profil sekolah">
                    <div class="post-avatar-wrap">
                        <div class="post-avatar-inner">
                            {{-- 
                                Foto profil sekolah (foto gedung yang sudah bundar dari Instagram).
                                Simpan file di: public/images/avatar-sekolah.jpg
                            --}}
                            <img
                                src="{{ asset('images/avatar-sekolah.jpg') }}"
                                alt="Foto Sekolah MI Ma'arif NU Banteran"
                                onerror="this.outerHTML='<span style=\'font-size:20px\'>🏫</span>'"
                            >
                        </div>
                    </div>
                    <div>
                        <div class="post-username">mimarif.banteran</div>
                        <div class="post-location">Banteran, Jawa Tengah</div>
                    </div>
                </div>
                <button class="post-more" aria-label="Opsi lainnya">···</button>
            </div>

            {{-- ── Post Visual ── --}}
            <div
                class="post-visual {{ strtoupper(trim($siswa->status)) == 'LULUS' ? 'post-visual-lulus' : 'post-visual-gagal' }}"
                id="post-visual"
                role="img"
                aria-label="{{ strtoupper(trim($siswa->status)) == 'LULUS' ? 'Selamat '.$siswa->nama.' dinyatakan LULUS' : $siswa->nama.' belum dinyatakan lulus' }}"
                ondblclick="doubleTapLike()"
            >
                {{-- Deco rings --}}
                <div class="deco-ring ring-1" aria-hidden="true"></div>
                <div class="deco-ring ring-2" aria-hidden="true"></div>
                <div class="deco-ring ring-3" aria-hidden="true"></div>

                {{-- Glowing orbs --}}
                <div class="orb orb-1" aria-hidden="true"></div>
                <div class="orb orb-2" aria-hidden="true"></div>
                <div class="orb orb-3" aria-hidden="true"></div>

                {{-- Shine lines --}}
                <div class="shine-line" aria-hidden="true"></div>
                <div class="shine-line shine-line-2" aria-hidden="true"></div>

                {{-- Stars layer (JS populates) --}}
                <div class="stars-layer" id="stars-layer" aria-hidden="true"></div>

                {{-- Content --}}
                <div class="visual-content">

                    {{-- School badge with real logo --}}
                    <div class="visual-school-badge">
                        <div class="badge-logo">
                            {{-- 
                                Logo sekolah (gambar ke-2 yang kamu kirim).
                                Simpan file di: public/images/logo-sekolah.png
                            --}}
                            <img
                                src="{{ asset('images/logo-sekolah.png') }}"
                                alt="Logo MI Ma'arif NU Banteran"
                                onerror="this.outerHTML='<span style=\'font-size:14px\'>🏫</span>'"
                            >
                        </div>
                        <span class="badge-text">MI Ma'arif NU Banteran</span>
                    </div>

                    {{-- Emoji --}}
                    <span class="visual-emoji" role="img" aria-label="{{ strtoupper(trim($siswa->status)) == 'LULUS' ? 'Perayaan' : 'Semangat' }}">
                        {{ strtoupper(trim($siswa->status)) == 'LULUS' ? '🎉' : '💪' }}
                    </span>

                    {{-- Status --}}
                    <div class="visual-status-wrap">
                        <span class="visual-status {{ strtoupper(trim($siswa->status)) == 'LULUS' ? 'visual-status-lulus' : 'visual-status-gagal' }}">
                            {{ strtoupper(trim($siswa->status)) == 'LULUS' ? 'SELAMAT ANDA LULUS!' : 'BELUM LULUS' }}
                        </span>
                    </div>

                    {{-- Divider --}}
                    <div class="visual-divider" aria-hidden="true"></div>

                    {{-- Name card --}}
                    <div class="visual-name-card">
                        <div class="visual-name">{{ $siswa->nama }}</div>
                        <div class="visual-meta">{{ $siswa->kelas }} &middot; NISN {{ $siswa->nisn }}</div>
                    </div>

                    {{-- Bottom stamp --}}
                    <div class="visual-stamp-row">
                        <div class="stamp-dot"></div>
                        <span class="stamp-text">Pengumuman Kelulusan 2026</span>
                        <div class="stamp-dot"></div>
                    </div>

                </div>

                {{-- Slide dots --}}
                <div class="visual-dots" aria-hidden="true">
                    <span class="active"></span><span></span><span></span>
                </div>

                {{-- Heart overlay --}}
                <div class="heart-overlay" aria-hidden="true">
                    <span class="heart-burst" id="heart-burst">❤️</span>
                </div>
            </div>

            {{-- Action Bar --}}
            <div class="post-actions" role="group" aria-label="Aksi postingan">
                <button class="action-btn heart-btn" id="heart-btn" onclick="toggleLike()" aria-label="Suka" aria-pressed="false">
                    <svg id="heart-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </button>
                <button class="action-btn" aria-label="Komentar">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                    </svg>
                </button>
                <button class="action-btn" aria-label="Bagikan">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                    </svg>
                </button>
                <button class="action-btn action-btn-save" aria-label="Simpan">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/>
                    </svg>
                </button>
            </div>

            {{-- Likes --}}
            <div class="post-likes" id="like-count" aria-live="polite">12.847 suka</div>

            {{-- Caption --}}
            <div class="post-caption">
                <span class="uname">mimarif.banteran</span>
                @if(strtoupper(trim($siswa->status)) == 'LULUS')
                    Alhamdulillah 🎉 Dengan bangga kami umumkan kelulusan <strong>{{ $siswa->nama }}</strong> dari kelas <strong>{{ $siswa->kelas }}</strong>. Selamat berjuang di babak selanjutnya! ✨🎓
                @else
                    Pengumuman hasil ujian untuk <strong>{{ $siswa->nama }}</strong> kelas <strong>{{ $siswa->kelas }}</strong>. Tetap semangat, setiap perjalanan punya waktunya masing-masing 💪
                @endif
                <br>
                <span class="hashtag">#Kelulusan2026 #MIMarifBanteran
                @if(strtoupper(trim($siswa->status)) == 'LULUS')
                    #Lulus #SelamatLulus #GenerasiEmas
                @else
                    #Semangat #BangkitLagi #MasihAdaJalan
                @endif
                </span>
            </div>

            {{-- Comment count --}}
            <div class="post-comment-count" role="button" tabindex="0">Lihat semua 2.341 komentar</div>

            {{-- Sample comments --}}
            <div class="post-comment">
                <span class="uname">Bu Neti</span>
                @if(strtoupper(trim($siswa->status)) == 'LULUS')
                    Selamat {{ $siswa->nama }} semoga menjadi ilmu yang bermanfaat dan sukses selalu ❤️🎉
                @else
                    Jangan menyerah {{ $siswa->nama }}! Tetap semangat dan terus berusaha! 💪❤️
                @endif
            </div>
            <div class="post-comment">
                <span class="uname">Wali Kelas</span>
                @if(strtoupper(trim($siswa->status)) == 'LULUS')
                    Selamat atas kelulusanmu {{ $siswa->nama }}! Selamat melanjutkan ke jenjang berikutnya.
                @else
                    Sabar ya nak, Allah punya rencana yang lebih indah 🤗❤️
                @endif
            </div>
            <div class="post-comment">
                <span class="uname">Alumni MI Banteran</span>
                @if(strtoupper(trim($siswa->status)) == 'LULUS')
                    Waktu cepat banget ya tau-tau udah lulus aja, selamat sekarang waktunya melangkah lebih jauh lagi.
                @else
                    Sabar ya nak, Allah punya rencana yang lebih indah 🤗❤️
                @endif
            </div>

            {{-- Timestamp --}}
            <div class="post-timestamp">Baru saja · Lihat terjemahan</div>

            {{-- Add Comment --}}
            <div class="add-comment-bar">
                <div class="comment-avatar" aria-hidden="true">A</div>
                <div class="comment-input-wrap">
                    <input
                        class="comment-input"
                        id="user-comment-input"
                        type="text"
                        placeholder="Tambahkan komentar..."
                        aria-label="Tambahkan komentar"
                        maxlength="200"
                    >
                    <button class="comment-submit" aria-label="Kirim komentar">Kirim</button>
                </div>
            </div>

        </article>

        @else

        <div class="error-post" role="alert">
            <div class="error-emoji" role="img" aria-label="Tidak ditemukan">🔍</div>
            <div class="error-title">Data Tidak Ditemukan</div>
            <div class="error-desc">Periksa kembali NISN atau nama yang kamu masukkan.</div>
        </div>

        @endif

    </main>
</div>

{{-- ── BOTTOM NAV ── --}}
<nav class="ig-bottom-nav" role="navigation" aria-label="Navigasi bawah">
    <a href="/" class="nav-btn active" aria-label="Beranda">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12L12 3l9 9M5 10v9a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1v-9"/>
        </svg>
    </a>
    <button class="nav-btn" aria-label="Cari">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
        </svg>
    </button>
    <button class="nav-btn" aria-label="Buat postingan">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="3" width="18" height="18" rx="3"/>
            <path stroke-linecap="round" d="M12 8v8M8 12h8"/>
        </svg>
    </button>
    <button class="nav-btn" aria-label="Reels">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <rect x="2" y="2" width="20" height="20" rx="4"/>
            <circle cx="12" cy="12" r="3"/>
            <path stroke-linecap="round" d="M2 8h20M2 16h20M8 2v4M16 2v4M8 18v4M16 18v4"/>
        </svg>
    </button>
    <button class="nav-btn" aria-label="Profil">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="8" r="4"/>
            <path stroke-linecap="round" d="M4 20c0-3.31 3.58-6 8-6s8 2.69 8 6"/>
        </svg>
    </button>
</nav>

@endsection

@push('scripts')
<script>
(function () {

    var SISWA_STATUS = @json($siswa?->status ?? '');
    var SISWA_NAMA   = @json($siswa?->nama ?? '');

    var isLulus   = SISWA_STATUS.toUpperCase().trim() === 'LULUS';
    var likeCount = 12847;
    var liked     = false;
    var lastTap   = 0;

    /* ── Remove overlay after animation ── */
    var overlay = document.getElementById('page-overlay');
    if (overlay) {
        // After 2.8s (lulus) / 2.4s (gagal) overlay fades, then remove from DOM
        setTimeout(function () {
            if (overlay.parentNode) overlay.parentNode.removeChild(overlay);
        }, isLulus ? 3000 : 2600);
    }

    /* ── Generate stars ── */
    var starsLayer = document.getElementById('stars-layer');
    if (starsLayer) {
        var starCount = isLulus ? 30 : 20;
        for (var i = 0; i < starCount; i++) {
            var s = document.createElement('div');
            s.className = 'star';
            var size = 1.5 + Math.random() * 3;
            s.style.cssText = [
                'width:'  + size + 'px',
                'height:' + size + 'px',
                'top:'    + (5 + Math.random() * 90) + '%',
                'left:'   + (5 + Math.random() * 90) + '%',
                'animation-duration:' + (1.5 + Math.random() * 3) + 's',
                'animation-delay:'    + (Math.random() * 3) + 's'
            ].join(';');
            starsLayer.appendChild(s);
        }
    }

    /* ── Like button ── */
    window.toggleLike = function () {
        liked = !liked;
        var btn = document.getElementById('heart-btn');
        var svg = document.getElementById('heart-svg');
        var ctr = document.getElementById('like-count');

        btn.setAttribute('aria-pressed', liked);
        btn.classList.toggle('liked', liked);
        btn.classList.add('pop');
        setTimeout(function () { btn.classList.remove('pop'); }, 400);

        if (liked) {
            likeCount++;
            svg.innerHTML = '<path fill="#ff3040" stroke="#ff3040" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>';
        } else {
            likeCount--;
            svg.innerHTML = '<path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>';
        }
        ctr.textContent = likeCount.toLocaleString('id-ID') + ' suka';
    };

    /* ── Double-tap like (touch support) ── */
    var postVisual = document.getElementById('post-visual');
    if (postVisual) {
        postVisual.addEventListener('touchend', function (e) {
            var now = Date.now();
            if (now - lastTap < 350) {
                if (!liked) toggleLike();
                showHeartBurst();
                e.preventDefault();
            }
            lastTap = now;
        }, { passive: false });
    }

    window.doubleTapLike = function () {
        var now = Date.now();
        if (now - lastTap < 350) {
            if (!liked) toggleLike();
            showHeartBurst();
        }
        lastTap = now;
    };

    function showHeartBurst () {
        var burst = document.getElementById('heart-burst');
        burst.classList.remove('show');
        void burst.offsetWidth;
        burst.classList.add('show');
        setTimeout(function () { burst.classList.remove('show'); }, 700);
    }

    /* ── Confetti (lulus only) ── */
    if (isLulus) {
        var cfColors = ['#56ab2f','#a8e063','#ffe066','#ff3040','#0095f6','#ff77c2','#ffffff','#d4a017'];

        function launchConfetti (n) {
            for (var i = 0; i < n; i++) {
                (function () {
                    var el = document.createElement('div');
                    el.className = 'cf-piece';
                    var w = 6 + Math.random() * 9;
                    var h = 6 + Math.random() * 9;
                    el.style.cssText = [
                        'left:'   + (5 + Math.random() * 90) + 'vw',
                        'width:'  + w + 'px',
                        'height:' + h + 'px',
                        'background:' + cfColors[Math.floor(Math.random() * cfColors.length)],
                        'border-radius:' + (Math.random() > 0.5 ? '50%' : '2px'),
                        'animation-duration:' + (2.5 + Math.random() * 2) + 's',
                        'animation-delay:'    + (Math.random() * 1.5) + 's'
                    ].join(';');
                    document.body.appendChild(el);
                    el.addEventListener('animationend', function () { el.remove(); });
                })();
            }
        }

        // Launch after overlay starts fading
        setTimeout(function () { launchConfetti(70); }, 800);
        setTimeout(function () { launchConfetti(50); }, 2000);
        setTimeout(function () { launchConfetti(30); }, 3500);
    }

    /* ── Page exit transition (back to index) ── */
    var backLinks = document.querySelectorAll('a[href="/"], .nav-btn[aria-label="Beranda"]');
    backLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var exitOverlay = document.createElement('div');
            exitOverlay.style.cssText = 'position:fixed;inset:0;background:#fff;z-index:9999;opacity:0;transition:opacity 0.3s ease;pointer-events:all;';
            document.body.appendChild(exitOverlay);
            requestAnimationFrame(function() {
                exitOverlay.style.opacity = '1';
            });
            setTimeout(function() { window.location.href = '/'; }, 350);
        });
    });

})();
</script>
@endpush