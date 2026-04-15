let adminToggleBtn = document.getElementById("admin_toggle");
let adminMenu = document.getElementById("admin_menu");

// Toggle admin menu visibility
if (adminToggleBtn && adminMenu) {
    adminToggleBtn.addEventListener("click", function () {
        adminMenu.classList.toggle("hidden");
    });

    document.addEventListener("click", function (e) {
        if (!adminToggleBtn.contains(e.target) && !adminMenu.contains(e.target)) {
            adminMenu.classList.add("hidden");
        }
    });
}