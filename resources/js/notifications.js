window.Echo.private("user." + window.Laravel.userId).listen(
    ".PropertyVerified",
    (e) => {
        const countEl = document.getElementById("notification-count");
        const dropdown = document.getElementById("notification-dropdown");
        const list = document.getElementById("notification-list");

        if (!countEl || !list) {
            console.error("Notification elements not found");
            return;
        }

        let current = parseInt(countEl.innerText) || 0;
        countEl.innerText = current + 1;
        dropdown.classList.remove("hidden");
        countEl.classList.remove("hidden");

        const item = document.createElement("li");
        item.className =
            "px-4 py-2 border-b text-sm bg-green-50 transition-opacity duration-1000";
        item.innerHTML = `Tin <b>"${e.property.title}"</b> đã được admin xác thực`;

        list.prepend(item);

        // Hiển thị 15s rồi mờ dần và xóa
        setTimeout(() => {
            item.style.opacity = "0";
            setTimeout(() => {
                item.remove();
            }, 1000);
        }, 15000);
    }
);
