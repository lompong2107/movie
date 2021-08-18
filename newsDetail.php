<?php
include_once("connectDB.php");
$sql = "SELECT * FROM news WHERE new_id = " . $_GET["id"];
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

    <div class="row mx-auto mt-5 px-2">
        <div class="col-12 text-center">
            <p class="fw-bold new-name mb-0"><?= $row["new_detail"]; ?></p>
        </div>
        <div class="col-12 mb-2 text-center">
            <p class="pe-2 mb-3 border-end" style="font-size: 18px; display: inline;"><?= $row["new_title"]; ?></p>
            <p class="ps-2 text-muted" style="display: inline;"><?= thai_date_fullmonth(strtotime($row["new_date"])); ?></p>
        </div>
        <div class="col-12 mb-3 text-center">
            <img class="w-100" src="image/news/<?= $row["new_image"]; ?>" style="max-width: 600px;">
        </div>
    </div>
</body>

</html>