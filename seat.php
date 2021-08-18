<?php
include_once("connectDB.php");
$sql = "SELECT cycle_detail.cyc_date, cycle_detail.cin_id, cinema.cin_name, movies.mov_name, movies.mov_picture, cycle.cyc_time, branch.branch_name FROM cycle_detail LEFT JOIN cycle ON cycle_detail.cyc_id = cycle.cyc_id LEFT JOIN movies ON cycle_detail.mov_id = movies.mov_id LEFT JOIN cinema ON cycle_detail.cin_id = cinema.cin_id LEFT JOIN branch ON cinema.branch_id = branch.branch_id  WHERE cycle.cyc_time = '" . $_GET["time"] . "' AND cycle_detail.cyc_id = " . $_GET["id"];
$query = $conn->query($sql);
$row = mysqli_fetch_assoc($query);
$sqlSeat = "SELECT * FROM seat WHERE cin_id = " . $row["cin_id"] . " ORDER BY seat_row DESC";
$querySeat = $conn->query($sqlSeat);
$sqlSeatUser = "SELECT * FROM ticket WHERE cyc_id = " . $_GET["id"] . " AND time = '" . $_GET["time"] . "'";
$querySeatUser = $conn->query($sqlSeatUser);
$count = $querySeatUser->num_rows;
if ($count > 0) {
    $resultSeatUser = mysqli_fetch_assoc($querySeatUser);
    $seat = $resultSeatUser["seat"];
} else {
    $seat = "";
}
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

    <div id="cycle" class="container my-5">
        <div class="progress w-100" style="min-height: 30px;">
            <div class="progress-bar bar1 w-25 fontDetail bg-black" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">เลือกรอบฉาย</div>
            <div class="progress-bar bar2 w-25 fontDetail bg-black" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">เลือกที่นั่ง</div>
            <div class="progress-bar bar3 w-25 fontDetail bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">การชำระเงิน</div>
            <div class="progress-bar bar4 w-25 fontDetail bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">สิ้นสุด</div>
        </div>

        <div class="row justify-content-center mt-5 h-100">
            <div class="col-4 col-sm-3">
                <img class="shadow w-100" src="image/movie/<?= $row["mov_picture"]; ?>">
            </div>
            <div class="col-8 col-sm-3">
                <div class="d-flex flex-column h-100 justify-content-center">
                    <div>
                        <p class="fw-bold mov-name mb-0"><?= $row["mov_name"]; ?></p>
                    </div>
                    <div class="mb-4">
                        <p class="text-muted border-end pe-2 mb-0 mov-detail" style="display: inline;"><?= thai_date_fullmonth(strtotime($row["cyc_date"])); ?></p>
                        <p class="text-muted ps-2 mb-0 mov-detail" style="display: inline;"><?= $row["cyc_time"]; ?></p>
                    </div>
                    <div class="">
                        <p class="mb-0 text-detail mov-detail"><?= $row["branch_name"]; ?></p>
                    </div>
                    <div>
                        <p class="text-muted mov-detail">โรงภาพยนตร์ <?= $row["cin_name"]; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-lg-row mt-5 selectSeat">
            <div class="d-flex flex-column w-100">
                <div class="d-flex align-items-center">
                    <div class="cinema text-center border py-3 px-lg-1 px-0" style="width: 90px">
                        <p class="my-0" style="font-size: 0.9rem;">โรงภาพยนตร์</p>
                        <p class="my-0 display-3" style="line-height: 0.7"><?= $row["cin_name"]; ?></p>
                    </div>
                    <div class="text-center d-flex w-100">
                        <div class="w-50">
                            <img src="image/seat/deluxe.png" style="height: 3rem;"><br>
                            <span class="pe-2" style="font-size: 1rem;">
                                Deluxe 120 บาท
                            </span>
                        </div>
                        <div class="w-50">
                            <img src="image/seat/premium.png" style="height: 3rem;"><br>
                            <span style="font-size: 1rem;">
                                Premium 140 บาท
                            </span>
                        </div>
                    </div>
                </div>
                <div class="text-center mb-3">
                    <hr>
                    จอภาพยนตร์
                </div>
                <div class="d-flex flex-column overflow-auto w-100 py-5">
                    <?php
                    while ($rowSeat = mysqli_fetch_assoc($querySeat)) {
                        $i = 1;
                    ?>
                        <div class="d-flex flex-row align-items-center">
                            <div><span style="font-size: 1rem;"><?= $rowSeat["seat_row"]; ?></span></div>
                            <div class="d-inline-flex mx-auto">
                                <?php
                                while ($rowSeat["seat_amount"] >= $i) {
                                ?>
                                    <?php
                                    if (strpos($seat, $rowSeat["seat_row"] . $i) !== false) {
                                    ?>
                                        <div><img class="user" src="image/seat/user.png" price="120" name="deluxe"></div>
                                    <?php
                                    } else if ($rowSeat["seat_type_id"] == 1) {
                                    ?>
                                        <div><img class="chair" src="image/seat/deluxe.png" price="120" name="deluxe" id="<?= $rowSeat["seat_row"] . $i; ?>"></div>
                                    <?php
                                    } else {
                                    ?>
                                        <div><img class="chair" src="image/seat/premium.png" price="140" name="premium" id="<?= $rowSeat["seat_row"] . $i; ?>"></div>
                                <?php
                                    }
                                    $i++;
                                }
                                ?>
                            </div>
                            <div><span style="font-size: 1rem; right: 0;"><?= $rowSeat["seat_row"]; ?></span></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="d-flex flex-column w-100 ms-0 ms-lg-3 mt-3 mt-lg-0 p-4 border shadow-sm">
                <div style="font-size: 1rem;">
                    <?= $row["mov_name"]; ?>
                </div>
                <div class="mb-3">
                    <span class="text-muted border-end pe-2 my-2" style="font-size: 0.9rem;"><?= thai_date_fullmonth(strtotime($row["cyc_date"])); ?></span><span class="text-muted ps-2"><?= $row["cyc_time"]; ?></span>
                </div>
                <div>
                    <span style="font-size: 1rem;">โรงภาพยนตร์ <?= $row["cin_name"]; ?></span>
                </div>
                <div class="mb-2 text-muted">
                    <span style="font-size: 0.9rem;"><?= $row["branch_name"]; ?></span>
                </div>
                <hr style="background-color: #dee2e6;">
                <div class="seatSelect">
                    <p class="text-center" style="font-size: 0.9rem;">ที่นั่งที่เลือก</p>
                    <p class="showSeat text-center" style="font-size: 1.2rem;"></p>
                </div>
                <div class="seatPrice">
                    <p class="text-center" style="font-size: 0.9rem;">ราคารวม</p>
                    <p class="showPrice text-center" style="font-size: 1.2rem;"></p>
                </div>
                <div>
                    <button class="btn btn-dark w-100 continue">ดำเนินการต่อ</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // ! เก็บที่นั่งและเก็บเงิน หมายถึงเก็บราคารวมนะ
            var data_seat = [];
            var price = 0;
            var show = "-";

            // ! ลบที่นั่ง
            function removeItem(id) {
                data_seat = $.grep(data_seat, function(value) {
                    return value != id;
                });
            }

            $(".seatSelect .showSeat").html(show);
            $(".seatPrice .showPrice").html(price + " บาท");

            $(".selectSeat .chair").click(function() {
                if (!$(this).hasClass("active")) {
                    const data = $(this).attr("id")
                    data_seat.push(data);
                    $(this).addClass("active");
                    $(this).attr("src", "image/check.png");
                    price += parseInt($(this).attr("price"));
                } else {
                    const data = $(this).attr("id")
                    removeItem(data);
                    $(this).removeClass("active");
                    if ($(this).attr("name") == "deluxe") {
                        $(this).attr("src", "image/seat/deluxe.png");
                    } else {
                        $(this).attr("src", "image/seat/premium.png");
                    }
                    price -= parseInt($(this).attr("price"));
                }
                show = "";
                if (data_seat.length == 0) {
                    show = "-";
                } else {
                    for (let i = 0; i < data_seat.length; i++) {
                        if (i > 0) {
                            show += ", ";
                        }
                        show += data_seat[i];
                    }
                }
                $(".seatSelect .showSeat").html(show);
                $(".seatPrice .showPrice").html(price + " บาท");
            })

            $(".continue").click(function() {
                if (data_seat.length > 0) {
                    $.ajax({
                        type: "POST",
                        url: "cycleController.php",
                        data: {
                            id: <?= json_encode($_GET["id"]); ?>,
                            time: <?= json_encode($_GET["time"]); ?>,
                            seat: show,
                            price: price,
                            click: "session"
                        },
                        success: function(response) {
                            window.location = "pay.php";
                        }
                    })
                } else {
                    $.alert({
                        title: 'ล้มเหลว!',
                        content: 'กรุณาเลือกที่นั่ง!',
                        text: 'ตกลง'
                    })
                }
            })
        });
    </script>