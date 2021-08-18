<?php
include_once("../connectDB.php");
$sql = "SELECT * FROM promotion WHERE pro_id = " . $_GET['id'];
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
                    <span class="h3" id="text-title">แก้ไขโปรโมชั่น</span>
                </li>
            </ul>
        </nav>
        <div class="content py-3" id="content">
            <div class="mx-auto border" style="width: 700px;">
                <h3 class="text-center my-3">โปรโมชั่น</h3>
                <form id="pro_form_edit" method="POST" enctype="multipart/form-data">
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="pro_title" class="col-form-label">หัวข้อ</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="pro_id" id="pro_id" value="<?= $result["pro_id"]; ?>" hidden>
                            <input type="text" name="pro_title" id="pro_title" class="form-control" value="<?= $result["pro_title"]; ?>" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end align-self-start">
                            <label for="pro_detail" class="col-form-label">รายละเอียด</label>
                        </div>
                        <div class="col-6">
                            <textarea name="pro_detail" id="pro_detail" class="form-control" rows="4" required><?= $result["pro_detail"]; ?></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="pro_date_start" class="col-form-label">วันที่เริ่ม</label>
                        </div>
                        <div class="col-6">
                            <input type="date" name="pro_date_start" id="pro_date_start" class="form-control" min="<?= date("Y-m-d"); ?>" value="<?= $result["pro_date_start"]; ?>" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="pro_date_end" class="col-form-label">วันที่สิ้นสุด</label>
                        </div>
                        <div class="col-6">
                            <input type="date" name="pro_date_end" id="pro_date_end" class="form-control" min="<?= date("Y-m-d"); ?>" value="<?= $result["pro_date_end"]; ?>" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="pro_image" class="col-form-label">รูปโปรโมชั่น</label>
                        </div>
                        <div class="col-6">
                            <input type="file" onchange="previewFile(this);" name="pro_image" id="pro_image" class="form-control" accept=".png, .jpg, .jpeg">
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
                                        <img src="../image/promotion/<?= $result["pro_image"]; ?>" id="imagepreview" style="width: 200px;">
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
                            <a href="promotion.php" class="btn btn-primary w-25">กลับ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // ! ฟอร์มแก้ไขข้อมูล
            $("#pro_form_edit").submit(function(e) {
                e.preventDefault();
                var dataForm = new FormData(this);
                dataForm.append("submit", "proEdit");
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "promotionController.php",
                    data: dataForm,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.status == 1) {
                            console.log(response);
                            $.confirm({
                                title: 'สำเร็จ!',
                                content: 'ดำเนินการต่อ...',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "promotion.php";
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
                                            window.location = "promotion.php";
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