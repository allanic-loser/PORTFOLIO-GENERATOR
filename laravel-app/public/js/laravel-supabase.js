const supabaseUrl = "https://gepyzwfwrrtbvtoqyijd.supabase.co";
const supabaseKey = "sb_publishable_hruPNSMRN6XCWsNdLwHkWA_HnLb1eXm";

const supabaseClient = window.supabase.createClient(
    supabaseUrl,
    supabaseKey
);

async function ensureLaravelSupabaseSession() {
    const { data: sessionData, error: sessionError } =
        await supabaseClient.auth.getSession();

    if (sessionError) {
        throw sessionError;
    }

    let session = sessionData.session;

    if (!session) {
        const { data, error } =
            await supabaseClient.auth.signInAnonymously();

        if (error) {
            throw error;
        }

        session = data.session;
    }

    if (!session?.access_token) {
        throw new Error("Could not establish a Supabase session.");
    }

    const csrfToken = document.querySelector(
        'meta[name="csrf-token"]'
    )?.content;

    const response = await fetch("/supabase/session", {
        method: "POST",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({
            access_token: session.access_token
        })
    });

    if (!response.ok) {
        throw new Error(
            `Laravel session verification failed: ${response.status}`
        );
    }

    return true;
}

