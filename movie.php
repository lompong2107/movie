<?php
include_once("connectDB.php");
$sqlMovNow = "SELECT * FROM movies WHERE mov_status = 1 AND mov_date_start < NOW() AND mov_date_end >= NOW()";
$queryMovNow = $conn->query($sqlMovNow);
$sqlMovSoon = "SELECT * FROM movies WHERE mov_status = 1 AND mov_date_start > NOW()";
$queryMovSoon = $conn->query($sqlMovSoon);
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
    <div id="movie" class="container mt-5">
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
                    <div class="col-4 col-xl-3 px-1 px-md-2 px-lg-3 mb-3">
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
                    <div class="col-4 col-xl-3 px-1 px-md-2 px-lg-3 mb-3">
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

    <script>
        $(document).ready(function() {
            $("#movie").addClass("active");
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