<?php
session_start();
include_once("connectDB.php");
$sql = "SELECT cycle_detail.cyc_date, cycle_detail.cin_id, cinema.cin_name, movies.mov_name, movies.mov_picture, cycle.cyc_time, branch.branch_name FROM cycle_detail LEFT JOIN cycle ON cycle_detail.cyc_id = cycle.cyc_id LEFT JOIN movies ON cycle_detail.mov_id = movies.mov_id LEFT JOIN cinema ON cycle_detail.cin_id = cinema.cin_id LEFT JOIN branch ON cinema.branch_id = branch.branch_id  WHERE cycle.cyc_time = '" . $_SESSION["time"] . "' AND cycle_detail.cyc_id = " . $_SESSION["cyc_id"];
$query = $conn->query($sql);
$row = mysqli_fetch_assoc($query);
$sqlSeat = "SELECT * FROM seat WHERE cin_id = " . $row["cin_id"] . " ORDER BY seat_row DESC";
$querySeat = $conn->query($sqlSeat);

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
            <div class="progress-bar bar3 w-25 fontDetail bg-black" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">การชำระเงิน</div>
            <div class="progress-bar bar4 w-25 fontDetail bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">สิ้นสุด</div>
        </div>

        <div class="row mt-5 justify-content-center h-100">
            <div class="col-6 col-sm-3 ">
                <img class="shadow w-100" src="image/movie/<?= $row["mov_picture"]; ?>">
            </div>
            <div class="col-6 col-sm-3">
                <div class="d-flex flex-column h-100 justify-content-center">
                    <div>
                        <span class="fw-bold mov-name"><?= $row["mov_name"]; ?></span>
                    </div>
                    <div class="mb-4 mt-2">
                        <span class="text-muted border-end pe-2 my-2"><?= thai_date_fullmonth(strtotime($row["cyc_date"])); ?></span><span class="text-muted ps-2"><?= $row["cyc_time"]; ?></span>
                    </div>
                    <div>
                        <span><?= $row["branch_name"]; ?></span>
                    </div>
                    <div class="mb-4">
                        <span class="text-muted">โรงภาพยนตร์ <?= $row["cin_name"]; ?></span>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-8"><span>ที่นั่งที่เลือก</span></div>
                            <div class="col-4"><span>ราคารวม</span></div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="fw-bold col-8 mov-name"><span><?= $_SESSION["seat"]; ?></span></div>
                            <div class="fw-bold col-4 mov-name"><span><?= $_SESSION["price"]; ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-5 mx-auto border shadow-sm p-5" style="max-width: 600px;">
            <div class="col-12">
                <p style="font-size: 1.2rem;">ยืนยันการซื้อบัตรชมภาพยนตร์</p>
            </div>
            <div class="col-12">
                <?php
                if (empty($_COOKIE["email"])) {
                ?>
                    <div class="alert alert-dark py-1 px-1" role="alert">
                        กรุณาเข้าสู่ระบบ!
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-12">
                <label>กรอกรหัสนี้: <?= $rand = rand(100, 999); ?></label>
            </div>
            <div class="col-12 mb-4">
                <input class="form-control" type="number" id="numberCheck" placeholder="กรอกรหัสยืนยัน">
            </div>
            <div class="col-12">
                <p class="text-center" style="font-size: 1.2rem;">ช่องทางการชำระเงิน</p>
            </div>
            <div class="col-12 text-center">
                <form id="checkoutForm" method="POST" action="payController.php">
                    <script type="text/javascript" src="https://cdn.omise.co/omise.js" data-key="pkey_test_5ov3mhunrq4l0nnmtp0" data-image="http://<?= $_SERVER["SERVER_NAME"] ?>/movie/image/fav-icon.jpg" data-frame-label="Movie" data-button-label="Pay now" data-submit-label="Submit" data-location="no" data-amount="<?= $_SESSION["price"] . "00"; ?>" data-currency="thb">
                    </script>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#numberCheck").keyup(function() {
                var code = $(this).val();
                if (<?= json_encode($rand); ?> == code && <?= json_encode(isset($_COOKIE["email"])); ?>) {
                    $("#checkoutForm").find(".omise-checkout-button").prop("disabled", false);
                } else {
                    $("#checkoutForm").find(".omise-checkout-button").prop("disabled", true);
                }
            }).keyup()
        })
    </script>
</body>

</html>