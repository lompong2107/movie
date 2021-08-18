<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie | Reset</title>
    <?php
    include_once("head.php");
    ?>
</head>

<body>
    <form id="resetPassword" method="POST" style="width: 400px;" class="mx-auto my-5 shadow p-5">
        <h1>เปลี่ยนรหัสผ่าน</h1>
        <div class="my-3 input-group">
            <label class="fs-5"><?= $_GET["email"]; ?></label>
            <input type="email" name="email" value="<?= $_GET["email"]; ?>" hidden>
        </div>
        <div class="mb-3 input-group">
            <input type="password" class="form-control border-end-0" name="resetPassword" aria-describedby="addon-password" placeholder="รหัสผ่านใหม่" minlength="8" required>
            <span class="input-group-text bg-white" id="addon-password"><i class="fi-rr-lock"></i></span>
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-dark w-100">บันทึก</button>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#resetPassword").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "resetPasswordController.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 1) {
                            $.confirm({
                                title: 'สำเร็จ!',
                                content: 'เปลี่ยนรหัสผ่านสำเร็จ!',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "/movie";
                                        }
                                    }
                                }
                            })
                        } else {
                            $.alert({
                                title: 'ล้มเหลว!',
                                content: 'เปลี่ยนรหัสผ่านไม่สำเร็จ!',
                                text: 'ตกลง'
                            })
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>