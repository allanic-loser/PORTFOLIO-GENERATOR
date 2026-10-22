<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#F4F5EE">

    <title>Connecting Your Portfolio | Portfolio Generator</title>

    <style>
        :root {
            --bg: #F4F5EE;
            --surface: #FFFFFF;
            --surface-light: #E9EDE3;
            --green: #17271F;
            --green-deep: #111810;
            --text: #17271F;
            --muted: #59675B;
            --accent: #DFFF9A;
            --accent-dark: #526B35;
            --border: #DCE3D7;
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
            padding: 24px;
            display: grid;
            place-items: center;
            background:
                radial-gradient(
                    circle at 15% 10%,
                    rgba(82, 107, 53, 0.08),
                    transparent 35%
                ),
                var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
        }

        .setup-card {
            width: 100%;
            max-width: 460px;
            padding: 38px 34px;
            text-align: center;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 18px 45px rgba(23, 39, 31, 0.08);
        }

        .brand {
            margin-bottom: 30px;
            color: var(--green);
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .brand span {
            color: var(--accent-dark);
        }

        .loader {
            width: 44px;
            height: 44px;
            margin: 0 auto 24px;
            border: 4px solid var(--surface-light);
            border-top-color: var(--accent-dark);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        h1 {
            margin: 0 0 12px;
            color: var(--green);
            font-size: clamp(22px, 5vw, 28px);
            line-height: 1.3;
            letter-spacing: -0.5px;
            overflow-wrap: anywhere;
        }

        #status {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }

        #status.error {
            margin-top: 18px;
            padding: 13px 15px;
            color: var(--error-text);
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            border-radius: 9px;
        }

        .loader[hidden] {
            display: none;
        }

        .loading-label {
            margin: 0 0 8px;
            color: var(--accent-dark);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .setup-card {
                padding: 30px 22px;
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
    <main class="setup-card">
        <div class="brand">Portfolio <span>Generator</span></div>

        <div class="loader" id="loader" aria-hidden="true"></div>

        <p class="loading-label" id="loading-label">One moment</p>

        <h1 id="heading">Connecting your portfolio...</h1>

        <p id="status" role="status" aria-live="polite">
            Verifying your session with Supabase.
        </p>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script src="/js/laravel-supabase.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const status = document.getElementById("status");
            const heading = document.getElementById("heading");
            const loader = document.getElementById("loader");
            const loadingLabel = document.getElementById("loading-label");

            try {
                await ensureLaravelSupabaseSession();

                status.textContent =
                    "Session verified! Opening your portfolio form...";

                heading.textContent = "You're all set!";
                loadingLabel.textContent = "Connection successful";

                window.location.replace("/portfolio/create");
            } catch (error) {
                console.error("Session setup failed:", error);

                heading.textContent = "Connection failed";
                loadingLabel.textContent = "Unable to connect";

                status.classList.add("error");
                status.setAttribute("role", "alert");
                status.textContent =
                    "Could not connect your session. Please refresh the page and try again.";

                loader.hidden = true;
            }
        });
    </script>
</body>
</html>