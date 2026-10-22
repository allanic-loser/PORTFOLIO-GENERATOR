<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#F4F5EE">

    <title>Create Portfolio | Portfolio Generator</title>

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
            --muted: #59675B;
            --border: #DCE3D7;
            --dark-border: #3B4C3E;
            --error-bg: #FBEAE7;
            --error-border: #E6B8B2;
            --error-text: #8F2925;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background:
                radial-gradient(
                    circle at 12% 5%,
                    rgba(82, 107, 53, 0.06),
                    transparent 28%
                ),
                var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
        }

        a {
            color: var(--accent-dark);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .container {
            width: min(100% - 40px, 1000px);
            margin: 0 auto;
            padding: 48px 0 72px;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: var(--accent-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: var(--green);
            font-size: clamp(30px, 5vw, 42px);
            line-height: 1.2;
            letter-spacing: -1.3px;
        }

        .page-description {
            margin: 12px 0 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        /* Validation messages */

        .errors {
            margin-bottom: 22px;
            padding: 16px 18px;
            color: var(--error-text);
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            border-radius: 10px;
            font-size: 14px;
        }

        .errors strong {
            display: block;
            margin-bottom: 6px;
        }

        .errors ul {
            margin: 0;
            padding-left: 22px;
        }

        .errors li + li {
            margin-top: 4px;
        }

        /* Main form */

        .form-card {
            padding: 30px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 16px 45px rgba(23, 39, 31, 0.06);
        }

        .required-note {
            margin: 0 0 26px;
            color: var(--muted);
            font-size: 12px;
        }

        .form-section + .form-section {
            margin-top: 34px;
            padding-top: 30px;
            border-top: 1px solid var(--border);
        }

        .section-title {
            margin: 0;
            color: var(--green);
            font-size: 22px;
            line-height: 1.3;
            letter-spacing: -0.5px;
        }

        .section-description {
            margin: 8px 0 23px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .field {
            margin-bottom: 20px;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .field input:not([type="checkbox"]):not([type="radio"]),
        .field textarea,
        .field select {
            display: block;
            width: 100%;
            min-height: 47px;
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

        .field input::placeholder,
        .field textarea::placeholder {
            color: #788376;
        }

        .field input:hover,
        .field textarea:hover,
        .field select:hover {
            border-color: #A8B99C;
        }

        .field input:focus,
        .field textarea:focus,
        .field select:focus {
            background: #FFFFFF;
            border-color: var(--accent-dark);
            box-shadow: 0 0 0 3px rgba(82, 107, 53, 0.12);
        }

        .field textarea {
            min-height: 115px;
            resize: vertical;
        }

        .field input[type="file"] {
            padding: 10px;
            background: var(--bg);
            color: var(--muted);
            cursor: pointer;
        }

        .field input[type="file"]::file-selector-button {
            margin-right: 12px;
            padding: 8px 12px;
            color: var(--green);
            background: var(--surface-light);
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: inherit;
            font-weight: 700;
            cursor: pointer;
        }

        .field input[type="file"]::file-selector-button:hover {
            background: #DDE6D6;
        }

        .field small {
            display: block;
            margin-top: 7px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .field select {
            cursor: pointer;
        }

        /* Form actions */

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-top: 34px;
            padding-top: 25px;
            border-top: 1px solid var(--border);
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 12px 19px;
            color: var(--green-deep);
            background: var(--accent);
            border: 1px solid transparent;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
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
            text-decoration: none;
        }

        .button-secondary {
            color: var(--green);
            background: var(--surface);
            border-color: var(--border);
        }

        .button-secondary:hover {
            color: var(--green);
            background: var(--surface-light);
            border-color: #B8C8B1;
        }

        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        textarea:focus-visible,
        select:focus-visible {
            outline: 3px solid var(--accent-dark);
            outline-offset: 3px;
        }

        /* Responsive layout */

        @media (max-width: 600px) {
            .container {
                width: calc(100% - 28px);
                padding: 30px 0 45px;
            }

            .page-header {
                margin-bottom: 22px;
            }

            .form-card {
                padding: 21px 17px;
                border-radius: 12px;
            }

            .section-title {
                font-size: 20px;
            }

            .form-section + .form-section {
                margin-top: 27px;
                padding-top: 25px;
            }

            .form-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .form-actions .button {
                width: 100%;
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
    <main class="container">
        <div class="page-header">
            <p class="eyebrow">BUILD YOUR PROFESSIONAL PROFILE</p>
            <h1>Create Your Portfolio</h1>
            <p class="page-description">
                Enter your information below and choose a design that represents you.
            </p>
        </div>

        @if ($errors->any())
            <div class="errors" role="alert" aria-labelledby="form-error-title">
                <strong id="form-error-title">Please fix these errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/portfolio" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-card">
                <p class="required-note">Fields marked with * are required.</p>

                <section class="form-section">
                    <h2 class="section-title">Personal Information</h2>
                    <p class="section-description">
                        Add the details employers need to know about you.
                    </p>

                    <div class="field">
                        <label for="full_name">Full Name *</label>
                        <input
                            id="full_name"
                            name="full_name"
                            value="{{ old('full_name') }}"
                            autocomplete="name"
                            placeholder="Enter your full name"
                            required
                        >
                    </div>

                    <div class="field">
                        <label for="email">Email *</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            placeholder="you@example.com"
                            required
                        >
                    </div>

                    <div class="field">
                        <label for="profile_picture">Profile Picture</label>
                        <input
                            id="profile_picture"
                            type="file"
                            name="profile_picture"
                            accept="image/jpeg,image/png,image/webp"
                        >
                        <small>
                            Upload a JPG, PNG, or WebP image. Maximum size: 2 MB.
                        </small>
                    </div>

                    <div class="field">
                        <label for="contact_number">Contact Number</label>
                        <input
                            id="contact_number"
                            name="contact_number"
                            value="{{ old('contact_number') }}"
                            autocomplete="tel"
                            placeholder="Enter your contact number"
                        >
                    </div>

                    <div class="field">
                        <label for="address">Address</label>
                        <textarea
                            id="address"
                            name="address"
                            placeholder="Enter your address"
                        >{{ old('address') }}</textarea>
                    </div>
                </section>

                <section class="form-section">
                    <h2 class="section-title">Professional Profile</h2>
                    <p class="section-description">
                        Describe your background, skills, and experience.
                    </p>

                    <div class="field">
                        <label for="about_me">About Me</label>
                        <textarea
                            id="about_me"
                            name="about_me"
                            placeholder="Write a short introduction about yourself"
                        >{{ old('about_me') }}</textarea>
                    </div>

                    <div class="field">
                        <label for="education">Educational Background</label>
                        <textarea
                            id="education"
                            name="education"
                            placeholder="Add your education and qualifications"
                        >{{ old('education') }}</textarea>
                    </div>

                    <div class="field">
                        <label for="skills">Skills</label>
                        <textarea
                            id="skills"
                            name="skills"
                            placeholder="List your skills"
                        >{{ old('skills') }}</textarea>
                    </div>

                    <div class="field">
                        <label for="projects">Projects</label>
                        <textarea
                            id="projects"
                            name="projects"
                            placeholder="Describe your projects"
                        >{{ old('projects') }}</textarea>
                    </div>

                    <div class="field">
                        <label for="work_experience">Work Experience</label>
                        <textarea
                            id="work_experience"
                            name="work_experience"
                            placeholder="Describe your work or relevant experience"
                        >{{ old('work_experience') }}</textarea>
                    </div>

                    <div class="field">
                        <label for="social_links">Social Media / Website Links</label>
                        <textarea
                            id="social_links"
                            name="social_links"
                            placeholder="Add your LinkedIn, GitHub, or website links"
                        >{{ old('social_links') }}</textarea>
                    </div>
                </section>

                <section class="form-section">
                    <h2 class="section-title">Portfolio Design</h2>
                    <p class="section-description">
                        Choose the design you want to use for your portfolio.
                    </p>

                    <div class="field">
                        <label for="template">Portfolio Template</label>
                        <select id="template" name="template">
                            <option
                                value="simple"
                                {{ old('template', 'simple') === 'simple' ? 'selected' : '' }}
                            >
                                Simple
                            </option>
                            <option
                                value="modern"
                                {{ old('template') === 'modern' ? 'selected' : '' }}
                            >
                                Modern
                            </option>
                            <option
                                value="creative"
                                {{ old('template') === 'creative' ? 'selected' : '' }}
                            >
                                Creative
                            </option>
                        </select>
                    </div>
                </section>

                <div class="form-actions">
                    <button class="button" type="submit">Save Portfolio →</button>
                    <a class="button button-secondary" href="/portfolio/manage">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script src="/js/laravel-supabase.js"></script>
</body>
</html>