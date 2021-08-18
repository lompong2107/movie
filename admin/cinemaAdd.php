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
                    <span class="h3" id="text-title">เพิ่มโรงภาพยนตร์</span>
                </li>
            </ul>
        </nav>
        <div class="content py-3" id="content">
            <div class="mx-auto border" style="width: 700px;">
                <h3 class="text-center my-3">โรงภาพยนตร์</h3>
                <form id="cinema_form_add" method="POST" enctype="multipart/form-data">
                    <div class="row align-items-center mb-3">
                        <div class="col-4 text-end">
                            <label for="cin_name" class="col-form-label">ชื่อโรงภาพยนตร์</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="cin_name" id="cin_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 text-end">
                            <input type="submit" class="btn btn-success w-25" value="บันทึก">
                        </div>
                        <div class="col-6">
                            <a href="cinema.php" class="btn btn-primary w-25">กลับ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#cinema_form_add").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "cinemaController.php",
                    data: $(this).serialize() + "&submit=cinAdd",
                    success: function(response) {
                        if (response.status == 1) {
                            $.confirm({
                                title: 'สำเร็จ!',
                                content: 'ดำเนินการต่อ...',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "cinemaAdd.php";
                                        }
                                    },
                                    back: {
                                        text: 'กลับ',
                                        action: function() {
                                            window.location = "cinema.php";
                                        }
                                    }
                                }
                            })
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
                                        action: function() {
                                            window.location = "cinema.php";
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