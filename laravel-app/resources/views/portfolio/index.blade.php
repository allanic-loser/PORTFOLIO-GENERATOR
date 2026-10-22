<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#17271F">
    <title>My Portfolios | Portfolio Generator</title>

    <style>
        :root {
            --bg: #F4F5EE;
            --surface: #FFFFFF;
            --surface-light: #E9EDE3;
            --accent: #DFFF9A;
            --accent-dark: #526B35;
            --green: #17271F;
            --green-deep: #111810;
            --green-light: #26382B;
            --text: #17271F;
            --muted: #59675B;
            --border: #DCE3D7;
            --dark-border: #3B4C3E;
            --danger: #A63732;
            --danger-bg: #FBEAE7;
            --danger-border: #E6B8B2;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
        }

        a,
        button {
            -webkit-tap-highlight-color: transparent;
        }

        /* Header */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 17px max(5%, calc((100% - 1100px) / 2));
            background: var(--green-deep);
            border-bottom: 1px solid var(--dark-border);
        }

        .brand {
            color: #F4F5EE;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.6px;
            text-decoration: none;
            white-space: nowrap;
        }

        .brand span {
            color: var(--accent);
        }

        .topbar-link {
            color: #D0D8CC;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .topbar-link:hover {
            color: var(--accent);
        }

        /* Page heading */

        .container {
            width: min(100% - 40px, 1040px);
            margin: 0 auto;
            padding: 54px 0 76px;
            flex: 1;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 32px;
        }

        .eyebrow {
            margin: 0 0 9px;
            color: var(--accent-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: var(--green);
            font-size: clamp(32px, 5vw, 42px);
            line-height: 1.15;
            letter-spacing: -1.5px;
        }

        .subtitle {
            margin: 12px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        /* Buttons */

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 43px;
            padding: 11px 16px;
            color: var(--green-deep);
            background: var(--accent);
            border: 1px solid transparent;
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            white-space: nowrap;
            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease;
        }

        .button:hover {
            color: var(--green-deep);
            background: #E9FFB8;
            transform: translateY(-1px);
        }

        .button-secondary {
            color: var(--green);
            background: var(--surface-light);
            border-color: var(--border);
        }

        .button-secondary:hover {
            color: var(--green);
            background: #DDE6D6;
            border-color: #B8C8B1;
        }

        .button-danger {
            color: var(--danger);
            background: transparent;
            border-color: var(--danger-border);
        }

        .button-danger:hover {
            color: #FFFFFF;
            background: var(--danger);
            border-color: var(--danger);
        }

        /* Success message */

        .message {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 24px;
            padding: 14px 16px;
            color: #294B2D;
            background: #E8F2DF;
            border: 1px solid #C5DDB5;
            border-radius: 10px;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        /* Portfolio list */

        .portfolio-count {
            margin: 0 0 14px;
            color: var(--muted);
            font-size: 12px;
        }

        .portfolio-list {
            display: grid;
            gap: 16px;
        }

        .portfolio {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
            padding: 28px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 15px;
            box-shadow: 0 12px 32px rgba(23, 39, 31, 0.06);
            transition:
                border-color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .portfolio:hover {
            border-color: #B6C9A8;
            box-shadow: 0 16px 36px rgba(23, 39, 31, 0.10);
            transform: translateY(-2px);
        }

        .portfolio-info {
            min-width: 0;
        }

        .portfolio-label {
            margin: 0 0 8px;
            color: var(--accent-dark);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .portfolio h2 {
            margin: 0 0 7px;
            color: var(--green);
            font-size: 23px;
            line-height: 1.35;
            letter-spacing: -0.5px;
            overflow-wrap: anywhere;
        }

        .portfolio-email {
            margin: 0 0 15px;
            color: var(--muted);
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .template-tag {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            color: #3E572A;
            background: #EEF4E4;
            border: 1px solid #D4E2C5;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .portfolio-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
            flex-shrink: 0;
        }

        .portfolio-actions form {
            margin: 0;
        }

        /* Empty state */

        .empty-state {
            padding: 52px 24px;
            background: var(--surface);
            border: 1px dashed #B8C8B1;
            border-radius: 15px;
            text-align: center;
        }

        .empty-icon {
            display: grid;
            width: 62px;
            height: 62px;
            margin: 0 auto 20px;
            place-items: center;
            color: var(--green-deep);
            background: var(--accent);
            border: 1px solid #C6E78C;
            border-radius: 16px;
            font-size: 29px;
        }

        .empty-state h2 {
            margin: 0 0 9px;
            color: var(--green);
            font-size: 22px;
            letter-spacing: -0.5px;
        }

        .empty-state p {
            max-width: 390px;
            margin: 0 auto 24px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        /* Footer */

        .footer {
            padding: 22px 20px;
            color: var(--muted);
            background: #E9EDE3;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 12px;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid var(--accent-dark);
            outline-offset: 4px;
        }

        .button:active {
            transform: translateY(0);
        }

        .button:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        /* Responsive layout */

        @media (max-width: 720px) {
            .container {
                padding-top: 36px;
                padding-bottom: 52px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
            }

            .portfolio {
                align-items: flex-start;
                flex-direction: column;
                gap: 22px;
                padding: 23px;
            }

            .portfolio-actions {
                justify-content: flex-start;
                width: 100%;
            }
        }

        @media (max-width: 440px) {
            .topbar {
                padding: 15px;
            }

            .brand {
                font-size: 18px;
            }

            .topbar-link {
                font-size: 12px;
            }

            .container {
                width: calc(100% - 30px);
            }

            .portfolio {
                padding: 19px;
            }

            .portfolio h2 {
                font-size: 20px;
            }

            .portfolio-actions {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .portfolio-actions .button {
                width: 100%;
                min-height: 44px;
            }

            .portfolio-actions form {
                grid-column: 1 / -1;
            }

            .portfolio-actions form .button {
                width: 100%;
            }

            .empty-state {
                padding: 38px 19px;
            }
        }

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
                <p class="eyebrow">Your Workspace</p>
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

                        <a
                            class="button button-secondary"
                            href="/portfolio/{{ $portfolio->id }}/edit"
                        >
                            Edit
                        </a>

                        <form
                            action="/portfolio/{{ $portfolio->id }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this portfolio? This cannot be undone.')"
                        >
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
                <p>
                    You haven't created a portfolio yet. Add your details and
                    choose a design to get started.
                </p>
                <a class="button" href="/portfolio/setup">Create My Portfolio</a>
            </section>
        @endforelse
    </main>

    <footer class="footer">
        Portfolio Generator · Build your story. Present your work.
    </footer>
</body>
</html>
