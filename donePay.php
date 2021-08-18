<?php
session_start();
include_once("connectDB.php");
$sqlTic = "SELECT ticket.*, cycle_detail.*, cinema.*, movies.*, branch.* FROM ticket LEFT JOIN cycle_detail ON ticket.cyc_id = cycle_detail.cyc_id LEFT JOIN cinema ON cycle_detail.cin_id = cinema.cin_id LEFT JOIN branch ON cinema.branch_id = branch.branch_id LEFT JOIN movies ON cycle_detail.mov_id = movies.mov_id WHERE ticket.cyc_id = " . $_SESSION["cyc_id"] . " AND ticket.seat = '" . $_SESSION["seat"] . "' AND ticket.tic_price = " . $_SESSION["price"];
$queryTic = $conn->query($sqlTic);
$resultTic = mysqli_fetch_assoc($queryTic);

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

    <div id="done" class="container my-5">
        <div class="progress w-100" style="min-height: 30px;">
            <div class="progress-bar bar1 w-25 fontDetail bg-black" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">เลือกรอบฉาย</div>
            <div class="progress-bar bar2 w-25 fontDetail bg-black" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">เลือกที่นั่ง</div>
            <div class="progress-bar bar3 w-25 fontDetail bg-black" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">การชำระเงิน</div>
            <div class="progress-bar bar4 w-25 fontDetail bg-black" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">สิ้นสุด</div>
        </div>

        <div class="text-center mt-5">
            <h2>ซื้อตั๋วภาพยนตร์เสร็จสิ้น</h2>
        </div>

        <div class="row mt-3 border shadow justify-content-center w-100 mx-auto" style="max-width: 700px;">
            <div class="col-3 col-lg-4 border-end p-3">
                <img src="image/movie/<?= $resultTic["mov_picture"]; ?>" class="w-100">
            </div>
            <div class="col-9 col-lg-8 p-3">
                <div class="d-flex flex-column">
                    <div class="border-bottom d-flex flex-row justify-content-between align-items-center pb-1 mb-3">
                        <div class="tic-name">
                            <p class="tic-name mb-0"><?= $resultTic["mov_name"]; ?></p>
                        </div>
                        <div>
                            <img src="image/fav-icon.jpg" style="max-width: 30px">
                        </div>
                    </div>
                    <div class="mb-0 mb-lg-4">
                        <p class="tic-detail mb-0"><?= $resultTic["branch_name"]; ?></p>
                    </div>
                    <div class="mb-0 mb-lg-4">
                        <div class="row text-muted">
                            <div class="col-6 col-sm-4">
                                <p class="tic-detail mb-0">โรงภาพยนตร์</p>
                            </div>
                            <div class="col-6 col-sm-8">
                                <p class="tic-detail mb-0">ที่นั่ง</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-sm-4">
                                <p class="tic-detail mb-0"><?= $resultTic["cin_name"]; ?></p>
                            </div>
                            <div class="col-6 col-sm-8">
                                <p class="tic-detail mb-0"><?= $resultTic["seat"]; ?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row text-muted tic-detail">
                            <div class="col-6 col-sm-4">
                                <p class="tic-name mb-0">วันที่</p>
                            </div>
                            <div class="col-3 col-sm-4">
                                <p class="tic-name mb-0">เวลา</p>
                            </div>
                            <div class="col-3 col-sm-4">
                                <p class="tic-name mb-0">ราคา</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-6 col-sm-4">
                                <p class="tic-name mb-0"><?= $resultTic["cyc_date"]; ?></p>
                            </div>
                            <div class="col-3 col-sm-4">
                                <p class="tic-name mb-0"><?= $resultTic["time"]; ?></p>
                            </div>
                            <div class="col-3 col-sm-4">
                                <p class="tic-name mb-0"><?= $resultTic["tic_price"]; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>