<?php
include_once("../connectDB.php");
session_start();
date_default_timezone_set('Asia/Bangkok');
$sqlMov = "SELECT * FROM movies";
$queryMov = $conn->query($sqlMov);
$sqlCin = "SELECT * FROM cinema WHERE branch_id = " . $_SESSION["branch_id"] . " and cin_status = 1";
$queryCin = $conn->query($sqlCin);
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
                    <span class="h3" id="text-title">เพิ่มรอบฉาย</span>
                </li>
            </ul>
        </nav>
        <div class="content pt-3" id="content">
            <div class="mx-auto border" style="width: 700px;">
                <h3 class="text-center my-3">รอบฉาย</h3>
                <form id="cyc_form_add" method="POST">
                    <div class="row align-items-center mb-3">
                        <div class="col-4 text-end">
                            <label for="mov_id" class="col-form-label">ชื่อภาพยนตร์</label>
                        </div>
                        <div class="col-6">
                            <select class="form-select" name="mov_id" id="mov_id" required>
                                <option value="">-- โปรดเลือก --</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($queryMov)) {
                                ?>
                                    <option value="<?= $row["mov_id"]; ?>"><?= $row["mov_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-4 text-end">
                            <label for="cin_id" class="col-form-label">โรงภาพยนตร์</label>
                        </div>
                        <div class="col-6">
                            <select class="form-select" name="cin_id" id="cin_id" required>
                                <option value="">-- โปรดเลือก --</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($queryCin)) {
                                ?>
                                    <option value="<?= $row["cin_id"]; ?>">โรงภาพยนตร์ <?= $row["cin_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-4 text-end">
                            <label for="cyc_date" class="col-form-label">วันที่</label>
                        </div>
                        <div class="col-6">
                            <input type="date" name="cyc_date" id="cyc_date" class="form-control" min="<?= date("Y-m-d"); ?>" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-4 text-end">
                            <label for="cyc_time" class="col-form-label">เวลา</label>
                        </div>
                        <div class="col-6">
                            <input type='time' name="cyc_time" id="cyc_time" class="form-control">
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-4 text-end"></div>
                        <div class="col-6 alertTime"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 text-end">
                            <input type="submit" class="btn btn-success w-25" value="บันทึก">
                        </div>
                        <div class="col-6">
                            <a href="cycle.php" class="btn btn-primary w-25">กลับ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // ! เก็บเวลา
        var data_time = [];
        // ! ลบเวลา
        function removeItem(id) {
            data_time = $.grep(data_time, function(value) {
                return value != id;
            });
        }

        $(document).ready(function() {
            // ! เพิ่มเวลา
            $('#cyc_time').change(function() {
                var data = $(this).val();
                $(".alertTime").append(`<div class="alert alert-dark alert-dismissible fade show py-0" role="alert"><span class="align-middle">` +
                    data + `</span><button type="button" class="align-middle btn-close btn-sm" onClick="removeItem(this.id)" id="` + data + `" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
                data_time.push(data);
            });

            // ! ฟอร์มเพิ่มข้อมูล
            $("#cyc_form_add").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "cycleController.php",
                    data: $(this).serialize() + "&cycTime=" + data_time + "&submit=cycAdd",
                    success: function(response) {
                        if (response.status == 1) {
                            $.confirm({
                                title: 'สำเร็จ!',
                                content: 'ดำเนินการต่อ...',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "cycleAdd.php";
                                        }
                                    },
                                    back: {
                                        text: 'กลับ',
                                        btnClass: 'btn-blue',
                                        action: function() {
                                            window.location = "cycle.php";
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
                                            window.location = "cycle.php";
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