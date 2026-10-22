<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111111">
    <title>My Portfolios | Portfolio Generator</title>

    <style>
        :root {
            --bg: #111510;
            --surface: #151D18;
            --surface-light: #202A22;
            --accent: #DFFF9A;
            --text: #F4F5EE;
            --muted: #B8C0B4;
            --border: #354136;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 17px max(5%, calc((100% - 1100px) / 2));
            border-bottom: 1px solid var(--border);
            background: #151515;
        }

        .brand {
            color: var(--text);
            font-size: 20px;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .brand span {
            color: var(--accent);
        }

        .topbar-link {
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .topbar-link:hover {
            color: var(--accent);
        }

        .container {
            width: min(100% - 40px, 1000px);
            margin: 0 auto;
            padding: 48px 0 70px;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 30px;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: var(--accent);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
        }

        h1 {
            margin: 0 0 9px;
            font-size: clamp(29px, 4vw, 38px);
            line-height: 1.2;
            letter-spacing: -0.8px;
        }

        .subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 43px;
            padding: 11px 16px;
            border: 1px solid transparent;
            border-radius: 7px;
            background: var(--accent);
            color: #111111;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s,
                        color 0.2s, transform 0.2s;
        }

        .button:hover {
            background: #cbed83;
            transform: translateY(-1px);
        }

        .button-secondary {
            color: var(--text);
            background: transparent;
            border-color: #505050;
        }

        .button-secondary:hover {
            color: var(--accent);
            background: #292929;
            border-color: var(--accent);
        }

        .button-danger {
            color: #ffb4ab;
            background: transparent;
            border-color: #65403d;
        }

        .button-danger:hover {
            color: #ffffff;
            background: #6b302b;
            border-color: #6b302b;
        }

        .message {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 24px;
            padding: 14px 16px;
            color: var(--accent);
            background: #222d1b;
            border: 1px solid #3d5030;
            border-radius: 8px;
            font-size: 14px;
        }

        .portfolio-count {
            margin: 0 0 13px;
            color: var(--muted);
            font-size: 12px;
        }

        .portfolio-list {
            display: grid;
            gap: 18px;
        }

        .portfolio {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
            padding: 25px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: border-color 0.2s;
        }

        .portfolio:hover {
            border-color: #64764c;
        }

        .portfolio-info {
            min-width: 0;
        }

        .portfolio-label {
            margin: 0 0 7px;
            color: var(--accent);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .portfolio h2 {
            overflow-wrap: anywhere;
            margin: 0 0 6px;
            font-size: 22px;
            line-height: 1.35;
        }

        .portfolio-email {
            overflow-wrap: anywhere;
            margin: 0 0 12px;
            color: var(--muted);
            font-size: 14px;
        }

        .template-tag {
            display: inline-block;
            padding: 5px 9px;
            color: var(--accent);
            background: #303b25;
            border: 1px solid #465339;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .portfolio-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 8px;
            flex-shrink: 0;
        }

        .portfolio-actions form {
            margin: 0;
        }

        .empty-state {
            padding: 48px 24px;
            background: var(--surface);
            border: 1px dashed #505050;
            border-radius: 12px;
            text-align: center;
        }

        .empty-icon {
            display: grid;
            width: 56px;
            height: 56px;
            margin: 0 auto 18px;
            place-items: center;
            color: var(--accent);
            background: #303b25;
            border-radius: 14px;
            font-size: 25px;
        }

        .empty-state h2 {
            margin: 0 0 8px;
            font-size: 21px;
        }

        .empty-state p {
            max-width: 390px;
            margin: 0 auto 22px;
            color: var(--muted);
            font-size: 14px;
        }

        .footer {
            padding: 20px;
            color: #858585;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 12px;
        }

        @media (max-width: 720px) {
            .container {
                padding-top: 34px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
            }

            .portfolio {
                align-items: flex-start;
                flex-direction: column;
                gap: 20px;
                padding: 21px;
            }

            .portfolio-actions {
                justify-content: flex-start;
            }
        }

        @media (max-width: 440px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
                padding: 15px 20px;
            }

            .container {
                width: calc(100% - 30px);
            }

            .portfolio-actions {
                display: grid;
                grid-template-columns: 1fr 1fr;
                width: 100%;
            }

            .portfolio-actions .button {
                width: 100%;
            }

            .portfolio-actions form {
                grid-column: 1 / -1;
            }
            .portfolio {
                padding: 18px;
            }

            .portfolio h2 {
                font-size: 20px;
            }

            .portfolio-actions {
                gap: 10px;
            }

            .portfolio-actions .button {
                min-height: 44px;
            }
        }
        /* Accessibility: clear keyboard focus */
        a:focus-visible,
        button:focus-visible {
            outline: 3px solid var(--accent);
            outline-offset: 4px;
        }

        /* Respect reduced-motion preferences */
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
        .button:active {
            transform: translateY(0);
        }

        .button:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="/">Portfolio <span>Generator</span></a>
        <a class="topbar-link" href="/">← Back to Home</a>
    </header>

    <main class="container">
        <header class="page-header">
            <div>
                <p class="eyebrow">YOUR WORKSPACE</p>
                <h1>My Portfolio</h1>
                <p class="subtitle">Manage your professional portfolio in one place.</p>
            </div>

            @if ($portfolios->isEmpty())
                <a class="button" href="/portfolio/setup">+ Create Portfolio</a>
            @endif
        </header>

        @if (session('success'))
            <div class="message" role="status">
                <span aria-hidden="true">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($portfolios->isNotEmpty())
            <p class="portfolio-count">Your saved portfolio</p>
        @endif

        @forelse ($portfolios as $portfolio)
            <div class="portfolio-list">
                <section class="portfolio">
                    <div class="portfolio-info">
                        <p class="portfolio-label">Professional Portfolio</p>
                        <h2>{{ $portfolio->full_name }}</h2>
                        <p class="portfolio-email">{{ $portfolio->email }}</p>
                        <span class="template-tag">
                            {{ $portfolio->template ?? 'Simple' }} template
                        </span>
                    </div>

                    <div class="portfolio-actions">
                        <a class="button" href="/portfolio/{{ $portfolio->id }}/preview">
                            Preview
                        </a>

                        <a class="button button-secondary"
                           href="/portfolio/{{ $portfolio->id }}/edit">
                            Edit
                        </a>

                        <form action="/portfolio/{{ $portfolio->id }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this portfolio? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button class="button button-danger" type="submit">
                                Delete
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        @empty
            <section class="empty-state">
                <div class="empty-icon" aria-hidden="true">＋</div>
                <h2>Your portfolio starts here</h2>
                <p>You haven't created a portfolio yet. Add your details and choose a design to get started.</p>
                <a class="button" href="/portfolio/setup">Create My Portfolio</a>
            </section>
        @endforelse
    </main>

    <footer class="footer">
        Portfolio Generator · Build your story. Present your work.
    </footer>
</body>
</html>
