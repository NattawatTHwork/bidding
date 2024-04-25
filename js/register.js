$(document).ready(function() {
    $("#register_btn").click(function() {
        var formData = $("#register").serialize();

        if ($("#user_password").val() !== $("#user_repeat_password").val()) {
            Swal.fire({
                icon: 'error',
                title: 'ผิดพลาด!',
                text: 'รหัสผ่านไม่ตรงกัน',
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "ajax/register.php",
            data: formData,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "./login.php";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด!',
                        text: data.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});