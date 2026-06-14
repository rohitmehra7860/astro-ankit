@extends('layouts.front')
@section('content')
    <style>
        :root {
            --s404-gold: #C9A84C;
            --s404-gold-light: #F0D080;
            --s404-gold-dim: #8A6D2A;
            --s404-deep: #0A0612;
            --s404-purple-mid: #2E1660;
            --s404-ruby: #8B1A3A;
            --s404-text: #EDE0C4;
            --s404-muted: #9A8A6A;
        }

        @keyframes s404-rotate {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes s404-pulse {

            0%,
            100% {
                opacity: 0.15;
                transform: scale(1);
            }

            50% {
                opacity: 0.6;
                transform: scale(1.04);
            }
        }

        @keyframes s404-orb {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-18px) scale(1.05);
            }
        }

        @keyframes s404-twinkle {

            0%,
            100% {
                opacity: 0.4;
            }

            50% {
                opacity: 1;
            }
        }

        /* ── Section shell ── */
        .s404 {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 1.5rem;
            text-align: center;
            overflow: hidden;
            /* background: var(--s404-deep); */
            padding: 8rem 1.5rem 0rem 1.5rem;
            font-family: 'Cormorant Garamond', Georgia, serif;
            color: var(--s404-text);
            box-sizing: border-box;
        }

        /* ── Background layer: radial glow ── */
        .s404__bg {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background:
                radial-gradient(ellipse 65% 55% at 50% 35%, rgba(46, 22, 96, 0.6) 0%, transparent 70%),
                radial-gradient(ellipse 40% 30% at 15% 80%, rgba(139, 26, 58, 0.28) 0%, transparent 60%),
                radial-gradient(ellipse 30% 25% at 85% 70%, rgba(201, 168, 76, 0.1) 0%, transparent 60%);
        }

        /* ── Decorative orbs ── */
        .s404__orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .s404__orb--1 {
            width: 320px;
            height: 320px;
            top: -90px;
            left: -90px;
            background: radial-gradient(circle, rgba(46, 22, 96, 0.45) 0%, transparent 70%);
            animation: s404-orb 9s ease-in-out infinite;
        }

        .s404__orb--2 {
            width: 220px;
            height: 220px;
            bottom: 40px;
            right: -60px;
            background: radial-gradient(circle, rgba(139, 26, 58, 0.32) 0%, transparent 70%);
            animation: s404-orb 7s ease-in-out infinite;
            animation-delay: -3s;
        }

        .s404__orb--3 {
            width: 160px;
            height: 160px;
            top: 42%;
            left: 4%;
            background: radial-gradient(circle, rgba(201, 168, 76, 0.13) 0%, transparent 70%);
            animation: s404-orb 11s ease-in-out infinite;
            animation-delay: -6s;
        }

        /* ── Starfield ── */
        .s404__stars {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .s404__star {
            position: absolute;
            border-radius: 50%;
            animation: s404-twinkle var(--dur, 3s) ease-in-out infinite;
            animation-delay: var(--delay, 0s);
        }

        /* ── Content wrapper (above bg) ── */
        .s404__content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ── Mandala ── */
        .s404__mandala {
            position: relative;
            width: 260px;
            height: 260px;
            margin-bottom: 1.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .s404__mandala svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .s404__mandala-spin {
            animation: s404-rotate 30s linear infinite;
            transform-origin: 130px 130px;
        }

        .s404__mandala-spin-rev {
            animation: s404-rotate 20s linear infinite reverse;
            transform-origin: 130px 130px;
        }

        .s404__mandala-spin-fast {
            animation: s404-rotate 12s linear infinite;
            transform-origin: 130px 130px;
        }

        /* Pulse rings */
        .s404__ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(201, 168, 76, 0.18);
            pointer-events: none;
            animation: s404-pulse 3.2s ease-in-out infinite;
        }

        .s404__ring--1 {
            inset: -22px;
            animation-delay: 0s;
        }

        .s404__ring--2 {
            inset: -42px;
            animation-delay: -1.1s;
        }

        .s404__ring--3 {
            inset: -64px;
            animation-delay: -2.2s;
        }

        /* ── 404 number ── */
        .s404__code {
            font-family: 'Cinzel Decorative', serif;
            font-size: clamp(5rem, 18vw, 9rem);
            font-weight: 700;
            letter-spacing: 0.08em;
            line-height: 1;
            background: linear-gradient(160deg, #F0D080 0%, #C9A84C 40%, #8A6D2A 70%, #F0D080 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.4rem;
            filter: drop-shadow(0 0 28px rgba(201, 168, 76, 0.4));
        }

        /* ── Ornamental divider ── */
        .s404__divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0.5rem auto 1.3rem;
            width: 280px;
        }

        .s404__divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--s404-gold-dim), transparent);
        }

        .s404__divider-gem {
            width: 8px;
            height: 8px;
            background: var(--s404-gold);
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        /* ── Heading ── */
        .s404__heading {
            font-family: 'Cinzel', serif;
            font-size: clamp(1.25rem, 4vw, 1.9rem);
            font-weight: 600;
            color: var(--s404-gold-light);
            letter-spacing: 0.13em;
            text-transform: uppercase;
            margin: 0 0 0.75rem;
        }

        /* ── Body text ── */
        .s404__subtext {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.05rem, 2.4vw, 1.28rem);
            font-style: italic;
            color: var(--s404-muted);
            max-width: 440px;
            line-height: 1.75;
            margin: 0 0 0.5rem;
        }

        .s404__note {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.95rem;
            color: rgba(201, 168, 76, 0.5);
            letter-spacing: 0.04em;
            margin: 0 0 2.2rem;
        }

        /* ── Buttons ── */
        .s404__btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 2.8rem;
        }

        .s404__btn {
            font-family: 'Cinzel', serif;
            font-size: 0.78rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 0.85rem 2.2rem;
            border-radius: 2px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            line-height: 1;
        }

        .s404__btn--primary {
            background: linear-gradient(135deg, #C9A84C, #8A6D2A);
            color: #0A0612;
            border: none;
            box-shadow: 0 0 18px rgba(201, 168, 76, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.14);
        }

        .s404__btn--primary:hover {
            box-shadow: 0 0 34px rgba(201, 168, 76, 0.55), inset 0 1px 0 rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .s404__btn--outline {
            background: transparent;
            color: var(--s404-gold);
            border: 1px solid var(--s404-gold-dim);
        }

        .s404__btn--outline:hover {
            background: rgba(201, 168, 76, 0.08);
            border-color: var(--s404-gold);
            color: var(--s404-gold-light);
            transform: translateY(-2px);
        }

        /* ── Brand strip ── */
        .s404__brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
        }

        .s404__brand-name {
            font-family: 'Cinzel', serif;
            font-size: 22px;
            letter-spacing: 0.22em;
            color: var(--s404-gold-dim);
            text-transform: uppercase;
        }

        .s404__brand-tagline {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 18px;
            color: rgb(255 241 214 / 45%);
        }

        /* ── Responsive ── */
        @media (max-width: 480px) {
            .s404__btn-group {
                flex-direction: column;
                align-items: center;
            }

            .s404__btn {
                width: 220px;
                justify-content: center;
            }

            .s404__mandala {
                width: 200px;
                height: 200px;
            }
        }
    </style>

    <!-- ===================== SECTION ===================== -->
    <section class="s404" aria-label="404 Page Not Found">

        <!-- Background layers -->
        <div class="s404__bg" aria-hidden="true"></div>
        <div class="s404__orb s404__orb--1" aria-hidden="true"></div>
        <div class="s404__orb s404__orb--2" aria-hidden="true"></div>
        <div class="s404__orb s404__orb--3" aria-hidden="true"></div>

        <!-- Twinkling stars (JS-generated below) -->
        <div class="s404__stars" id="s404Stars" aria-hidden="true"></div>

        <div class="s404__content">

            <!-- Mandala -->
            <div class="s404__mandala" aria-hidden="true">
                <div class="s404__ring s404__ring--1"></div>
                <div class="s404__ring s404__ring--2"></div>
                <div class="s404__ring s404__ring--3"></div>

                <svg viewBox="0 0 260 260" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <radialGradient id="s404ManCenter" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" stop-color="#F0D080" />
                            <stop offset="100%" stop-color="#C9A84C" />
                        </radialGradient>
                    </defs>

                    <!-- Outer ring — slow spin -->
                    <g class="s404__mandala-spin">
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none" stroke="#C9A84C"
                            stroke-width="0.8" opacity="0.5" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none" stroke="#C9A84C"
                            stroke-width="0.8" opacity="0.5" transform="rotate(22.5 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none" stroke="#C9A84C"
                            stroke-width="0.8" opacity="0.5" transform="rotate(45 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none" stroke="#C9A84C"
                            stroke-width="0.8" opacity="0.5" transform="rotate(67.5 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none" stroke="#C9A84C"
                            stroke-width="0.8" opacity="0.5" transform="rotate(90 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none" stroke="#C9A84C"
                            stroke-width="0.8" opacity="0.5" transform="rotate(112.5 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none" stroke="#C9A84C"
                            stroke-width="0.8" opacity="0.5" transform="rotate(135 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none" stroke="#C9A84C"
                            stroke-width="0.8" opacity="0.5" transform="rotate(157.5 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none"
                            stroke="#C9A84C" stroke-width="0.8" opacity="0.5" transform="rotate(180 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none"
                            stroke="#C9A84C" stroke-width="0.8" opacity="0.5" transform="rotate(202.5 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none"
                            stroke="#C9A84C" stroke-width="0.8" opacity="0.5" transform="rotate(225 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none"
                            stroke="#C9A84C" stroke-width="0.8" opacity="0.5" transform="rotate(247.5 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none"
                            stroke="#C9A84C" stroke-width="0.8" opacity="0.5" transform="rotate(270 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none"
                            stroke="#C9A84C" stroke-width="0.8" opacity="0.5" transform="rotate(292.5 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none"
                            stroke="#C9A84C" stroke-width="0.8" opacity="0.5" transform="rotate(315 130 130)" />
                        <ellipse cx="130" cy="42" rx="5" ry="16" fill="none"
                            stroke="#C9A84C" stroke-width="0.8" opacity="0.5" transform="rotate(337.5 130 130)" />
                        <circle cx="130" cy="130" r="82" fill="none" stroke="#C9A84C" stroke-width="0.6"
                            stroke-dasharray="3 6" opacity="0.35" />
                        <rect x="127" y="44" width="6" height="6" fill="#C9A84C" opacity="0.6"
                            transform="rotate(45 130 47)" />
                        <rect x="127" y="44" width="6" height="6" fill="#C9A84C" opacity="0.6"
                            transform="rotate(45 130 47) rotate(90 130 130)" />
                        <rect x="127" y="44" width="6" height="6" fill="#C9A84C" opacity="0.6"
                            transform="rotate(45 130 47) rotate(180 130 130)" />
                        <rect x="127" y="44" width="6" height="6" fill="#C9A84C" opacity="0.6"
                            transform="rotate(45 130 47) rotate(270 130 130)" />
                    </g>

                    <!-- Middle ring — reverse spin -->
                    <g class="s404__mandala-spin-rev">
                        <ellipse cx="130" cy="68" rx="8" ry="22"
                            fill="rgba(201,168,76,0.12)" stroke="#C9A84C" stroke-width="0.8" opacity="0.7" />
                        <ellipse cx="130" cy="68" rx="8" ry="22"
                            fill="rgba(201,168,76,0.12)" stroke="#C9A84C" stroke-width="0.8" opacity="0.7"
                            transform="rotate(45 130 130)" />
                        <ellipse cx="130" cy="68" rx="8" ry="22"
                            fill="rgba(201,168,76,0.12)" stroke="#C9A84C" stroke-width="0.8" opacity="0.7"
                            transform="rotate(90 130 130)" />
                        <ellipse cx="130" cy="68" rx="8" ry="22"
                            fill="rgba(201,168,76,0.12)" stroke="#C9A84C" stroke-width="0.8" opacity="0.7"
                            transform="rotate(135 130 130)" />
                        <ellipse cx="130" cy="68" rx="8" ry="22"
                            fill="rgba(201,168,76,0.12)" stroke="#C9A84C" stroke-width="0.8" opacity="0.7"
                            transform="rotate(180 130 130)" />
                        <ellipse cx="130" cy="68" rx="8" ry="22"
                            fill="rgba(201,168,76,0.12)" stroke="#C9A84C" stroke-width="0.8" opacity="0.7"
                            transform="rotate(225 130 130)" />
                        <ellipse cx="130" cy="68" rx="8" ry="22"
                            fill="rgba(201,168,76,0.12)" stroke="#C9A84C" stroke-width="0.8" opacity="0.7"
                            transform="rotate(270 130 130)" />
                        <ellipse cx="130" cy="68" rx="8" ry="22"
                            fill="rgba(201,168,76,0.12)" stroke="#C9A84C" stroke-width="0.8" opacity="0.7"
                            transform="rotate(315 130 130)" />
                        <circle cx="130" cy="130" r="56" fill="none" stroke="#C9A84C" stroke-width="0.8"
                            opacity="0.5" />
                        <polygon points="130,80 115,108 145,108" fill="none" stroke="#F0D080" stroke-width="0.9"
                            opacity="0.5" />
                        <polygon points="130,80 115,108 145,108" fill="none" stroke="#F0D080" stroke-width="0.9"
                            opacity="0.5" transform="rotate(180 130 130)" />
                        <polygon points="130,80 115,108 145,108" fill="none" stroke="#F0D080" stroke-width="0.9"
                            opacity="0.4" transform="rotate(90 130 130)" />
                        <polygon points="130,80 115,108 145,108" fill="none" stroke="#F0D080" stroke-width="0.9"
                            opacity="0.4" transform="rotate(270 130 130)" />
                    </g>

                    <!-- Inner static -->
                    <circle cx="130" cy="130" r="36" fill="rgba(10,6,18,0.92)" stroke="#C9A84C"
                        stroke-width="1" opacity="0.85" />
                    <circle cx="130" cy="130" r="28" fill="none" stroke="#F0D080" stroke-width="0.5"
                        opacity="0.4" />

                    <!-- Inner cross — fast spin -->
                    <g class="s404__mandala-spin-fast">
                        <line x1="130" y1="106" x2="130" y2="154" stroke="#F0D080"
                            stroke-width="0.8" opacity="0.6" />
                        <line x1="106" y1="130" x2="154" y2="130" stroke="#F0D080"
                            stroke-width="0.8" opacity="0.6" />
                        <line x1="111" y1="111" x2="149" y2="149" stroke="#F0D080"
                            stroke-width="0.8" opacity="0.38" />
                        <line x1="149" y1="111" x2="111" y2="149" stroke="#F0D080"
                            stroke-width="0.8" opacity="0.38" />
                    </g>

                    <!-- Center dot -->
                    <circle cx="130" cy="130" r="7" fill="url(#s404ManCenter)" />
                    <circle cx="130" cy="130" r="2.5" fill="#F0D080" />
                </svg>
            </div>

            <!-- 404 number -->
            <div class="s404__code" aria-label="Error 404">404</div>

            <!-- Divider -->
            <div class="s404__divider" aria-hidden="true">
                <div class="s404__divider-line"></div>
                <div class="s404__divider-gem"></div>
                <div class="s404__divider-line"></div>
            </div>

            <!-- Heading -->
            <h1 class="s404__heading">The Stars Led You Astray</h1>

            <!-- Description -->
            <p class="s404__subtext">
                This path does not exist in your cosmic journey.<br>
                Perhaps the planets have guided you elsewhere &mdash;<br>let us find your true destination.
            </p>
            <p class="s404__note">&mdash; Yeh page nahi mila, lekin aapka solution zaroor milega &mdash;</p>

            <!-- Buttons -->
            <div class="s404__btn-group">
                <a href="{{ route('index') }}" class="s404__btn s404__btn--primary">&#10022; Return Home</a>
                <a href="{{ route('contact') }}" class="s404__btn s404__btn--outline">&#128222; Consult
                    Ankit Shastri
                    Ji</a>
            </div>

            <!-- Brand -->
            <div class="s404__brand">
                <div class="s404__divider" style="width:180px; margin-bottom:0.7rem;" aria-hidden="true">
                    <div class="s404__divider-line"></div>
                    <div class="s404__divider-gem"></div>
                    <div class="s404__divider-line"></div>
                </div>
                <span class="s404__brand-name">Astro Ankit Shastri Ji</span>
                <span class="s404__brand-tagline">25+ Years of Cosmic Guidance</span>
            </div>

        </div><!-- /.s404__content -->
    </section>
    <!-- ==================== END SECTION ==================== -->


    <script>
        /* ── Starfield for .s404 section ── */
        (function() {
            var wrap = document.getElementById('s404Stars');
            if (!wrap) return;

            var rect = wrap.getBoundingClientRect();
            var W = rect.width || window.innerWidth;
            var H = rect.height || window.innerHeight;
            var count = Math.floor((W * H) / 3800);

            for (var i = 0; i < count; i++) {
                var el = document.createElement('div');
                var size = (Math.random() * 2 + 0.5).toFixed(1);
                var gold = Math.random() < 0.09;
                var dur = (Math.random() * 3 + 2).toFixed(1);
                var delay = (Math.random() * 4).toFixed(1);
                var top = (Math.random() * 100).toFixed(2);
                var left = (Math.random() * 100).toFixed(2);

                el.className = 's404__star';
                el.style.cssText = [
                    'width:' + size + 'px',
                    'height:' + size + 'px',
                    'top:' + top + '%',
                    'left:' + left + '%',
                    'background:' + (gold ? 'rgba(201,168,76,0.9)' : 'rgba(220,210,255,0.85)'),
                    '--dur:' + dur + 's',
                    '--delay:' + delay + 's'
                ].join(';');

                wrap.appendChild(el);
            }
        })();
    </script>
@endsection
