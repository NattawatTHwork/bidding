<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("location: ./admin/index.php");
} elseif (isset($_SESSION['user_id'])) {
    header("location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container-sm w-50" style="margin: 0; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div>
            <h1>ลงทะเบียน</h1>
        </div>
        <form id="register">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required />
                <label for="email">อีเมล</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Password" required />
                <label for="password">รหัสผ่าน</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="user_repeat_password" id="user_repeat_password" placeholder="Repeat Password" required />
                <label for="password">ยืนยันรหัสผ่าน</label>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">เข้าสู่ระบบ</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
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
    </script>
</body>

</html>