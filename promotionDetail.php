<?php
include_once("connectDB.php");
$sql = "SELECT * FROM promotion WHERE pro_id = " . $_GET["id"];
$query = $conn->query($sql);
$row = mysqli_fetch_assoc($query);
date_default_timezone_set("Asia/Bangkok");
$monthTH = [null, 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
function thai_date_fullmonth($time)
{
    global $monthTH;
    $thai_date_return = date("j", $time);
    $thai_date_return .= " " . $monthTH[date("n", $time)];
    $thai_date_return .= " " . (date("Y", $time) + 543);
    return $thai_date_return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
    <?php include_once("head.php"); ?>
</head>

<body>
    <?php include_once("navbar.php"); ?>

    <div class="row mx-auto mt-5 px-2" style="max-width: 900px;">
        <div class="col-12 text-center">
            <p class="fw-bold pro-name mb-0"><?= $row["pro_title"]; ?></p>
        </div>
        <div class="col-12 mb-2 text-center">
            <p class="text-muted pe-2 mb-3" style="font-size: 14px;">ตั้งแต่วันที่ <?= thai_date_fullmonth(strtotime($row["pro_date_start"])); ?> ถึงวันที่ <?= thai_date_fullmonth(strtotime($row["pro_date_end"])); ?></p>
        </div>
        <div class="col-12 mb-3 text-center">
            <img class="w-100" src="image/promotion/<?= $row["pro_image"]; ?>" style="max-width: 400px;">
        </div>
        <div class="col-12">
            <p class="mb-0">รายละเอียดโปรโมชัน</p>
            <p class="text-muted"><?= $row["pro_detail"]; ?></p>
        </div>
        <div class="col-12">
            <p class="mb-0">ระยะเวลา</p>
            <p class="text-muted">ตั้งแต่วันที่ <?= thai_date_fullmonth(strtotime($row["pro_date_start"])); ?> ถึงวันที่ <?= thai_date_fullmonth(strtotime($row["pro_date_end"])); ?></p>
        </div>
    </div>
</body>

</html>