document.addEventListener("DOMContentLoaded", () => {
    if (typeof Echo !== "undefined" && Echo && window.Laravel.userId) {
        Echo.private(`user.${window.Laravel.userId}`)
            .listen("App\\Events\\PropertyVerified", (e) => {
                console.log("Notification:", e);

                const countEl = document.getElementById("notification-count");
                const list = document.getElementById("notification-list");

                if (!countEl || !list) {
                    console.error("Notification elements not found");
                    return;
                }

                let current = parseInt(countEl.innerText) || 0;
                countEl.innerText = current + 1;
                countEl.classList.remove("hidden");

                const item = document.createElement("li");
                item.className = "px-4 py-2 border-b text-sm";
                item.innerText = `Tin "${e.title}" đã được admin xác thực`;
                list.prepend(item);
            })
            .error((error) => {
                console.error("Channel subscription error:", error);
            });
    } else {
        console.error(
            "Laravel Echo is not defined or user is not authenticated"
        );
    }
});
