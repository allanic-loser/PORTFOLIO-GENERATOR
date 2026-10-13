const VISITOR_ID_KEY = "portfolioVisitorId";

function getVisitorId() {
    let visitorId = localStorage.getItem(VISITOR_ID_KEY);

    if (!visitorId) {
        visitorId = crypto.randomUUID();
        localStorage.setItem(VISITOR_ID_KEY, visitorId);
    }

    return visitorId;
}

const visitorId = getVisitorId();


async function ensureUserSession() {
    const { data: sessionData, error: sessionError } =
        await supabaseClient.auth.getSession();

    if (sessionError) {
        throw sessionError;
    }

    if (sessionData.session) {
        return sessionData.session.user;
    }

    const { data, error } =
        await supabaseClient.auth.signInAnonymously();

    if (error) {
        throw error;
    }

    return data.user;
}


async function createPortfolio() {
    const user = await ensureUserSession();
    // Check whether a portfolio already exists

    const { data, error } = await supabaseClient
        .from("portfolios")
        .select("id")
        .eq("user_id", user.id)
        .limit(1);

    // Stop if the database check fails
    if (error) {
        console.error("Error checking portfolio:", error);
        alert("Unable to check your portfolio. Please try again.");
        return;
    }

    // If a portfolio exists, redirect to Manage Portfolio
    if (data && data.length > 0) {
        alert(
            "You've already created a portfolio! " +
            "You will now be redirected to Manage Portfolio."
        );

        window.location.href = "manage.html";
        return;
    }

    // Otherwise, allow the user to create one
    window.location.href = "create.html";
}

// Connect the Home page button to the check
const createButton = document.getElementById("createPortfolioBtn");

if (createButton) {
    createButton.addEventListener("click", function(event) {
        event.preventDefault();
        createPortfolio();
    });
}


async function testSupabaseConnection() {
    const { data, error } = await supabaseClient.auth.getSession();

    console.log("Supabase session:", data);
    console.log("Supabase session error:", error);
}

testSupabaseConnection();

// ================================
// CREATE PORTFOLIO
// ================================

const portfolioForm = document.getElementById("portfolioForm");

if (portfolioForm) {

    portfolioForm.addEventListener("submit", async function(event) {

        event.preventDefault();
        const user = await ensureUserSession();

        const { data: existingPortfolio, error: checkError } =
            await supabaseClient
            .from("portfolios")
            .select("id")
            .eq("user_id", user.id)
            .limit(1);

        if (checkError) {

            console.error("Error checking portfolio:", checkError);

            alert("Error checking portfolio: " + checkError.message);

            return;
        }

        // Prevent creating another portfolio
        if (existingPortfolio && existingPortfolio.length > 0) {

            alert("You already have a portfolio. Please manage or edit your existing portfolio.");

            window.location.href = "manage.html";

            return;
        }


        // Get form information

        const fullName =
            document.getElementById("fullName").value;

        const email =
            document.getElementById("email").value;

        const contactNumber =
            document.getElementById("contactNumber").value;

        const address =
            document.getElementById("address").value;

        const aboutMe =
            document.getElementById("aboutMe").value;

        const education =
            document.getElementById("education").value;

        const skills =
            document.getElementById("skills").value;

        const projects =
            document.getElementById("projects").value;

        const workExperience =
            document.getElementById("workExperience").value;

        const socialLinks =
            document.getElementById("socialLinks").value;


        // Get selected profile picture
        const profilePictureFile =
            document.getElementById("profilePicture").files[0];

        let profilePictureUrl = null;

        console.log("Selected profile picture:", profilePictureFile);


        // Upload profile picture if one was selected
        if (profilePictureFile) {

            const fileExtension =
                profilePictureFile.name.split(".").pop();

            const fileName =
                `${Date.now()}.${fileExtension}`;


            const { error: uploadError } =
                await supabaseClient
                    .storage
                    .from("PORTFOLIO-IMAGES")
                    .upload(fileName, profilePictureFile);


            if (uploadError) {

                console.error(
                    "Image upload error:",
                    uploadError
                );

                alert(
                    "Failed to upload profile picture: " +
                    uploadError.message
                );

                return;
            }


            // Get public image URL
            const { data: publicUrlData } =
                supabaseClient
                    .storage
                    .from("PORTFOLIO-IMAGES")
                    .getPublicUrl(fileName);


            profilePictureUrl =
                publicUrlData.publicUrl;
        }
        // Save portfolio
        const { data, error } = await supabaseClient
            .from("portfolios")
            .insert([
                {
                    user_id: user.id,
                    visitor_id: visitorId,
                    full_name: fullName,
                    profile_picture: profilePictureUrl,
                    email: email,
                    contact_number: contactNumber,
                    address: address,
                    about_me: aboutMe,
                    education: education,
                    skills: skills,
                    projects: projects,
                    work_experience: workExperience,
                    social_links: socialLinks
                }
            ])
            .select();


        if (error) {

            console.error("Error saving portfolio:", error);

            alert("Error: " + error.message);

            return;
        }


        console.log("Portfolio saved:", data);

        alert("Portfolio saved successfully!");

        window.location.href = "manage.html";

    });

}

// ================================
// EDIT PORTFOLIO - LOAD DATA
// ================================

async function loadPortfolioForEdit() {

    const editForm = document.getElementById("editPortfolioForm");

    if (!editForm) {
        return;
    }

    // Get the portfolio ID from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const portfolioId = urlParams.get("id");

    if (!portfolioId) {
        document.getElementById("editMessage").textContent =
            "No portfolio selected.";

        return;
    }

    const user = await ensureUserSession();

    const { data, error } = await supabaseClient
        .from("portfolios")
        .select("*")
        .eq("id", portfolioId)
        .eq("user_id", user.id)
        .single();

    if (error) {
        console.error("Error loading portfolio:", error);

        document.getElementById("editMessage").textContent =
            "Failed to load portfolio.";

        return;
    }

    // Put database information into the form
    document.getElementById("fullName").value =
        data.full_name || "";

    const currentProfilePicture =
        document.getElementById("currentProfilePicture");

    if (data.profile_picture) {

        currentProfilePicture.innerHTML = `
            <p>Current Profile Picture:</p>

            <img
                src="${data.profile_picture}"
                alt="Current Profile Picture"
                style="max-width: 150px; border-radius: 10px;"
            >
        `;

    } else {

        currentProfilePicture.innerHTML =
            "<p>No profile picture uploaded.</p>";
    }

    document.getElementById("email").value =
        data.email || "";

    document.getElementById("contactNumber").value =
        data.contact_number || "";

    document.getElementById("address").value =
        data.address || "";

    document.getElementById("aboutMe").value =
        data.about_me || "";

    document.getElementById("education").value =
        data.education || "";

    document.getElementById("skills").value =
        data.skills || "";

    document.getElementById("projects").value =
        data.projects || "";

    document.getElementById("workExperience").value =
        data.work_experience || "";

    document.getElementById("socialLinks").value =
        data.social_links || "";
}

loadPortfolioForEdit();

// EDIT PORTFOLIO 
const editPortfolioForm = document.getElementById("editPortfolioForm");

if (editPortfolioForm) {

    editPortfolioForm.addEventListener("submit", async function(event) {

        event.preventDefault();

        // Get the ID directly from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const portfolioId = urlParams.get("id");

        console.log("Portfolio ID:", portfolioId);

        if (!portfolioId) {
            document.getElementById("editMessage").textContent =
                "No portfolio selected.";

            return;
        }

        // Check if a new profile picture was selected
        const profilePictureFile =
            document.getElementById("profilePicture").files[0];

        let newProfilePictureUrl = null;

        if (profilePictureFile) {

            const fileExtension =
                profilePictureFile.name.split(".").pop();

            const fileName =
                `${Date.now()}.${fileExtension}`;

            const { error: uploadError } =
                await supabaseClient
                    .storage
                    .from("PORTFOLIO-IMAGES")
                    .upload(fileName, profilePictureFile);

            if (uploadError) {

                console.error(
                    "Image upload error:",
                    uploadError
                );

                document.getElementById("editMessage").textContent =
                    "Failed to upload profile picture: " +
                    uploadError.message;

                return;
            }

            const { data: publicUrlData } =
                supabaseClient
                    .storage
                    .from("PORTFOLIO-IMAGES")
                    .getPublicUrl(fileName);

            newProfilePictureUrl =
                publicUrlData.publicUrl;

            console.log(
                "New profile picture:",
                newProfilePictureUrl
            );
        }

        const updatedPortfolio = {
            full_name: document.getElementById("fullName").value,
            email: document.getElementById("email").value,
            contact_number: document.getElementById("contactNumber").value,
            address: document.getElementById("address").value,
            about_me: document.getElementById("aboutMe").value,
            education: document.getElementById("education").value,
            skills: document.getElementById("skills").value,
            projects: document.getElementById("projects").value,
            work_experience: document.getElementById("workExperience").value,
            social_links: document.getElementById("socialLinks").value
        };

        if (newProfilePictureUrl) {

            updatedPortfolio.profile_picture =
                newProfilePictureUrl;
        }

        console.log("Updating portfolio:", portfolioId);

        const user = await ensureUserSession();

        const { error } = await supabaseClient
            .from("portfolios")
            .update(updatedPortfolio)
            .eq("id", portfolioId)
            .eq("user_id", user.id);

        if (error) {

            console.error("Update error:", error);

            document.getElementById("editMessage").textContent =
                "Error: " + error.message;

            return;
        }

        alert("Portfolio updated successfully!");

        window.location.href = "manage.html";
    });
}

// edit and delete portfolio functions
function editPortfolio(id) {
    window.location.href = `edit.html?id=${id}`;
}


function viewPortfolio(id) {
    window.location.href = `preview.html?id=${id}`;
}


async function deletePortfolio(id) {

    const confirmDelete = confirm(
        "Are you sure you want to delete this portfolio?"
    );

    if (!confirmDelete) {
        return;
    }

    const user = await ensureUserSession();

    const { error } = await supabaseClient
        .from("portfolios")
        .delete()
        .eq("id", id)
        .eq("user_id", user.id);

    if (error) {

        console.error("Error deleting portfolio:", error);

        alert("Failed to delete portfolio: " + error.message);

        return;
    }

    alert("Portfolio deleted successfully!");

    loadPortfolios();
}

// buttons for delete and edit portfolio
window.editPortfolio = editPortfolio;
window.deletePortfolio = deletePortfolio;
window.viewPortfolio = viewPortfolio;


// ================================
// LOAD PORTFOLIOS
// ================================

async function loadPortfolios() {

    const portfolioList = document.getElementById("portfolioList");

    // Only run this on manage.html
    if (!portfolioList) {
        return;
    }

    // Get portfolio from Supabase
    
    const user = await ensureUserSession();

    const { data, error } = await supabaseClient
        .from("portfolios")
        .select("*")
        .eq("user_id", user.id)
        .limit(1);


    if (error) {

        console.error("Error loading portfolios:", error);

        portfolioList.innerHTML = `
            <p>Failed to load portfolio.</p>
        `;

        return;
    }

    // No portfolio exists
    if (!data || data.length === 0) {

        portfolioList.innerHTML = `
            <div class="empty-portfolio">
                <h2>No Portfolio Yet</h2>

                <p>
                    You haven't created a portfolio yet.
                </p>

                <button onclick="createPortfolio()">
                    Create Portfolio
                </button>
            </div>
        `;

        return;
    }

    // Get the first/only portfolio
    const portfolio = data[0];

    // Display portfolio
    portfolioList.innerHTML = `
        <div class="portfolio-card">

            <h2>${portfolio.full_name}</h2>

            <p>
                ${portfolio.email || "No email provided"}
            </p>

            <div class="portfolio-actions">

                <button onclick="viewPortfolio('${portfolio.id}')">
                    View
                </button>

                <button onclick="editPortfolio('${portfolio.id}')">
                    Edit
                </button>

                <button onclick="chooseTemplate('${portfolio.id}')">
                    Change Template
                </button>

                <button onclick="deletePortfolio('${portfolio.id}')">
                    Delete
                </button>

            </div>

        </div>
    `;
}


// Run when manage.html loads
loadPortfolios();


// TEMPLATE SELECTION

async function selectTemplate(template) {

    console.log("Selected template:", template);

    // Get the selected portfolio ID
    const portfolioId =
        localStorage.getItem("selectedPortfolioId");

    if (!portfolioId) {

        alert("Please select a portfolio first.");

        window.location.href = "manage.html";

        return;
    }


    // Save selected template to Supabase
    const user = await ensureUserSession();

    const { error } = await supabaseClient
        .from("portfolios")
        .update({
            template: template
        })
        .eq("id", portfolioId)
        .eq("visitor_id", visitorId);


    if (error) {

        console.error("Template update error:", error);

        alert(
            "Failed to save template: " +
            error.message
        );

        return;
    }


    // Also save it locally
    localStorage.setItem(
        "selectedTemplate",
        template
    );


    console.log(
        "Template saved:",
        template
    );


    // Open portfolio preview
    window.location.href =
        `preview.html?id=${portfolioId}&template=${template}`;
}

window.selectTemplate = selectTemplate;

// PORTFOLIO PREVIEW

async function loadPortfolioPreview() {

    const preview = document.getElementById("portfolioPreview");

    if (!preview) {
        return;
    }

    const urlParams = new URLSearchParams(window.location.search);

    const portfolioId = urlParams.get("id");
    let template = urlParams.get("template");

    if (!portfolioId) {

        preview.innerHTML = `
            <p>No portfolio selected.</p>
            <a href="manage.html">Go to Manage Portfolio</a>
        `;

        return;
    }

    const user = await ensureUserSession();

    const { data, error } = await supabaseClient
        .from("portfolios")
        .select("*")
        .eq("id", portfolioId)
        .eq("visitor_id", visitorId)
        .single();

    if (error) {

        console.error("Error loading preview:", error);

        preview.innerHTML = `
            <p>Error loading portfolio: ${error.message}</p>
        `;

        return;
    }

    // If no template was provided in the URL,
    // use the template saved in Supabase.

    if (!template) {
        template = data.template;
    }

    // If the portfolio has no saved template,
    // use Simple as the default.

    if (!template) {
        template = "simple";
    }

    console.log("Portfolio:", data);
    console.log("Template:", template);

    if (template === "simple") {

    preview.innerHTML = `
        <div class="template-simple">

            <div class="simple-header">

                ${
                    data.profile_picture
                    ? `<img src="${data.profile_picture}" alt="Profile Picture">`
                    : ""
                }

                <h1>${data.full_name}</h1>

                <p>${data.email}</p>

                ${
                    data.contact_number
                    ? `<p>${data.contact_number}</p>`
                    : ""
                }

            </div>


            <section class="simple-section">

                <h2>About Me</h2>

                <p>
                    ${data.about_me || "No information provided."}
                </p>

            </section>


            <section class="simple-section">

                <h2>Education</h2>

                <p>
                    ${data.education || "No information provided."}
                </p>

            </section>


            <section class="simple-section">

                <h2>Skills</h2>

                <p>
                    ${data.skills || "No information provided."}
                </p>

            </section>


            <section class="simple-section">

                <h2>Projects</h2>

                <p>
                    ${data.projects || "No information provided."}
                </p>

            </section>


            <section class="simple-section">

                <h2>Work Experience</h2>

                <p>
                    ${data.work_experience || "No information provided."}
                </p>

            </section>


            <section class="simple-section">

                <h2>Contact</h2>

                <p>${data.email}</p>

                <p>
                    ${data.contact_number || ""}
                </p>

                <p>
                    ${data.address || ""}
                </p>

            </section>


            <section class="simple-section">

                <h2>Social Links</h2>

                <p>
                    ${data.social_links || "No links provided."}
                </p>

            </section>

        </div>
    `;
    }

    if (template === "modern") {

    preview.innerHTML = `
        <div class="template-modern">

            <div class="modern-hero">

                <div class="modern-profile">

                    ${
                        data.profile_picture
                        ? `<img src="${data.profile_picture}" alt="Profile Picture">`
                        : `<div class="modern-no-photo">No Photo</div>`
                    }

                </div>

                <div class="modern-intro">

                    <p class="modern-label">PORTFOLIO</p>

                    <h1>${data.full_name}</h1>

                    <p>${data.email}</p>

                    ${
                        data.contact_number
                        ? `<p>${data.contact_number}</p>`
                        : ""
                    }

                </div>

            </div>


            <div class="modern-grid">

                <section class="modern-card modern-about">

                    <span class="modern-number">01</span>

                    <h2>About Me</h2>

                    <p>
                        ${data.about_me || "No information provided."}
                    </p>

                </section>


                <section class="modern-card">

                    <span class="modern-number">02</span>

                    <h2>Education</h2>

                    <p>
                        ${data.education || "No information provided."}
                    </p>

                </section>


                <section class="modern-card">

                    <span class="modern-number">03</span>

                    <h2>Skills</h2>

                    <p>
                        ${data.skills || "No information provided."}
                    </p>

                </section>


                <section class="modern-card">

                    <span class="modern-number">04</span>

                    <h2>Projects</h2>

                    <p>
                        ${data.projects || "No information provided."}
                    </p>

                </section>


                <section class="modern-card">

                    <span class="modern-number">05</span>

                    <h2>Experience</h2>

                    <p>
                        ${data.work_experience || "No information provided."}
                    </p>

                </section>


                <section class="modern-card">

                    <span class="modern-number">06</span>

                    <h2>Contact</h2>

                    <p>
                        ${data.email}
                    </p>

                    <p>
                        ${data.contact_number || ""}
                    </p>

                    <p>
                        ${data.address || ""}
                    </p>

                </section>

            </div>


            <div class="modern-social">

                <h2>Connect</h2>

                <p>
                    ${data.social_links || "No links provided."}
                </p>

            </div>

        </div>
    `;
    }
    if (template === "creative") {

    preview.innerHTML = `
        <div class="template-creative">

            <div class="creative-top">

                <div class="creative-title">

                    <p class="creative-small-title">
                        PORTFOLIO / 2026
                    </p>

                    <h1>${data.full_name}</h1>

                    <p class="creative-email">
                        ${data.email}
                    </p>

                </div>

                <div class="creative-photo">

                    ${
                        data.profile_picture
                        ? `<img src="${data.profile_picture}" alt="Profile Picture">`
                        : `<div class="creative-no-photo">PROFILE</div>`
                    }

                </div>

            </div>


            <div class="creative-intro">

                <span>01 — ABOUT</span>

                <p>
                    ${data.about_me || "No information provided."}
                </p>

            </div>


            <div class="creative-columns">

                <section class="creative-block creative-skills">

                    <span>02 — SKILLS</span>

                    <h2>What I<br>Can Do</h2>

                    <p>
                        ${data.skills || "No information provided."}
                    </p>

                </section>


                <section class="creative-block creative-education">

                    <span>03 — EDUCATION</span>

                    <h2>My<br>Background</h2>

                    <p>
                        ${data.education || "No information provided."}
                    </p>

                </section>

            </div>


            <section class="creative-projects">

                <div class="creative-section-number">
                    04
                </div>

                <div>

                    <span>PROJECTS</span>

                    <h2>Things I've<br>Created</h2>

                    <p>
                        ${data.projects || "No projects provided."}
                    </p>

                </div>

            </section>


            <section class="creative-experience">

                <span>05 — EXPERIENCE</span>

                <p>
                    ${data.work_experience || "No work experience provided."}
                </p>

            </section>


            <footer class="creative-footer">

                <div>

                    <span>CONTACT</span>

                    <p>${data.email}</p>

                    ${
                        data.contact_number
                        ? `<p>${data.contact_number}</p>`
                        : ""
                    }

                    ${
                        data.address
                        ? `<p>${data.address}</p>`
                        : ""
                    }

                </div>


                <div>

                    <span>SOCIAL / WEBSITE</span>

                    <p>
                        ${data.social_links || "No links provided."}
                    </p>

                </div>

            </footer>

        </div>
    `;
    }
}

loadPortfolioPreview();

// button for templates

function chooseTemplate(id) {

    console.log("Choosing template for portfolio:", id);

    localStorage.setItem("selectedPortfolioId", id);

    window.location.href = "templates.html";
}

window.chooseTemplate = chooseTemplate;

// ================================
// PREVIEW - CHANGE TEMPLATE
// ================================

function goToTemplates() {

    const urlParams =
        new URLSearchParams(window.location.search);

    const portfolioId =
        urlParams.get("id");

    if (!portfolioId) {

        alert("No portfolio selected.");

        window.location.href = "manage.html";

        return;
    }

    // Remember which portfolio we are editing
    localStorage.setItem(
        "selectedPortfolioId",
        portfolioId
    );

    // Go to template selection
    window.location.href = "templates.html";
}

window.goToTemplates = goToTemplates;
