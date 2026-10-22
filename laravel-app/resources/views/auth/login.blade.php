<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#F4F5EE">
    <title>Log In | Portfolio Generator</title>

    <style>
        :root {
            --bg: #F4F5EE;
            --surface: #FFFFFF;
            --surface-light: #E9EDE3;
            --text: #17271F;
            --muted: #59675B;
            --accent: #DFFF9A;
            --accent-dark: #526B35;
            --border: #DCE3D7;
            --green-deep: #111810;
            --error-bg: #FBEAE7;
            --error-border: #E6B8B2;
            --error-text: #8F2925;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 32px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(
                    circle at 12% 10%,
                    rgba(82, 107, 53, 0.07),
                    transparent 30%
                ),
                var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        .auth-card {
            width: 100%;
            max-width: 460px;
            padding: 36px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 18px 50px rgba(23, 39, 31, 0.08);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--accent-dark);
        }

        .brand {
            margin-bottom: 32px;
            color: var(--text);
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.6px;
        }

        .brand span {
            color: var(--accent-dark);
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
            margin: 0 0 9px;
            color: var(--text);
            font-size: clamp(29px, 5vw, 34px);
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .subtitle {
            margin: 0 0 28px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .form-group input {
            display: block;
            width: 100%;
            min-height: 49px;
            padding: 13px 14px;
            background: var(--bg);
            color: var(--text);
            border: 1px solid #CDD7C8;
            border-radius: 8px;
            outline: none;
            font: inherit;
            font-size: 14px;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background-color 0.2s ease;
        }

        .form-group input::placeholder {
            color: #788376;
        }

        .form-group input:hover {
            border-color: #A8B99C;
        }

        .form-group input:focus {
            background: #FFFFFF;
            border-color: var(--accent-dark);
            box-shadow: 0 0 0 3px rgba(82, 107, 53, 0.12);
        }

        .submit-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 50px;
            margin-top: 7px;
            padding: 13px 16px;
            background: var(--accent);
            color: var(--green-deep);
            border: 1px solid transparent;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition:
                background-color 0.2s ease,
                transform 0.2s ease;
        }

        .submit-button:hover:not(:disabled) {
            background: #E9FFB8;
            transform: translateY(-1px);
        }

        .submit-button:active:not(:disabled) {
            transform: translateY(0);
        }

        .submit-button:disabled {
            opacity: 0.65;
            cursor: wait;
            transform: none;
        }

        .message {
            margin-bottom: 18px;
            padding: 12px 14px;
            color: var(--error-text);
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .message[hidden] {
            display: none;
        }

        .auth-footer {
            margin-top: 25px;
            padding-top: 20px;
            color: var(--muted);
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 13px;
        }

        .auth-footer a {
            color: var(--accent-dark);
            font-weight: 800;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid var(--accent-dark);
            outline-offset: 4px;
        }

        @media (max-width: 480px) {
            body {
                padding: 18px 14px;
            }

            .auth-card {
                padding: 27px 22px;
                border-radius: 13px;
            }

            .brand {
                margin-bottom: 27px;
            }

            .subtitle {
                margin-bottom: 23px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>
    <main class="auth-card">
        <a class="back-link" href="/">← Back to Home</a>

        <div class="brand">Portfolio <span>Generator</span></div>

        <p class="eyebrow">WELCOME BACK</p>
        <h1>Welcome back</h1>

        <p class="subtitle">
            Log in to continue building and managing your portfolio.
        </p>

        <div id="login-error" class="message" role="alert" hidden></div>

        <form id="login-form">
            <div class="form-group">
                <label for="email">Email address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="you@example.com"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button class="submit-button" type="submit">Log In</button>
        </form>

        <div class="auth-footer">
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script src="/js/laravel-supabase.js"></script>

    <script>
        const loginForm = document.getElementById('login-form');
        const loginError = document.getElementById('login-error');

        loginForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            loginError.hidden = true;

            const button = loginForm.querySelector('button[type="submit"]');
            button.disabled = true;
            button.textContent = 'Logging in...';

            try {
                if (!window.supabase?.createClient) {
                    throw new Error(
                        'The login service could not load. Refresh and try again.'
                    );
                }

                const client = window.supabase.createClient(
                    'https://gepyzwfwrrtbvtoqyijd.supabase.co',
                    'sb_publishable_hruPNSMRN6XCWsNdLwHkWA_HnLb1eXm'
                );

                const { data, error } = await client.auth.signInWithPassword({
                    email: document.getElementById('email').value.trim(),
                    password: document.getElementById('password').value
                });

                if (error) throw error;

                const response = await fetch('/supabase/session', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content
                    },
                    body: JSON.stringify({
                        access_token: data.session.access_token
                    })
                });

                if (!response.ok) {
                    await client.auth.signOut();

                    throw new Error(
                        'Login succeeded, but the website session could not be created. Please try again.'
                    );
                }

                window.location.href = '/portfolio/manage';
            } catch (error) {
                loginError.textContent =
                    error.message || 'Unable to log in. Please try again.';
                loginError.hidden = false;
            } finally {
                button.disabled = false;
                button.textContent = 'Log In';
            }
        });
    </script>
</body>
</html>