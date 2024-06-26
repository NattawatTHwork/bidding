$(document).ready(function() {
    $('#datatables').DataTable({
        // "scrollX": true
    });

    // เพิ่มหมวดหมู่
    $("#create_data_form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "ajax/create_category.php",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
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
    $(".edit_data").click(function() {
        var category_code = $(this).data("id");
        var category_name = $(this).data("name");
        $("#category_code_edit").val(category_code);
        $("#category_name_edit").val(category_name);
        $("#form_update_data").modal("show");
    });

    $("#update_data_form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "ajax/update_category.php",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
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
    $(".delete_data").click(function() {
        var category_code = $(this).data("id");
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการลบหมวดหมู่รหัส " + category_code + " ใช่หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "ajax/delete_category.php",
                    method: "POST",
                    data: {
                        category_code: category_code
                    },
                    dataType: "json",
                    success: function(response) {
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
