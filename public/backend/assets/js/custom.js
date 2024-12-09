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
                    this.closest("form").submit();
                    Swal.fire({
                        title: "Deleted!",
                        text: "User has been deleted.",
                        icon: "success",
                    });
                }
            });
        });
    });
}
