<?php
include_once("connectDB.php");
$sql = "SELECT movies.*, movie_type.mov_type_name FROM movies LEFT JOIN movie_type ON movies.mov_type_id = movie_type.mov_type_id WHERE mov_id = " . $_GET["id"];
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

    <div class="row mx-auto border shadow mt-5 px-2 py-4 p-sm-5" style="max-width: 900px;">
        <div class="col-12 col-sm-3 mb-3 text-center">
            <img class="w-100" src="image/movie/<?= $row["mov_picture"]; ?>" style="max-width: 200px;">
        </div>
        <div class="col-12 col-sm-9">
            <div class="row h-100 justify-content-center">
                <div>
                    <span class="fw-bold mov-name"><?= $row["mov_name"]; ?></span>
                </div>
                <div class="mb-3 mt-2" style="font-size: 1rem">
                    <span class="text-muted pe-2 my-2">วันที่เข้าฉาย: <?= thai_date_fullmonth(strtotime($row["mov_date_start"])); ?></span>
                </div>
                <div class="mb-3 text-muted" style="font-size: 1rem">
                    <span class="pe-3 border-end">หมวดหมู่: <?= $row["mov_type_name"]; ?></span><span class="ps-3"><?= $row["mov_time"]; ?> นาที</span>
                </div>
                <div class="mb-3 text-muted" style="font-size: 1rem">
                    <span class="text-muted">ผู้กำกับ: <?= $row["mov_superintendent"]; ?></span>
                </div>
                <div class="text-muted" style="font-size: 1rem">
                    <span class="text-muted">นักแสดง: <?= $row["mov_actor"]; ?></span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>