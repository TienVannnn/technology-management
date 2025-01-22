$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$(document).ready(function () {
    $(".confirm-btn").on("click", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        var routeConfirm = route("sr.confirm", {
            id: id,
        });

        $.ajax({
            url: routeConfirm,
            type: "POST",
            dataType: "JSON",
            data: { id },
            success: function (response) {
                if (response.status === 200) {
                    toastr.success(response.message, "Thành công");
                    const statusElement = $(`.status-element[data-id='${id}']`);
                    if (statusElement.length) {
                        statusElement.text("Đã xác nhận");
                    }
                } else {
                    toastr.error(response.message, "Thất bại");
                }
            },
            error: function () {
                toastr.error("Có lỗi xảy ra, vui lòng thử lại!", "Lỗi");
            },
        });
    });

    // Hủy yêu cầu
    $(".cancel-btn").on("click", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        var routeCancle = route("sr.cancle", {
            id: id,
        });

        $.ajax({
            url: routeCancle,
            type: "POST",
            dataType: "JSON",
            data: { id },
            success: function (response) {
                if (response.status === 200) {
                    toastr.success(response.message, "Thành công");
                    const statusElement = $(`.status-element[data-id='${id}']`);
                    if (statusElement.length) {
                        statusElement.text("Đã hủy");
                    }
                } else {
                    toastr.error(response.message, "Thất bại");
                }
            },
            error: function () {
                toastr.error("Có lỗi xảy ra, vui lòng thử lại!", "Lỗi");
            },
        });
    });
});
