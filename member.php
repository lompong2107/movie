<?php
if (empty($_COOKIE["email"])) {
    header("location: /movie");
}
include_once("connectDB.php");
$sql = "SELECT * FROM member WHERE mem_email = '" . $_COOKIE["email"] . "'";
$query = $conn->query($sql);
$result = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
    <?php include_once("head.php"); ?>
    <style>
        .memberMenu p {
            color: gray;
            cursor: pointer;
        }

        .memberMenu p:hover {
            color: black;
        }

        .memberMenu p.active {
            color: black;
        }
    </style>
</head>

<body>
    <?php include_once("navbar.php"); ?>

    <div id="member" class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-3 h-100">
                <div class="card">
                    <div class="card-body text-center memberMenu">
                        <p class="card-text" id="ticket">ประวัติการจอง/ซื้อ</p>
                        <p class="card-text" id="member">ข้อมูลส่วนตัว</p>
                        <a class="btn btn-outline-dark w-100" href="#" id="logout">ออกจากระบบ</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-9 mt-5 mt-sm-0">
                <div class="card memberShow member">
                    <h5 class="card-header">ข้อมูลส่วนตัว</h5>
                    <div class="card-body">
                        <h5 class="card-title mb-3">แก้ไขข้อมูลส่วนตัว</h5>
                        <form id="memberEdit" method="POST">
                            <div class="row mb-3 align-items-center">
                                <div class="col-12 col-sm-2 text-sm-end">ชื่อ</div>
                                <div class="col-12 col-sm-10">
                                    <input type="text" class="form-control border-end-0" name="firstname" placeholder="ชื่อ" required value="<?= $result["mem_name"]; ?>">
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-12 col-sm-2 text-sm-end">นามสกุล</div>
                                <div class="col-12 col-sm-10">
                                    <input type="text" class="form-control border-end-0" name="lastname" placeholder="นามสกุล" required value="<?= $result["mem_surname"]; ?>">
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-12 col-sm-2 text-sm-end">อีเมล</div>
                                <div class="col-12 col-sm-10">
                                    <input type="email" class="form-control border-end-0" name="email" placeholder="อีเมล" required value="<?= $result["mem_email"]; ?>" hidden>
                                    <input type="email" class="form-control border-end-0" name="email" placeholder="อีเมล" disabled required value="<?= $result["mem_email"]; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 text-center">
                                        <button type="submit" class="btn btn-dark">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card memberShow ticket">
                    <h5 class="card-header">ประวัติการจอง/ซื้อ</h5>
                    <div class="card-body p-1 p-sm-3">
                        <h5 class="card-title mb-3">รายการทั้งหมด</h5>
                        <?php
                        $sqlSale = "SELECT ticket.*, cycle_detail.*, cinema.*, movies.*, branch.*, sale.* FROM sale LEFT JOIN ticket ON sale.tic_id = ticket.tic_id LEFT JOIN cycle_detail ON ticket.cyc_id = cycle_detail.cyc_id LEFT JOIN cinema ON cycle_detail.cin_id = cinema.cin_id LEFT JOIN branch ON cinema.branch_id = branch.branch_id LEFT JOIN movies ON cycle_detail.mov_id = movies.mov_id WHERE mem_id = " . $_COOKIE["mem_id"];
                        $querySale = $conn->query($sqlSale);

                        $count = $querySale->num_rows;
                        if ($count == 0) {
                        ?>
                            <p class="card-text">คุณไม่มีประวัติการจอง/ซื้อบัตรชมภาพยนตร์</p>
                            <?php
                        } else {
                            while ($row = mysqli_fetch_assoc($querySale)) {
                            ?>
                                <div class="row mt-3 m-0 border shadow" style="max-width: 600px;">
                                    <div class="col-3 border-end p-1 p-sm-3">
                                        <img src="image/movie/<?= $row["mov_picture"]; ?>" class="w-100">
                                    </div>
                                    <div class="col-9 p-1 p-sm-3">
                                        <div class="d-flex flex-column">
                                            <div class="border-bottom d-flex flex-row justify-content-between align-items-center pb-1 mb-3">
                                                <div class="tic-name">
                                                    <p class="tic-name mb-0"><?= $row["mov_name"]; ?></p>
                                                </div>
                                                <div>
                                                    <img src="image/fav-icon.jpg" style="max-width: 30px">
                                                </div>
                                            </div>
                                            <div class="mb-0 mb-lg-4">
                                                <p class="tic-detail mb-0"><?= $row["branch_name"]; ?></p>
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
                                                        <p class="tic-detail mb-0"><?= $row["cin_name"]; ?></p>
                                                    </div>
                                                    <div class="col-6 col-sm-8">
                                                        <p class="tic-detail mb-0"><?= $row["seat"]; ?></p>
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
                                                        <p class="tic-name mb-0"><?= $row["cyc_date"]; ?></p>
                                                    </div>
                                                    <div class="col-3 col-sm-4">
                                                        <p class="tic-name mb-0"><?= $row["time"]; ?></p>
                                                    </div>
                                                    <div class="col-3 col-sm-4">
                                                        <p class="tic-name mb-0"><?= $row["tic_price"]; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $(".memberShow." + <?= json_encode($_GET["call"]); ?>).addClass("active");
            $(".memberMenu #" + <?= json_encode($_GET["call"]); ?>).addClass("active");
            $(".memberShow").not(".active").hide();
            $(".memberMenu p").click(function() {
                const id = $(this).attr("id");
                $(this).addClass("active");
                $(".memberMenu p").not(this).removeClass("active");
                $(".memberShow." + id).addClass("active");
                $(".memberShow").not("." + id).removeClass("active");
                $(".memberShow").not(".active").hide("1000");
                $(".memberShow.active").show("1000");
            })

            // ! แก้ไขข้อมูล
            $("#memberEdit").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "memberController.php",
                    data: $(this).serialize() + "&submit=edit",
                    success: function(response) {
                        if (response.status == 1) {
                            $.confirm({
                                title: 'สำเร็จ!',
                                content: 'แก้ขไข้อมูลสำเร็จ!',
                                buttons: {
                                    confirm: {
                                        text: 'ตกลง',
                                        action: function() {
                                            window.location = "member.php?call=member";
                                        }
                                    }
                                }
                            })
                        } else {
                            $.alert({
                                title: 'ล้มเหลว!',
                                content: 'แก้ไขข้อมูลไม่สำเร็จ!',
                                text: 'ตกลง'
                            })
                        }
                    }
                })
            })

            // ! ออกจากระบบ
            $(".memberMenu #logout").click(function() {
                $.confirm({
                    title: "ออกจากระบบ!",
                    content: "ดำเนินการต่อ...",
                    buttons: {
                        confirm: {
                            text: "ตกลง",
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "memberController.php",
                                    data: {
                                        logout: 1
                                    },
                                    success: function(response) {
                                        if (response.status == 1) {
                                            $.confirm({
                                                title: "ออกจากระบบ!",
                                                content: "ออกจากระบบสำเร็จ!",
                                                buttons: {
                                                    confirm: {
                                                        text: "ตกลง",
                                                        action: function() {
                                                            window.location = "/movie";
                                                        }
                                                    }
                                                }
                                            })
                                        } else {
                                            $.alert({
                                                title: "ออกจากระบบ!",
                                                content: "ล้มเหลว!",
                                                text: "ตกลง"
                                            })
                                        }
                                    }
                                })
                            }
                        },
                        cancel: {
                            text: "ยกเลิก"
                        }
                    }
                })

            })
        })
    </script>
</body>

</html>