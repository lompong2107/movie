<?php
include_once("connectDB.php");
$monthTH = [null, 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
function thai_date_fullmonth($time)
{
    global $monthTH;
    $thai_date_return = date("j", $time);
    $thai_date_return .= " " . $monthTH[date("n", $time)];
    $thai_date_return .= " " . (date("Y", $time) + 543);
    return $thai_date_return;
}
$sql = "SELECT * FROM news ORDER BY new_date DESC";
$query = $conn->query($sql);
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
    <div id="news" class="container mt-5">
        <div class="text-center">
            <h3>ข่าวและกิจกรรม</h3>
            <hr style="background-color: #dee2e6;">
        </div>
        <div class="row mx-0">
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="col-6 col-md-4 px-1 px-md-2 px-lg-3 mb-3">
                    <a href="newsDetail.php?id=<?= $row["new_id"]; ?>">
                        <div class="card p-0 p-sm-3 shadow rounded">
                            <img src="image/news/<?= $row["new_image"]; ?>" class="card-img-top">
                            <div class="card-body px-1 py-1 pt-sm-3">
                                <p class="mb-1 fw-bold text-title text-center"><?= $row["new_title"]; ?></p>
                                <p class="mb-1 text-crop text-title"><?= $row["new_detail"]; ?></p>
                                <p class="mb-1 fw-bold text-black-50 fontDetail text-center"><?= thai_date_fullmonth(strtotime($row["new_date"])); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>