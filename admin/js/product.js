$(document).ready(function () {
    $('#datatables').DataTable({
        // "scrollX": true
    });

    $("#create_data_form").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "ajax/create_product.php",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'เพิ่มข้อมูลสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด',
                        text: 'กรุณาลองใหม่อีกครั้ง'
                    }).then(() => {
                        location.reload();
                    });
                }
            }
        });
    });

    // แก้ไขหมวดหมู่
    $(".edit_data").click(function () {
        var product_code = $(this).data("id");
        var product_name = $(this).data("name");
        var category_code = $(this).data("category");
        var description = $(this).data("description");
        var starting_price = $(this).data("starting-price");
        // var current_price = $(this).data("current-price");
        var start_datetime = $(this).data("start-datetime").replace(" ", "T");
        var end_datetime = $(this).data("end-datetime").replace(" ", "T");

        $("#product_code_edit").val(product_code);
        $("#product_name_edit").val(product_name);
        $("#category_code_edit").val(category_code);
        $("#description_edit").val(description);
        $("#starting_price_edit").val(starting_price);
        // $("#current_price_edit").val(current_price);
        $("#start_datetime_edit").val(start_datetime);
        $("#end_datetime_edit").val(end_datetime);

        $("#form_update_data").modal("show");
    });


    $("#update_data_form").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "ajax/update_product.php",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'แก้ไขข้อมูลสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด',
                        text: 'กรุณาลองใหม่อีกครั้ง'
                    }).then(() => {
                        location.reload();
                    });
                }
            }
        });
    });

    // ลบหมวดหมู่
    $(".delete_data").click(function () {
        var product_code = $(this).data("id");
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการลบสินค้ารหัส " + product_code + " ใช่หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "ajax/delete_product.php",
                    method: "POST",
                    data: {
                        product_code: product_code
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'ลบข้อมูลสำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: 'กรุณาลองใหม่อีกครั้ง'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    });

});
