$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
const changePasswordBtn = document.getElementById("changePasswordBtn");
if (changePasswordBtn) {
    changePasswordBtn.addEventListener("click", function () {
        const passwordFields = document.getElementById("passwordFields");
        if (passwordFields) {
            passwordFields.style.display =
                passwordFields.style.display === "none" ? "block" : "none";
        }
    });
}

const deleteButtons = document.querySelectorAll(".delete-btn");
if (deleteButtons.length > 0) {
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Deleted.",
                        icon: "success",
                    }).then(() => {
                        this.closest("form").submit();
                    });
                }
            });
        });
    });
}
