<!DOCTYPE html>
<html lang="en" class="vh-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <?php include_once("head.php"); ?>
</head>

<body class="vh-100">
    <h1 class="py-4 text-center">Movie</h1>
    <form id="login_form" method="POST" class="m-auto border p-5 shadow text-center" style="max-width: 330px;">
        <h3 class="mb-3">เข้าสู่ระบบ</h3>
        <input type="text" id="username" name="username" class="form-control mb-3" placeholder="ผู้ใช้" required="" autofocus="">
        <input type="password" id="password" name="password" class="form-control mb-3" placeholder="รหัสผ่าน" required="">
        <button class="btn btn-dark" type="submit">เข้าสู่ระบบ</button>
    </form>
    <script>
        $(document).ready(function() {
            //  ! ฟอร์มเข้าสู่ระบบ
            $("#login_form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "loginController.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 1) {
                            $.confirm({
                                title: 'สำเร็จ!',
                                content: 'เข้าสู่ระบบสำเร็จ!',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "index.php";
                                        }
                                    }
                                }
                            })
                        } else {
                            $.confirm({
                                title: 'ล้มเหลว!',
                                content: 'เข้าสู่ระบบไม่สำเร็จ!',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "login.php";
                                        }
                                    }
                                }
                            })
                        }
                    }
                })
            })
        })
    </script>
    <script src="../js/js.js"></script>
</body>

</html>