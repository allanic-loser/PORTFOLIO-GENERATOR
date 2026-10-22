<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#F4F5EE">

    <title>{{ $portfolio->full_name }} | Portfolio</title>

    <style>
        :root {
            --bg: #F4F5EE;
            --surface: #FFFFFF;
            --surface-light: #E9EDE3;
            --accent: #DFFF9A;
            --accent-dark: #526B35;
            --green: #17271F;
            --green-deep: #111810;
            --text: #17271F;
            --muted: #687467;
            --border: #DCE3D7;
            --radius: 18px;
            --shadow: 0 18px 55px rgba(23, 39, 31, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 40px 22px 60px;
            background:
                radial-gradient(
                    circle at 0% 0%,
                    rgba(82, 107, 53, 0.07),
                    transparent 32%
                ),
                var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
        }

        .container {
            width: 100%;
            max-width: 1060px;
            margin: 0 auto;
        }

        /* =========================
           PREVIEW NAVIGATION
        ========================= */

        .actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 24px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 11px 19px;
            border: 1px solid transparent;
            border-radius: 9px;
            background: var(--accent);
            color: var(--green-deep);
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition:
                transform 0.2s ease,
                background-color 0.2s ease,
                border-color 0.2s ease;
        }

        .button:hover {
            background: #E9FFB8;
            transform: translateY(-2px);
        }

        .button-secondary {
            background: var(--surface);
            color: var(--green);
            border-color: var(--border);
        }

        .button-secondary:hover {
            background: var(--surface-light);
            border-color: #B8C8B1;
        }

        /* =========================
           SHARED PORTFOLIO STYLES
        ========================= */

        .portfolio {
            position: relative;
            overflow: hidden;
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .hero {
            position: relative;
            padding: 48px;
            background: var(--green);
            color: #F4F5EE;
        }

        .eyebrow {
            margin: 0 0 17px;
            color: var(--accent);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2.5px;
            line-height: 1.5;
            text-transform: uppercase;
        }

        h1 {
            max-width: 100%;
            margin: 0;
            font-size: clamp(34px, 5vw, 54px);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -2px;
            overflow-wrap: anywhere;
        }

        .profile-picture {
            display: block;
            width: 128px;
            height: 128px;
            margin-bottom: 27px;
            object-fit: cover;
            object-position: center;
            background: var(--surface-light);
            border: 3px solid var(--accent);
            border-radius: 18px;
        }

        .contact-info {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 20px;
            margin-top: 22px;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .contact-info p {
            margin: 0;
        }

        .portfolio-content {
            padding: 8px 48px 46px;
        }

        .section {
            min-width: 0;
            margin-top: 32px;
            padding-top: 25px;
            border-top: 1px solid var(--border);
            overflow-wrap: anywhere;
        }

        .section h2 {
            margin: 0 0 13px;
            color: var(--accent-dark);
            font-size: 18px;
            font-weight: 800;
            line-height: 1.4;
        }

        .content {
            color: var(--text);
            font-size: 14px;
            line-height: 1.9;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .empty {
            color: #879184;
            font-style: italic;
        }

        .portfolio-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 48px;
            background: var(--green-deep);
            color: #E0E8DD;
            font-size: 12px;
        }

        .portfolio-footer p {
            margin: 0;
        }

        .footer-mark {
            color: var(--accent);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* =========================
           SIMPLE TEMPLATE
           Minimal, elegant and clean
        ========================= */

        .simple {
            border-radius: 5px;
            box-shadow: 0 12px 40px rgba(23, 39, 31, 0.045);
        }

        .simple .hero {
            padding: 62px 65px 48px;
            background: var(--surface);
            color: var(--text);
            border-bottom: 1px solid var(--border);
        }

        .simple .eyebrow {
            color: var(--accent-dark);
            letter-spacing: 3px;
        }

        .simple h1 {
            max-width: 720px;
            color: var(--green);
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(38px, 5vw, 58px);
            font-weight: 500;
            line-height: 1.12;
            letter-spacing: -1.5px;
        }

        .simple .profile-picture {
            width: 112px;
            height: 112px;
            margin-bottom: 30px;
            border: 1px solid var(--border);
            border-radius: 50%;
        }

        .simple .contact-info {
            color: var(--muted);
        }

        .simple .portfolio-content {
            padding: 5px 65px 52px;
        }

        .simple .section {
            margin-top: 29px;
            padding-top: 25px;
            border-top-color: #E7EBE2;
        }

        .simple .section h2 {
            color: var(--green);
            font-family: Georgia, "Times New Roman", serif;
            font-size: 21px;
            font-weight: 500;
        }

        .simple .content {
            max-width: 800px;
            color: #465247;
            font-size: 14px;
        }

        .simple .portfolio-footer {
            padding: 22px 65px;
            background: #F8F9F5;
            color: var(--muted);
            border-top: 1px solid var(--border);
        }

        .simple .footer-mark {
            color: var(--accent-dark);
        }

        /* =========================
           MODERN TEMPLATE
           Two-column cards and grid
        ========================= */

        .modern {
            border-color: #D5DFD1;
            border-radius: 20px;
            box-shadow: 0 24px 70px rgba(23, 39, 31, 0.10);
        }

        .modern .hero {
            padding: 43px;
            background:
                radial-gradient(
                    circle at 100% 0%,
                    rgba(223, 255, 154, 0.13),
                    transparent 34%
                ),
                linear-gradient(135deg, #20382B, #17271F);
        }

        .modern .hero::after {
            position: absolute;
            right: 34px;
            bottom: 28px;
            width: 54px;
            height: 5px;
            background: var(--accent);
            border-radius: 99px;
            content: "";
            opacity: 0.9;
        }

        .modern .profile-picture {
            width: 118px;
            height: 118px;
            border: 3px solid var(--accent);
            border-radius: 22px;
        }

        .modern h1 {
            max-width: 760px;
            font-size: clamp(35px, 5vw, 52px);
            letter-spacing: -1.8px;
        }

        .modern .contact-info {
            color: #E0E8DD;
        }

        .modern .portfolio-content {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            align-items: stretch;
            gap: 0 20px;
            padding: 15px 30px 35px;
        }

        .modern .section {
            align-self: stretch;
            margin-top: 20px;
            padding: 24px;
            background: #F8F9F5;
            border: 1px solid #E5EADF;
            border-radius: 14px;
            transition:
                transform 0.2s ease,
                border-color 0.2s ease;
        }

        .modern .section:hover {
            border-color: #B8C8B1;
            transform: translateY(-2px);
        }

        .modern .section h2 {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--green);
            font-size: 16px;
        }

        .modern .section h2::before {
            display: inline-block;
            width: 7px;
            height: 7px;
            flex: 0 0 7px;
            background: var(--accent-dark);
            border-radius: 2px;
            content: "";
        }

        .modern .content {
            font-size: 13px;
            line-height: 1.85;
        }

        .modern .portfolio-footer {
            padding: 22px 35px;
        }

        /* =========================
           CREATIVE TEMPLATE
           Editorial typography and
           expressive asymmetry
        ========================= */

        .creative {
            border: 0;
            border-radius: 4px;
            background: #F8F9F3;
            box-shadow: 0 24px 70px rgba(23, 39, 31, 0.11);
        }

        .creative .hero {
            isolation: isolate;
            padding: 57px 52px 48px;
            background: var(--green-deep);
            border-bottom: 7px solid var(--accent);
        }

        .creative .hero::before {
            position: absolute;
            z-index: -1;
            top: -115px;
            right: -85px;
            width: 310px;
            height: 310px;
            border: 1px solid rgba(223, 255, 154, 0.28);
            border-radius: 50%;
            content: "";
        }

        .creative .hero::after {
            position: absolute;
            z-index: -1;
            right: 40px;
            bottom: 36px;
            width: 75px;
            height: 75px;
            background: var(--accent);
            border-radius: 50% 50% 5px 50%;
            content: "";
            opacity: 0.95;
        }

        .creative .eyebrow {
            color: var(--accent);
            letter-spacing: 4px;
        }

        .creative .profile-picture {
            width: 142px;
            height: 142px;
            margin-bottom: 29px;
            border: 4px solid var(--accent);
            border-radius: 4px 32px 4px 32px;
            box-shadow: 10px 10px 0 rgba(223, 255, 154, 0.12);
        }

        .creative h1 {
            position: relative;
            z-index: 1;
            max-width: 780px;
            color: #FFFFFF;
            font-size: clamp(42px, 7vw, 76px);
            font-weight: 900;
            line-height: 0.99;
            letter-spacing: -3px;
            text-transform: uppercase;
        }

        .creative .contact-info {
            position: relative;
            z-index: 1;
            max-width: 700px;
            color: #E0E8DD;
        }

        .creative .portfolio-content {
            padding: 12px 52px 45px;
        }

        .creative .section {
            position: relative;
            margin-top: 27px;
            padding: 25px 27px 27px;
            background: var(--surface);
            border: 1px solid #E2E8DA;
            border-left: 5px solid var(--accent-dark);
            border-radius: 3px 14px 14px 3px;
        }

        .creative .section:nth-child(odd) {
            margin-right: 28px;
        }

        .creative .section:nth-child(even) {
            margin-left: 28px;
            border-left-color: var(--green);
        }

        .creative .section h2 {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--green);
            font-size: 17px;
            font-weight: 900;
            letter-spacing: 0.2px;
        }

        .creative .section h2::before {
            color: var(--accent-dark);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .creative .section:nth-child(1) h2::before {
            content: "01";
        }

        .creative .section:nth-child(2) h2::before {
            content: "02";
        }

        .creative .section:nth-child(3) h2::before {
            content: "03";
        }

        .creative .section:nth-child(4) h2::before {
            content: "04";
        }

        .creative .section:nth-child(5) h2::before {
            content: "05";
        }

        .creative .section:nth-child(6) h2::before {
            content: "06";
        }

        .creative .content {
            font-size: 14px;
        }

        .creative .portfolio-footer {
            padding: 24px 52px;
            background: var(--green);
            border-top: 0;
        }

        .creative .footer-mark {
            color: var(--accent);
        }

        /* =========================
           RESPONSIVE DESIGN
        ========================= */

        @media (max-width: 700px) {
            body {
                padding: 22px 12px 35px;
            }

            .actions {
                margin-bottom: 17px;
            }

            .button {
                padding: 10px 13px;
                font-size: 12px;
            }

            .hero,
            .simple .hero,
            .modern .hero,
            .creative .hero {
                padding: 32px 25px;
            }

            .portfolio-content,
            .simple .portfolio-content,
            .creative .portfolio-content {
                padding: 5px 25px 30px;
            }

            .modern .portfolio-content {
                grid-template-columns: 1fr;
                gap: 0;
                padding: 5px 18px 25px;
            }

            .modern .section {
                margin-top: 15px;
                padding: 20px;
            }

            .creative .section {
                margin-right: 0 !important;
                margin-left: 0 !important;
                padding: 21px;
            }

            .portfolio-footer,
            .simple .portfolio-footer,
            .modern .portfolio-footer,
            .creative .portfolio-footer {
                padding: 19px 25px;
            }

            .profile-picture {
                width: 105px;
                height: 105px;
                margin-bottom: 23px;
            }

            .simple .profile-picture {
                width: 98px;
                height: 98px;
            }

            .creative .profile-picture {
                width: 115px;
                height: 115px;
            }

            .simple h1 {
                font-size: clamp(35px, 9vw, 48px);
            }

            .creative h1 {
                font-size: clamp(38px, 10vw, 58px);
                letter-spacing: -1.8px;
            }

            .creative .hero::after {
                right: 20px;
                bottom: 22px;
                width: 45px;
                height: 45px;
            }

            .creative .hero::before {
                right: -150px;
            }

            .contact-info {
                flex-direction: column;
                gap: 5px;
            }

            .section {
                margin-top: 24px;
                padding-top: 20px;
            }

            .portfolio-footer {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }
        }

        @media (max-width: 380px) {
            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .button {
                width: 100%;
            }

            .hero,
            .simple .hero,
            .modern .hero,
            .creative .hero {
                padding: 26px 19px;
            }

            .portfolio-content,
            .simple .portfolio-content,
            .creative .portfolio-content {
                padding-right: 19px;
                padding-left: 19px;
            }

            .modern .portfolio-content {
                padding-right: 12px;
                padding-left: 12px;
            }

            .portfolio-footer,
            .simple .portfolio-footer,
            .modern .portfolio-footer,
            .creative .portfolio-footer {
                padding-right: 19px;
                padding-left: 19px;
            }

            .creative h1 {
                font-size: 36px;
            }
        }

        /* Keyboard accessibility */

        a:focus-visible {
            outline: 3px solid var(--accent-dark);
            outline-offset: 4px;
        }

        .button:active {
            transform: translateY(0);
        }

        /* Reduced-motion accessibility */

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Cleaner printing and PDF export */

        @media print {
            body {
                padding: 0;
                background: #FFFFFF;
            }

            .actions {
                display: none;
            }

            .portfolio {
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .section,
            .hero,
            .portfolio-footer {
                break-inside: avoid;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <main class="container">

        @php
            $template = strtolower($portfolio->template ?? 'simple');

            if (!in_array($template, ['simple', 'modern', 'creative'])) {
                $template = 'simple';
            }
        @endphp

        <nav class="actions" aria-label="Portfolio actions">
            <a
                class="button"
                href="/portfolio/{{ $portfolio->id }}/edit"
            >
                Edit Portfolio
            </a>

            <a
                class="button button-secondary"
                href="/portfolio/manage"
            >
                Back to Manage
            </a>
        </nav>

        <article class="portfolio {{ $template }}">

            <header class="hero">
                <p class="eyebrow">
                    @if ($template === 'simple')
                        Personal Portfolio
                    @elseif ($template === 'modern')
                        Portfolio / Professional Profile
                    @else
                        Independent Mind. Creative Work.
                    @endif
                </p>

                @if ($portfolio->profile_picture)
                    <img
                        class="profile-picture"
                        src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                        alt="Profile picture of {{ $portfolio->full_name }}"
                    >
                @endif

                <h1>{{ $portfolio->full_name }}</h1>

                <div class="contact-info">
                    @if ($portfolio->email)
                        <p>{{ $portfolio->email }}</p>
                    @endif

                    @if ($portfolio->contact_number)
                        <p>{{ $portfolio->contact_number }}</p>
                    @endif

                    @if ($portfolio->address)
                        <p>{{ $portfolio->address }}</p>
                    @endif
                </div>
            </header>

            <div class="portfolio-content">

                <section class="section">
                    <h2>About Me</h2>

                    <div class="content {{ $portfolio->about_me ? '' : 'empty' }}">{{ $portfolio->about_me ?: 'No information provided yet.' }}</div>
                </section>

                <section class="section">
                    <h2>Educational Background</h2>

                    <div class="content {{ $portfolio->education ? '' : 'empty' }}">{{ $portfolio->education ?: 'No information provided yet.' }}</div>
                </section>

                <section class="section">
                    <h2>Skills</h2>

                    <div class="content {{ $portfolio->skills ? '' : 'empty' }}">{{ $portfolio->skills ?: 'No information provided yet.' }}</div>
                </section>

                <section class="section">
                    <h2>Projects</h2>

                    <div class="content {{ $portfolio->projects ? '' : 'empty' }}">{{ $portfolio->projects ?: 'No information provided yet.' }}</div>
                </section>

                <section class="section">
                    <h2>Work Experience</h2>

                    <div class="content {{ $portfolio->work_experience ? '' : 'empty' }}">{{ $portfolio->work_experience ?: 'No information provided yet.' }}</div>
                </section>

                <section class="section">
                    <h2>Social Media / Website Links</h2>

                    <div class="content {{ $portfolio->social_links ? '' : 'empty' }}">{{ $portfolio->social_links ?: 'No links provided yet.' }}</div>
                </section>

            </div>

            <footer class="portfolio-footer">
                <p>Portfolio of {{ $portfolio->full_name }}</p>

                <span class="footer-mark">
                    @if ($template === 'simple')
                        Personal Profile
                    @elseif ($template === 'modern')
                        Designed to Stand Out
                    @else
                        Create Without Limits
                    @endif
                </span>
            </footer>

        </article>
    </main>
</body>
</html>
