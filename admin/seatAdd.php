<?php
session_start();
include_once("../connectDB.php");
$sqlCin = "SELECT * FROM cinema WHERE branch_id = " . $_SESSION["branch_id"];
$queryCin = $conn->query($sqlCin);
$sql_seat_type = "SELECT * FROM seat_type";
$query_seat_type = $conn->query($sql_seat_type);
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
                    <span class="h3" id="text-title">เพิ่มที่นั่ง</span>
                </li>
            </ul>
        </nav>
        <div class="content py-3" id="content">
            <div class="mx-auto border" style="width: 700px;">
                <h3 class="text-center my-3">ที่นั่ง</h3>
                <form id="seat_form_add" method="POST">
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="cin_id" class="col-form-label">โรงภาพยนตร์</label>
                        </div>
                        <div class="col-6">
                            <select class="form-select" name="cin_id" id="cin_id" required>
                                <option value="">-- โปรดเลือก --</option>
                                <?php while ($row = mysqli_fetch_assoc($queryCin)) { ?>
                                    <option value="<?= $row["cin_id"]; ?>">โรงภาพยนตร์ <?= $row["cin_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="seat_type_id" class="col-form-label">ประเภทที่นั่ง</label>
                        </div>
                        <div class="col-6">
                            <select class="form-select" name="seat_type_id" id="seat_type_id" required>
                                <option value="">-- โปรดเลือก --</option>
                                <?php while ($row = mysqli_fetch_assoc($query_seat_type)) { ?>
                                    <option value="<?= $row["seat_type_id"]; ?>"><?= $row["seat_type_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="seat_row" class="col-form-label">แถว</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="seat_row" id="seat_row" class="form-control" required>
                        </div>
                        <div class="col-4">
                            <span class="form-text">
                                A, B, C
                            </span>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-2 text-end">
                            <label for="seat_amount" class="col-form-label">จำนวน</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="seat_amount" id="seat_amount" class="form-control" required>
                        </div>
                        <div class="col-4">
                            <span class="form-text">
                                จำนวนที่นั่ง
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 text-end">
                            <input type="submit" class="btn btn-success w-25" value="บันทึก">
                        </div>
                        <div class="col-6">
                            <a href="seat.php" class="btn btn-primary w-25">กลับ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // ! ฟอร์มเพิ่มข้อมูล
            $("#seat_form_add").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "seatController.php",
                    data: $(this).serialize() + "&submit=seatAdd",
                    success: function(response) {
                        if (response.status == 1) {
                            $.confirm({
                                title: 'สำเร็จ!',
                                content: 'ดำเนินการต่อ...',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "seatAdd.php";
                                        }
                                    },
                                    back: {
                                        text: 'กลับ',
                                        btnClass: 'btn-blue',
                                        action: function() {
                                            window.location = "seat.php";
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
                                            window.location = "seat.php";
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