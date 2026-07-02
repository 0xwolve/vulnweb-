// assets/script.js
// A simple script to demonstrate client-side interactions.

document.addEventListener("DOMContentLoaded", function() {
    console.log("VulnWeb Portal Loaded.");

    // Simple confirmation before logging out
    const logoutBtn = document.getElementById("logout-link");
    if (logoutBtn) {
        logoutBtn.addEventListener("click", function(e) {
            if (!confirm("Are you sure you want to log out of the portal?")) {
                e.preventDefault();
            }
        });
    }
});
