<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#F4F5EE">
    <title>Register | Portfolio Generator</title>

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
            --success-bg: #E8F2DF;
            --success-border: #C5DDB5;
            --success-text: #294B2D;
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

        a,
        button {
            -webkit-tap-highlight-color: transparent;
        }

        .auth-card {
            width: 100%;
            max-width: 480px;
            padding: 36px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 18px 50px rgba(23, 39, 31, 0.08);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 26px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--accent-dark);
            text-decoration: underline;
        }

        .brand {
            margin-bottom: 28px;
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
            font-size: clamp(28px, 5vw, 34px);
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .subtitle {
            margin: 0 0 25px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .form-group input {
            display: block;
            width: 100%;
            min-height: 48px;
            padding: 12px 14px;
            background: var(--bg);
            color: var(--text);
            border: 1px solid #CDD7C8;
            border-radius: 8px;
            outline: none;
            font-family: inherit;
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
            width: 100%;
            min-height: 50px;
            margin-top: 5px;
            padding: 13px 16px;
            color: var(--green-deep);
            background: var(--accent);
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
            border: 1px solid;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .message[hidden] {
            display: none;
        }

        .message.error {
            color: var(--error-text);
            background: var(--error-bg);
            border-color: var(--error-border);
        }

        .message.success {
            color: var(--success-text);
            background: var(--success-bg);
            border-color: var(--success-border);
        }

        .auth-footer {
            margin-top: 23px;
            padding-top: 19px;
            color: var(--muted);
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 13px;
            line-height: 1.8;
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
                margin-bottom: 25px;
            }

            .subtitle {
                margin-bottom: 22px;
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

        <p class="eyebrow">GET STARTED</p>
        <h1>Create your account</h1>

        <p class="subtitle">
            Register to start building and managing your portfolio.
        </p>

        <div
            id="register-message"
            class="message"
            role="alert"
            aria-live="polite"
            hidden
        ></div>

        <form id="register-form">
            <div class="form-group">
                <label for="full_name">Full name</label>
                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    placeholder="Enter your full name"
                    autocomplete="name"
                    required
                >
            </div>

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
                    placeholder="At least 8 characters"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Re-enter your password"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >
            </div>

            <button class="submit-button" type="submit">
                Create Account
            </button>
        </form>

        <div class="auth-footer">
            Already have an account?
            <a href="{{ route('login') }}">Log In</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

    <script>
        const registerForm = document.getElementById('register-form');
        const registerMessage = document.getElementById('register-message');

        function showRegisterMessage(message, type) {
            registerMessage.textContent = message;
            registerMessage.className = 'message ' + type;
            registerMessage.hidden = false;
            registerMessage.setAttribute(
                'role',
                type === 'error' ? 'alert' : 'status'
            );
        }

        registerForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            registerMessage.hidden = true;

            const fullName = document.getElementById('full_name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmation =
                document.getElementById('password_confirmation').value;

            const button = registerForm.querySelector(
                'button[type="submit"]'
            );

            if (password !== confirmation) {
                showRegisterMessage(
                    'Your passwords do not match.',
                    'error'
                );
                return;
            }

            button.disabled = true;
            button.textContent = 'Creating account...';

            let client;

            try {
                if (!window.supabase?.createClient) {
                    throw new Error(
                        'The registration service could not load. Refresh and try again.'
                    );
                }

                client = window.supabase.createClient(
                    'https://gepyzwfwrrtbvtoqyijd.supabase.co',
                    'sb_publishable_hruPNSMRN6XCWsNdLwHkWA_HnLb1eXm'
                );

                const { data, error } = await client.auth.signUp({
                    email: email,
                    password: password,
                    options: {
                        data: {
                            full_name: fullName
                        }
                    }
                });

                if (error) {
                    throw error;
                }

                if (!data.session) {
                    showRegisterMessage(
                        'Account created! Check your email to confirm your account, then log in.',
                        'success'
                    );

                    registerForm.reset();
                    return;
                }

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
                    throw new Error(
                        'Your account was created, but the website session could not be started. Please log in.'
                    );
                }

                window.location.href = '/portfolio/manage';
            } catch (error) {
                showRegisterMessage(
                    error.message ||
                        'Unable to create your account. Please try again.',
                    'error'
                );
            } finally {
                button.disabled = false;
                button.textContent = 'Create Account';
            }
        });
    </script>
</body>
</html>