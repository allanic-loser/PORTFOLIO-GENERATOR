<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#17271F">
    <title>Portfolio Generator | Build Your Professional Portfolio</title>

    <style>
        :root {
            /* Main palette */
            --bg: #F4F5EE;
            --surface: #FFFFFF;
            --surface-light: #E9EDE3;
            --accent: #DFFF9A;
            --accent-dark: #526B35;
            --green: #17271F;
            --green-deep: #111810;
            --green-card: #1C2B22;
            --green-light: #26382B;
            --text: #17271F;
            --muted: #59675B;
            --border: #DCE3D7;
            --dark-border: #3B4C3E;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        a:focus-visible {
            outline: 3px solid var(--accent-dark);
            outline-offset: 4px;
            border-radius: 4px;
        }

        /* Navigation */

        .site-nav {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 18px max(5%, calc((100% - 1200px) / 2));
            background: var(--green-deep);
            border-bottom: 1px solid var(--dark-border);
        }

        .brand {
            color: #F4F5EE;
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -0.6px;
            text-decoration: none;
            white-space: nowrap;
        }

        .brand span {
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 24px;
        }

        .nav-links a {
            color: #D0D8CC;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        .nav-links .nav-register {
            padding: 10px 16px;
            color: var(--green-deep);
            background: var(--accent);
            border: 1px solid var(--accent);
            border-radius: 7px;
        }

        .nav-links .nav-register:hover {
            color: var(--green-deep);
            background: #E9FFB8;
            border-color: #E9FFB8;
        }

        /* Main hero */

        .page-container {
            width: min(1200px, 90%);
            margin: 0 auto;
        }

        .home-section {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
            align-items: center;
            gap: 52px;
            padding: 64px 0 76px;
        }

        .eyebrow {
            margin: 0 0 18px;
            color: var(--accent-dark);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .home-hero h1 {
            max-width: 620px;
            margin: 0;
            color: var(--green);
            font-size: clamp(38px, 4.5vw, 60px);
            line-height: 1.12;
            letter-spacing: -2px;
            text-wrap: balance;
        }

        .home-hero h1 span {
            color: var(--accent-dark);
        }

        .hero-description {
            max-width: 520px;
            margin: 24px 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.9;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
        }

        .hero-button,
        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            min-height: 48px;
            padding: 13px 20px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            transition:
                transform 0.2s ease,
                background-color 0.2s ease,
                border-color 0.2s ease;
        }

        .hero-button {
            color: var(--green-deep);
            background: var(--accent);
            border-color: var(--accent);
        }

        .hero-button:hover {
            color: var(--green-deep);
            background: #E9FFB8;
            border-color: #E9FFB8;
            transform: translateY(-2px);
        }

        .secondary-button {
            color: var(--green);
            background: transparent;
            border-color: #C9D4C5;
        }

        .secondary-button:hover {
            background: #E9EDE3;
            border-color: #A9B9A3;
            transform: translateY(-1px);
        }

        .hero-note {
            margin-top: 18px;
            color: var(--muted);
            font-size: 12px;
        }

        /* Dark portfolio preview */

        .home-showcase {
            overflow: hidden;
            color: #F4F5EE;
            background: var(--green);
            border: 1px solid var(--dark-border);
            border-radius: 18px;
            box-shadow: 0 22px 55px rgba(23, 39, 31, 0.13);
            transition:
                border-color 0.25s ease,
                transform 0.25s ease;
        }

        .home-showcase:hover {
            border-color: #71855F;
            transform: translateY(-3px);
        }

        .showcase-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 19px;
            color: #F4F5EE;
            background: var(--green-light);
            border-bottom: 1px solid var(--dark-border);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .showcase-dots {
            display: flex;
            gap: 5px;
        }

        .showcase-dots span {
            width: 8px;
            height: 8px;
            background: #718075;
            border-radius: 50%;
        }

        .showcase-dots span:first-child {
            background: var(--accent);
        }

        .showcase-content {
            padding: 28px;
        }

        .showcase-profile {
            display: flex;
            align-items: center;
            gap: 17px;
        }

        .showcase-avatar {
            display: grid;
            flex-shrink: 0;
            width: 65px;
            height: 65px;
            place-items: center;
            color: var(--green-deep);
            background: var(--accent);
            border-radius: 12px;
            font-size: 21px;
            font-weight: 800;
        }

        .showcase-kicker {
            margin: 0 0 3px;
            color: var(--accent);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .showcase-profile h2 {
            margin: 0;
            color: #FFFFFF;
            font-size: 21px;
        }

        .showcase-role {
            margin: 3px 0 0;
            color: #C5D0C5;
            font-size: 13px;
        }

        .showcase-divider {
            height: 1px;
            margin: 25px 0;
            background: var(--dark-border);
        }

        .showcase-about h3,
        .showcase-skills h3,
        .showcase-project h3 {
            margin: 0 0 8px;
            color: #FFFFFF;
            font-size: 15px;
        }

        .showcase-about p,
        .showcase-project p {
            margin: 0;
            color: #D0D9D0;
            font-size: 12px;
            line-height: 1.8;
        }

        .showcase-skills {
            margin-top: 23px;
        }

        .showcase-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .showcase-tags span {
            padding: 6px 10px;
            color: var(--accent);
            background: var(--green-light);
            border: 1px solid #465B47;
            border-radius: 6px;
            font-size: 11px;
        }

        .showcase-project {
            margin-top: 23px;
            padding: 17px;
            background: var(--green-card);
            border: 1px solid #405343;
            border-radius: 9px;
        }

        .showcase-project-heading {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
            color: var(--accent);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.8px;
        }

        .showcase-footer {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 25px;
            color: #C0CCC0;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* How it works */

        .steps-section {
            padding: 65px 0 80px;
            background: var(--surface);
            border-top: 1px solid var(--border);
        }

        .section-heading {
            max-width: 650px;
            margin-bottom: 34px;
        }

        .section-heading h2 {
            margin: 0;
            color: var(--green);
            font-size: clamp(29px, 4vw, 42px);
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .section-heading h2 span {
            color: var(--accent-dark);
        }

        .section-description {
            margin: 14px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 17px;
        }

        .step-card {
            padding: 23px 20px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 11px;
            transition:
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .step-card:hover {
            border-color: #A8B99C;
            transform: translateY(-3px);
        }

        .step-number {
            display: inline-block;
            margin-bottom: 24px;
            color: var(--accent-dark);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .step-card h3 {
            margin: 0 0 10px;
            color: var(--green);
            font-size: 16px;
        }

        .step-card p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        /* Final call to action */

        .cta-section {
            padding: 65px 0;
            text-align: center;
        }

        .cta-section h2 {
            margin: 0;
            color: var(--green);
            font-size: clamp(28px, 4vw, 40px);
            letter-spacing: -1px;
        }

        .cta-section h2 span {
            color: var(--accent-dark);
        }

        .cta-section p {
            margin: 12px 0 24px;
            color: var(--muted);
            font-size: 14px;
        }

        .site-footer {
            padding: 23px 5%;
            color: var(--muted);
            background: #E9EDE3;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 12px;
        }

        /* Responsive layout */

        @media (max-width: 900px) {
            .home-section {
                grid-template-columns: minmax(0, 1fr) minmax(0, 0.9fr);
                gap: 30px;
                padding: 58px 0 65px;
            }

            .steps-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .showcase-content {
                padding: 21px;
            }
        }

        @media (max-width: 680px) {
            .site-nav {
                align-items: flex-start;
                flex-direction: column;
                gap: 14px;
                padding: 16px 5%;
            }

            .nav-links {
                justify-content: flex-start;
                flex-wrap: wrap;
                gap: 14px 20px;
            }

            .home-section {
                grid-template-columns: 1fr;
                gap: 38px;
                padding: 48px 0 55px;
            }

            .home-hero h1 {
                font-size: clamp(38px, 10vw, 54px);
                letter-spacing: -1.5px;
            }

            .home-showcase {
                width: 100%;
                max-width: 480px;
                margin: 0 auto;
            }

            .steps-section {
                padding: 48px 0 55px;
            }

            .steps-grid {
                grid-template-columns: 1fr;
            }

            .step-card {
                padding: 20px;
            }

            .step-number {
                margin-bottom: 12px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>
    <nav class="site-nav">
        <a class="brand" href="/">Portfolio <span>Generator</span></a>

        <div class="nav-links">
            <a href="/portfolio/manage">Manage Portfolio</a>
            <a href="/login">Log In</a>
            <a class="nav-register" href="/register">Register</a>
        </div>
    </nav>

    <main>
        <section class="page-container home-section">
            <div class="home-hero">
                <p class="eyebrow">YOUR STORY, BEAUTIFULLY PRESENTED</p>

                <h1>Create a portfolio<br>that feels like <span>you.</span></h1>

                <p class="hero-description">
                    Turn your skills, projects, and experience into a professional
                    portfolio with a design that represents you.
                </p>

                <div class="hero-actions">
                    <a href="/portfolio/setup" class="hero-button">
                        Create My Portfolio <span aria-hidden="true">→</span>
                    </a>

                    <a href="/login" class="secondary-button">Log In</a>
                </div>

                <p class="hero-note">Simple to build. Professional by design.</p>
            </div>

            <aside class="home-showcase" aria-label="Sample portfolio preview">
                <div class="showcase-topbar">
                    <div class="showcase-dots" aria-hidden="true">
                        <span></span><span></span><span></span>
                    </div>
                    <span>PORTFOLIO PREVIEW</span>
                </div>

                <div class="showcase-content">
                    <div class="showcase-profile">
                        <div class="showcase-avatar" aria-hidden="true">AM</div>
                        <div>
                            <p class="showcase-kicker">HELLO, I'M</p>
                            <h2>Alex Morgan</h2>
                            <p class="showcase-role">Creative Developer</p>
                        </div>
                    </div>

                    <div class="showcase-divider"></div>

                    <div class="showcase-about">
                        <h3>A little about me</h3>
                        <p>
                            I enjoy bringing ideas to life through thoughtful design,
                            creative problem-solving, and web development.
                        </p>
                    </div>

                    <div class="showcase-skills">
                        <h3>Core skills</h3>
                        <div class="showcase-tags">
                            <span>HTML</span>
                            <span>CSS</span>
                            <span>JavaScript</span>
                        </div>
                    </div>

                    <div class="showcase-project">
                        <div class="showcase-project-heading">
                            <span>01 / FEATURED WORK</span>
                            <span aria-hidden="true">↗</span>
                        </div>
                        <h3>Personal Website</h3>
                        <p>
                            A clean digital space for ideas, projects, and professional growth.
                        </p>
                    </div>

                    <div class="showcase-footer">
                        <span>DESIGNED WITH PURPOSE</span>
                        <span>2026</span>
                    </div>
                </div>
            </aside>
        </section>

        <section class="steps-section" id="how-it-works">
            <div class="page-container">
                <div class="section-heading">
                    <p class="eyebrow">HOW IT WORKS</p>
                    <h2>Build your portfolio in <span>four simple steps.</span></h2>
                    <p class="section-description">
                        Everything you need to present your skills, experience, and projects in one place.
                    </p>
                </div>

                <div class="steps-grid">
                    <article class="step-card">
                        <span class="step-number">01 / INFORMATION</span>
                        <h3>Enter your information</h3>
                        <p>Add your personal details, education, skills, projects, and experience.</p>
                    </article>

                    <article class="step-card">
                        <span class="step-number">02 / DESIGN</span>
                        <h3>Choose a template</h3>
                        <p>Select a Simple, Modern, or Creative design that suits your style.</p>
                    </article>

                    <article class="step-card">
                        <span class="step-number">03 / PREVIEW</span>
                        <h3>Preview your portfolio</h3>
                        <p>Review how your information looks in your selected design.</p>
                    </article>

                    <article class="step-card">
                        <span class="step-number">04 / MANAGE</span>
                        <h3>Manage your portfolio</h3>
                        <p>Edit your details and update your portfolio whenever you need.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="cta-section page-container">
            <h2>Ready to show the world <span>your work?</span></h2>
            <p>Start building a professional portfolio that represents you.</p>
            <a href="/portfolio/setup" class="hero-button">
                Get Started <span aria-hidden="true">→</span>
            </a>
        </section>
    </main>

    <footer class="site-footer">
        Portfolio Generator · Build your story. Present your work.
    </footer>
</body>
</html>
