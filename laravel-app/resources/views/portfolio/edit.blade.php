<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#F4F5EE">

    <title>Edit Portfolio | Portfolio Generator</title>

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
            padding: 40px 20px;
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

        .container {
            width: 100%;
            max-width: 820px;
            margin: 0 auto;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 25px;
            color: var(--accent-dark);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .eyebrow {
            margin: 0 0 9px;
            color: var(--accent-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
        }

        h1 {
            margin: 0 0 10px;
            color: var(--green);
            font-size: clamp(30px, 4vw, 40px);
            line-height: 1.2;
            letter-spacing: -1.2px;
        }

        .page-description {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        /* Form card */

        .form-card {
            padding: 30px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 16px 45px rgba(23, 39, 31, 0.06);
        }

        .required-note {
            margin: 0 0 25px;
            color: var(--muted);
            font-size: 12px;
        }

        .form-section {
            margin-bottom: 30px;
            padding-bottom: 27px;
            border-bottom: 1px solid var(--border);
        }

        .form-section:last-of-type {
            margin-bottom: 20px;
            padding-bottom: 0;
            border-bottom: none;
        }

        .section-title {
            margin: 0 0 6px;
            color: var(--green);
            font-size: 21px;
            line-height: 1.35;
            letter-spacing: -0.4px;
        }

        .section-description {
            margin: 0 0 22px;
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

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        input,
        textarea,
        select {
            display: block;
            width: 100%;
            padding: 12px 14px;
            background: var(--bg);
            color: var(--text);
            border: 1px solid #CDD7C8;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background-color 0.2s ease;
        }

        input,
        select {
            min-height: 47px;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        input::placeholder,
        textarea::placeholder {
            color: #788376;
        }

        input:hover,
        textarea:hover,
        select:hover {
            border-color: #A8B99C;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            background: #FFFFFF;
            border-color: var(--accent-dark);
            box-shadow: 0 0 0 3px rgba(82, 107, 53, 0.12);
        }

        select {
            cursor: pointer;
        }

        input[type="file"] {
            padding: 10px;
            background: var(--bg);
            color: var(--muted);
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
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

        input[type="file"]::file-selector-button:hover {
            background: #DDE6D6;
        }

        .field-hint,
        .field small {
            display: block;
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .current-picture-label {
            margin: 0 0 10px;
            color: var(--muted);
            font-size: 13px;
        }

        .current-profile-picture {
            display: block;
            width: 100px;
            height: 100px;
            margin-bottom: 16px;
            object-fit: cover;
            background: var(--surface-light);
            border: 2px solid var(--border);
            border-radius: 50%;
        }

        /* Validation errors */

        .errors {
            margin-bottom: 24px;
            padding: 15px 18px;
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
            padding-left: 20px;
        }

        .errors li + li {
            margin-top: 4px;
        }

        /* Action buttons */

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding-top: 8px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 12px 20px;
            color: var(--green-deep);
            background: var(--accent);
            border: 1px solid transparent;
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
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
            background: #FFFFFF;
            border-color: var(--border);
        }

        .button-secondary:hover {
            color: var(--green);
            background: var(--surface-light);
            border-color: #B8C8B1;
        }

        a:focus-visible,
        button:focus-visible,
        input:focus-visible,
        textarea:focus-visible,
        select:focus-visible {
            outline: 3px solid var(--accent-dark);
            outline-offset: 3px;
        }

        /* Responsive layout */

        @media (max-width: 600px) {
            body {
                padding: 25px 14px;
            }

            .form-card {
                padding: 23px 18px;
                border-radius: 12px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .button {
                width: 100%;
            }

            .form-section {
                margin-bottom: 25px;
                padding-bottom: 23px;
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

        <a class="back-link" href="/portfolio/manage">
            ← Back to Manage Portfolio
        </a>

        <div class="page-header">
            <p class="eyebrow">UPDATE YOUR PROFILE</p>
            <h1>Edit Your Portfolio</h1>
            <p class="page-description">
                Keep your professional information accurate and up to date.
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

        <form
            action="/portfolio/{{ $portfolio->id }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="form-card">
                <p class="required-note">
                    Fields marked with * are required.
                </p>

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
                            value="{{ old('full_name', $portfolio->full_name) }}"
                            autocomplete="name"
                            required
                        >
                    </div>

                    <div class="field">
                        <label for="email">Email *</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $portfolio->email) }}"
                            autocomplete="email"
                            required
                        >
                    </div>

                    <div class="field">
                        <label for="profile_picture">Profile Picture</label>

                        @if ($portfolio->profile_picture)
                            <p class="current-picture-label">
                                Current profile picture:
                            </p>

                            <img
                                src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                                alt="Current profile picture"
                                class="current-profile-picture"
                            >
                        @endif

                        <input
                            id="profile_picture"
                            type="file"
                            name="profile_picture"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <small>
                            Choose a new image to replace the current one.
                            Leave empty to keep it.
                        </small>
                    </div>

                    <div class="field">
                        <label for="contact_number">Contact Number</label>
                        <input
                            id="contact_number"
                            name="contact_number"
                            value="{{ old('contact_number', $portfolio->contact_number) }}"
                            autocomplete="tel"
                        >
                    </div>

                    <div class="field">
                        <label for="address">Address</label>
                        <textarea
                            id="address"
                            name="address"
                        >{{ old('address', $portfolio->address) }}</textarea>
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
                        >{{ old('about_me', $portfolio->about_me) }}</textarea>
                    </div>

                    <div class="field">
                        <label for="education">Educational Background</label>
                        <textarea
                            id="education"
                            name="education"
                        >{{ old('education', $portfolio->education) }}</textarea>
                    </div>

                    <div class="field">
                        <label for="skills">Skills</label>
                        <textarea
                            id="skills"
                            name="skills"
                        >{{ old('skills', $portfolio->skills) }}</textarea>
                    </div>

                    <div class="field">
                        <label for="projects">Projects</label>
                        <textarea
                            id="projects"
                            name="projects"
                        >{{ old('projects', $portfolio->projects) }}</textarea>
                    </div>

                    <div class="field">
                        <label for="work_experience">Work Experience</label>
                        <textarea
                            id="work_experience"
                            name="work_experience"
                        >{{ old('work_experience', $portfolio->work_experience) }}</textarea>
                    </div>

                    <div class="field">
                        <label for="social_links">Social Media / Website Links</label>
                        <textarea
                            id="social_links"
                            name="social_links"
                        >{{ old('social_links', $portfolio->social_links) }}</textarea>
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
                                {{ old('template', $portfolio->template ?? 'simple') === 'simple' ? 'selected' : '' }}
                            >
                                Simple
                            </option>

                            <option
                                value="modern"
                                {{ old('template', $portfolio->template ?? 'simple') === 'modern' ? 'selected' : '' }}
                            >
                                Modern
                            </option>

                            <option
                                value="creative"
                                {{ old('template', $portfolio->template ?? 'simple') === 'creative' ? 'selected' : '' }}
                            >
                                Creative
                            </option>
                        </select>
                    </div>
                </section>

                <div class="form-actions">
                    <button class="button" type="submit">
                        Save Changes
                    </button>

                    <a class="button button-secondary" href="/portfolio/manage">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </main>
</body>
</html>