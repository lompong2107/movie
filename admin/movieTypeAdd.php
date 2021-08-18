<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie | Admin</title>
    <?php include_once("head.php"); ?>
</head>

<body>
    <?php include_once("sidebar.php"); ?>
    <div class="home-section">
        <nav class="navbar navbar-dark bg-dark home-content w-100 text-white">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <i class='bx bx-menu'></i>
                </li>
                <li class="nav-item">
                    <span class="h3" id="text-title">เพิ่มหมวดหมู่</span>
                </li>
            </ul>
        </nav>
        <div class="content pt-3" id="content">
            <div class="mx-auto border" style="width: 700px;">
                <h3 class="text-center my-3">หมวดหมู่</h3>
                <form id="mov_type_form_add" method="POST">
                    <div class="row align-items-center mb-3">
                        <div class="col-4 text-end">
                            <label for="mov_type_name" class="col-form-label">ชื่อหมวดหมู่</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="mov_type_name" id="mov_type_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 text-end">
                            <input type="submit" class="btn btn-success w-25" value="บันทึก">
                        </div>
                        <div class="col-6">
                            <a href="movieType.php" class="btn btn-primary w-25">กลับ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // ! ฟอร์มเพิ่มข้อมูลประเภทภาพยนตร์
            $("#mov_type_form_add").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "movieTypeController.php",
                    data: $(this).serialize() + "&submit=movTypeAdd",
                    success: function(response) {
                        if (response.status == 1) {
                            $.confirm({
                                title: 'สำเร็จ!',
                                content: 'ดำเนินการต่อ...',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "movieTypeAdd.php";
                                        }
                                    },
                                    back: {
                                        text: 'กลับ',
                                        btnClass: 'btn-blue',
                                        action: function() {
                                            window.location = "movieType.php";
                                        }
                                    }
                                }
                            });
                        } else {
                            $.confirm({
                                title: 'ล้มเหลว!',
                                content: 'ดำเนินการต่อ...',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง'
                                    },
                                    back: {
                                        text: 'กลับ',
                                        btnClass: 'btn-blue',
                                        action: function() {
                                            window.location = "movieType.php";
                                        }
                                    }
                                }
                            });
                        }
                    }
                })
            })
        })
    </script>
    <script src="../js/js.js"></script>
</body>

</html>