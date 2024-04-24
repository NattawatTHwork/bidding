$(document).ready(function() {
    $('#create_data_form').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'ajax/create_category.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response == 'success') {
                    Swal.fire({
                        title: 'สำเร็จ',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#4e73df'
                    }).then(function() {
                        location.reload();
                    });
                }
                if (response == 'fail') {
                    Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            icon: 'error',
                            confirmButtonText: 'ตกลง',
                            confirmButtonColor: '#4e73df'
                        })
                        .then(function() {
                            location.reload();
                        });
                }
            },
            error: function(error) {
                console.log(error)
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#edit_room_form').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'check/edit_room.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response == 'success') {
                    Swal.fire({
                        title: 'สำเร็จ',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#4e73df'
                    }).then(function() {
                        location.reload();
                    });
                }
                if (response == 'fail') {
                    Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            icon: 'error',
                            confirmButtonText: 'ตกลง',
                            confirmButtonColor: '#4e73df'
                        })
                        .then(function() {
                            location.reload();
                        });
                }
            },
            error: function(error) {
                console.log(error)
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});