$(document).ready(function() {
    $('#register').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var password = $('#user_password').val();
        var repeatPassword = $('#user_repeat_password').val();

        if (password !== repeatPassword) {
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: 'รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน',
                icon: 'error',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#4e73df'
            });
            return;
        }

        $.ajax({
            url: 'ajax/register.php',
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