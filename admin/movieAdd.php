<?php
include_once("../connectDB.php");
$sql_movie_type = "SELECT * FROM movie_type";
$query_movie_type = $conn->query($sql_movie_type);
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
                    <span class="h3" id="text-title">เพิ่มภาพยนตร์</span>
                </li>
            </ul>
        </nav>
        <div class="content py-3" id="content">
            <div class="mx-auto border" style="width: 700px;">
                <h3 class="text-center my-3">ภาพยนตร์</h3>
                <form id="mov_form_add" method="POST" enctype="multipart/form-data">
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="mov_name" class="col-form-label">ชื่อภาพยนตร์</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="mov_name" id="mov_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="mov_actor" class="col-form-label">นักแสดงนำ</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="mov_actor" id="mov_actor" class="form-control" required>
                        </div>
                        <div class="col-4">
                            <span class="form-text">
                                นักแสดง1, นักแสดง2, นักแสดง3
                            </span>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="mov_superintendent" class="col-form-label">ผู้กำกับ</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="mov_superintendent" id="mov_superintendent" class="form-control" required>
                        </div>
                        <div class="col-4">
                            <span class="form-text">
                                ผู้กำกับ1, ผู้กำกับ2, ผู้กำกับ3
                            </span>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end align-self-start">
                            <label for="mov_details" class="col-form-label">เรื่องย่อ</label>
                        </div>
                        <div class="col-6">
                            <textarea name="mov_details" id="mov_details" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="mov_time" class="col-form-label">ความยาว</label>
                        </div>
                        <div class="col-6">
                            <input type="number" name="mov_time" id="mov_time" class="form-control" required>
                        </div>
                        <div class="col-4">
                            <span class="form-text">
                                นาที
                            </span>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end align-self-start">
                            <label for="mov_type_id" class="col-form-label">หมวดหมู่</label>
                        </div>
                        <div class="col-6">
                            <select class="form-select" name="mov_type_id" id="mov_type_id" required>
                                <option value="">
                                    -- โปรดเลือก --
                                </option>
                                <?php
                                while ($row = mysqli_fetch_assoc($query_movie_type)) {
                                ?>
                                    <option value="<?= $row["mov_type_id"]; ?>"><?= $row["mov_type_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="mov_date_start" class="col-form-label">วันที่เข้าโรง</label>
                        </div>
                        <div class="col-6">
                            <input type="date" name="mov_date_start" id="mov_date_start" class="form-control" min="<?= date("Y-m-d"); ?>" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="mov_date_end" class="col-form-label">วันที่ออกโรง</label>
                        </div>
                        <div class="col-6">
                            <input type="date" name="mov_date_end" id="mov_date_end" class="form-control" min="<?= date("Y-m-d"); ?>" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="mov_picture" class="col-form-label">ปกภาพยนต์</label>
                        </div>
                        <div class="col-6">
                            <input type="file" onchange="previewFile(this);" name="mov_picture" id="mov_picture" class="form-control" accept=".png, .jpg, .jpeg" required>
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
                                        <img src="" id="imagepreview" style="width: 200px;">
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
                            <a href="movie.php" class="btn btn-primary w-25">กลับ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // ! ฟอร์มเพิ่มข้อมูลภาพยนตร์
            $("#mov_form_add").submit(function(e) {
                e.preventDefault();
                var dataForm = new FormData(this);
                dataForm.append("submit", "movAdd");
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "movieController.php",
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
                                            window.location = "movieAdd.php";
                                        }
                                    },
                                    back: {
                                        text: 'กลับ',
                                        action: function() {
                                            window.location = "movie.php";
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
                                            window.location = "movie.php";
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