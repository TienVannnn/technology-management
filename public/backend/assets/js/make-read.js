document.getElementById("notifDropdown").addEventListener("click", function () {
    fetch(route("admin.mark-requests-read"), {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                const notificationCount =
                    document.getElementById("notification-count");
                if (notificationCount) {
                    notificationCount.remove();
                }
            }
        })
        .catch((error) => console.error("Lỗi:", error));
});
