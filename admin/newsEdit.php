<?php
include_once("../connectDB.php");
$sql = "SELECT * FROM news WHERE new_id = " . $_GET['id'];
$query = $conn->query($sql);
$result = mysqli_fetch_assoc($query);
?>
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
                    <span class="h3" id="text-title">แก้ไขข่าวและกิจกรรม</span>
                </li>
            </ul>
        </nav>
        <div class="content py-3" id="content">
            <div class="mx-auto border" style="width: 700px;">
                <h3 class="text-center my-3">ข่าวและกิจกรรม</h3>
                <form id="new_form_edit" method="POST" enctype="multipart/form-data">
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="new_title" class="col-form-label">หัวข้อ</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="new_id" id="new_id" value="<?= $result["new_id"]; ?>" hidden>
                            <input type="text" name="new_title" id="new_title" class="form-control" value="<?= $result["new_title"]; ?>" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end align-self-start">
                            <label for="new_detail" class="col-form-label">รายละเอียด</label>
                        </div>
                        <div class="col-6">
                            <textarea name="new_detail" id="new_detail" class="form-control" rows="4" required><?= $result["new_detail"]; ?></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="new_date" class="col-form-label">วันที่</label>
                        </div>
                        <div class="col-6">
                            <input type="date" name="new_date" id="new_date" class="form-control" value="<?= $result["new_date"]; ?>" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="new_image" class="col-form-label">รูปข่าวและกิจกรรม</label>
                        </div>
                        <div class="col-6">
                            <input type="file" onchange="previewFile(this);" name="new_image" id="new_image" class="form-control" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="col-4">
                            <span class="form-text">
                                เลือกไฟล์ภาพ .png .jpg .jpeg
                            </span>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">ดูตัวอย่าง</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">รูปตัวอย่าง</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="../image/news/<?= $result["new_image"]; ?>" id="imagepreview" style="width: 200px;">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 text-end">
                            <input type="submit" class="btn btn-success w-25" value="บันทึก">
                        </div>
                        <div class="col-6">
                            <a href="news.php" class="btn btn-primary w-25">กลับ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // ! ฟอร์มแก้ไขข้อมูล
            $("#new_form_edit").submit(function(e) {
                e.preventDefault();
                var dataForm = new FormData(this);
                dataForm.append("submit", "newEdit");
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "newsController.php",
                    data: dataForm,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 1) {
                            $.confirm({
                                title: 'สำเร็จ!',
                                content: 'ดำเนินการต่อ...',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "news.php";
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
                                    cancel: {
                                        text: 'กลับ',
                                        btnClass: 'btn-blue',
                                        action: function() {
                                            window.location = "news.php";
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