<?php session_start();
include_once("connectDB.php");
$sqlMovNow = "SELECT * FROM movies WHERE mov_status = 1 AND mov_date_start < NOW() AND mov_date_end >= NOW()";
$queryMovNow = $conn->query($sqlMovNow);
$sqlMovSoon = "SELECT * FROM movies WHERE mov_status = 1 AND mov_date_start > NOW()";
$queryMovSoon = $conn->query($sqlMovSoon);

$sqlPro = "SELECT * FROM promotion WHERE pro_date_start <= NOW() AND pro_date_end > NOW() ORDER BY pro_date_start DESC LIMIT 8";
$queryPro = $conn->query($sqlPro);

$monthTH = [null, 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
function thai_date_fullmonth($time)
{
    global $monthTH;
    $thai_date_return = date("j", $time);
    $thai_date_return .= " " . $monthTH[date("n", $time)];
    $thai_date_return .= " " . (date("Y", $time) + 543);
    return $thai_date_return;
}
$sqlNew = "SELECT * FROM news ORDER BY new_date DESC LIMIT 6";
$queryNew = $conn->query($sqlNew);
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

    <!-- // ! Content -->
    <div class="container mt-5">
        <!-- // TODO ภาพยนตร์ -->
        <div id="movie">
            <div class="text-center">
                <h3>ภาพยนต์</h3>
                <ul class="nav nav-tabs justify-content-center mb-3 menuMovie">
                    <li class="nav-item">
                        <a class="nav-link active text-select" data-filter="mov" data-bs-toggle="tab" href="#" id="mov">ภาพยนตร์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-select" data-filter="soon" data-bs-toggle="tab" href="#" id="soon">โปรแกรมหน้า</a>
                    </li>
                </ul>
                <!-- // ! ภาพยนตร์ -->
                <div class="row mx-0 showMovie mov">
                    <?php
                    while ($row = mysqli_fetch_assoc($queryMovNow)) {
                    ?>
                        <div class="col-4 col-lg-3 px-1 px-md-2 px-lg-3 mb-3">
                            <a href="cycle.php?id=<?= $row["mov_id"]; ?>">
                                <div class="card p-0 p-sm-3 shadow-sm rounded">
                                    <img src="image/movie/<?= $row["mov_picture"]; ?>" class="card-img-top shadow-sm">
                                    <div class="card-body px-1 pt-1 pb-0 py-sm-3 text-center">
                                        <p class="mb-1 fw-bold fontDetail text-black-50"><span class="titleDate">วันที่เข้าฉาย:
                                            </span><span>
                                                <?= $row["mov_date_start"]; ?></span></p>
                                        <p class="m-0 fw-bold text-title"><?= $row["mov_name"]; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <!-- // ! โปรแกรมหน้า  -->
                <div class="row mx-0 showMovie soon">
                    <?php
                    while ($row = mysqli_fetch_assoc($queryMovSoon)) {
                    ?>
                        <div class="col-4 col-lg-3 px-1 px-md-2 px-lg-3 mb-3">
                            <a href="#">
                                <div class="card p-0 p-sm-3 shadow-sm rounded">
                                    <img src="image/movie/<?= $row["mov_picture"]; ?>" class="card-img-top shadow-sm">
                                    <div class="card-body px-1 pt-1 pb-0 py-sm-3 text-center">
                                        <p class="mb-1 fw-bold fontDetail text-black-50"><span class="titleDate">วันที่เข้าฉาย:
                                            </span><span>
                                                <?= $row["mov_date_start"]; ?></span></p>
                                        <p class="m-0 fw-bold text-title"><?= $row["mov_name"]; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- // TODO โปรโมชั่น -->
        <div id="promotion" class="mt-5">
            <div class="text-center">
                <h3>โปรโมชั่น</h3>
                <hr style="background-color: #dee2e6;">
            </div>
            <div class="row mx-0">
                <?php
                while ($row = mysqli_fetch_assoc($queryPro)) {
                ?>
                    <div class="col-6 col-lg-3 px-1 px-md-2 px-lg-3 mb-3">
                        <a href="promotionDetail.php?id=<?= $row["pro_id"]; ?>">
                            <div class="card p-0 p-sm-3 shadow-sm rounded">
                                <img src="image/promotion/<?= $row["pro_image"]; ?>" class="card-img-top shadow-sm">
                                <div class="card-body px-1 py-1 py-sm-3">
                                    <p class="mb-1 fw-bold text-title text-truncate"><?= $row["pro_title"]; ?></p>
                                    <p class="m-0 fw-bold text-black-50 fontDetail text-truncate"><?= $row["pro_detail"]; ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="mx-sm-3 mx-1 mt-sm-3 mt-1 mb-sm-5 mb-1">
            <a href="promotion.php" class="btn btn-outline-dark w-100 btn-lg">โปรโมชั่นทั้งหมด</a>
        </div>

        <!-- // TODO ข่าวและกิจกรรม -->
        <div id="news" class="mt-5">
            <div class="text-center">
                <h3>ข่าวและกิจกรรม</h3>
                <hr style="background-color: #dee2e6;">
            </div>
            <div class="row mx-0">
                <?php while ($row = mysqli_fetch_assoc($queryNew)) { ?>
                    <div class="col-6 col-lg-4 px-1 px-md-2 px-lg-3 mb-3">
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
        <div class="mx-sm-3 mx-1 mt-sm-3 mt-1 mb-sm-5 mb-1">
            <a href="news.php" class="btn btn-outline-dark w-100 btn-lg">ข่าวและกิจกรรมทั้งหมด</a>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $("#index").addClass("active");
            $(".showMovie").not(".mov").hide();

            $(".menuMovie a").click(function() {
                $(this).addClass("active");
                $("#menuMovie a").not(this).removeClass("active");
                const value = $(this).attr("data-filter");
                $(".showMovie").not("." + value).hide("1000");
                $(".showMovie").filter("." + value).show("1000");
            })

        })
    </script>
</body>

</html>