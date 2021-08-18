<?php
session_start();
include_once("connectDB.php");
$sql = "SELECT mov.*, movT.*, cyc.* FROM movies mov LEFT JOIN movie_type movT ON mov.mov_type_id = movT.mov_type_id LEFT JOIN cycle_detail cyc ON mov.mov_id = cyc.mov_id WHERE mov.mov_id = " . $_GET["id"];
$query = $conn->query($sql);
$result = mysqli_fetch_assoc($query);

date_default_timezone_set("Asia/Bangkok");
$dayTH = ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'];
$monthTH = [null, 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
function thai_date($time, $day, $i)
{
    global $dayTH, $monthTH;
    if ((date("d", $time) + $i) == date("d", time())) {
        $thai_date_return = "<span>วันนี้</span><br>";
    } else {
        $thai_date_return = "<span>" . $dayTH[$day] . "</span><br>";
    }
    $thai_date_return .= "<span>" . (date("d", $time) + $i);
    $thai_date_return .= " " . $monthTH[date("n", $time)];
    $thai_date_return .= " " . ((int)date("Y", $time) + 543) . "</span>";
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
            <div class="progress-bar bar2 w-25 fontDetail bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">เลือกที่นั่ง</div>
            <div class="progress-bar bar3 w-25 fontDetail bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">การชำระเงิน</div>
            <div class="progress-bar bar4 w-25 fontDetail bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">สิ้นสุด</div>
        </div>
        <div id="movie" class="mt-5">
            <div class="row justify-content-center h-100">
                <div class="col-4 col-sm-3">
                    <img class="shadow w-100" src="image/movie/<?= $result["mov_picture"]; ?>">
                </div>
                <div class="col-8 col-sm-3">
                    <div class="d-flex flex-column h-100 justify-content-center">
                        <div class="mb-1 mb-sm-4">
                            <p class="fw-bold mov-name m-0"><?= $result["mov_name"]; ?></p>
                        </div>
                        <div>
                            <p class="text-muted m-0 mov-detail">หมวดหมู่: <?= $result["mov_type_name"]; ?></p>
                        </div>
                        <div class="mb-1 mb-sm-4">
                            <p class="text-muted m-0 mov-detail">ความยาว: <?= $result["mov_time"]; ?></p>
                        </div>
                        <div>
                            <a href="movieDetail.php?id=<?= $_GET["id"]; ?>" class="btn btn-outline-dark px-2 px-lg-4 text-muted mov-detail">รายละเอียดภาพยนตร์</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom mt-5">
                <div class="MultiCarousel" data-items="2,4,5,6" data-slide="1" id="MultiCarousel" data-interval="1000">
                    <div class="MultiCarousel-inner">
                        <?php
                        $date = time(); // แสดงวันที่ปัจจุบัน
                        $day = date("w", $date);
                        $dateNow = date("Y", $date) . "-" .  date("m", $date) . "-" . date("d", $date);
                        $dateSelect = date("Y", $date) . "-" .  date("m", $date) . "-" . date("d", $date);
                        for ($i = 0; $i < 30; $i++) {
                            if ($day > 6) {
                                $day = 0;
                            }
                            if ($dateSelect == $dateNow) {
                        ?>
                                <a href="#" id="<?= $dateSelect; ?>" class="active">
                                <?php } else { ?>
                                    <a href="#" id="<?= $dateSelect; ?>">
                                    <?php } ?>
                                    <div class="item">
                                        <div class="py-3 text-center my-auto">
                                            <?= thai_date($date, $day, $i); ?>
                                        </div>
                                    </div>
                                    </a>
                                <?php
                                $dateSelect = date("Y", $date) . "-" .  date("m", $date) . "-" . (date("d", $date) + $i + 1);
                                $day++;
                            }
                                ?>
                    </div>
                    <button class="border-0 leftLst"><i class='bx bx-chevron-left'></i></button>
                    <button class="border-0 rightLst"><i class='bx bx-chevron-right'></i></button>
                </div>
            </div>

            <div class="cycleTime"></div>

        </div>


    </div>

    <script>
        $(document).ready(function() {
            var itemsMainDiv = ('.MultiCarousel');
            var itemsDiv = ('.MultiCarousel-inner');

            $('.leftLst, .rightLst').click(function() {
                var condition = $(this).hasClass("leftLst");
                if (condition)
                    click(0, this);
                else
                    click(1, this)
            });

            ResCarouselSize();

            $(window).resize(function() {
                ResCarouselSize();
            });

            //this function define the size of the items
            function ResCarouselSize() {
                var incno = 0;
                var dataItems = ("data-items");
                var itemClass = ('.item');
                var btnParentSb = '';
                var itemsSplit = '';
                var sampwidth = $(itemsMainDiv).width();
                var bodyWidth = $('body').width();
                $(itemsDiv).each(function() {
                    var itemNumbers = $(this).find(itemClass).length;
                    btnParentSb = $(this).parent().attr(dataItems);
                    itemsSplit = btnParentSb.split(',');
                    if (bodyWidth >= 1200) {
                        incno = itemsSplit[3];
                        itemWidth = sampwidth / incno;
                    } else if (bodyWidth >= 992) {
                        incno = itemsSplit[2];
                        itemWidth = sampwidth / incno;
                    } else if (bodyWidth >= 768) {
                        incno = itemsSplit[1];
                        itemWidth = sampwidth / incno;
                    } else {
                        incno = itemsSplit[0];
                        itemWidth = sampwidth / incno;
                    }
                    $(this).css({
                        'transform': 'translateX(0px)',
                        'width': itemWidth * itemNumbers
                    });
                    $(this).find(itemClass).each(function() {
                        $(this).outerWidth(itemWidth);
                    });

                    $(".leftLst").addClass("over");
                    $(".rightLst").removeClass("over");

                });
            }

            //this function used to move the items
            function ResCarousel(e, el, s) {
                var leftBtn = ('.leftLst');
                var rightBtn = ('.rightLst');
                var translateXval = '';
                var divStyle = $(el + ' ' + itemsDiv).css('transform');
                var values = divStyle.match(/-?[\d\.]+/g);
                var xds = Math.abs(values[4]);
                if (e == 0) {
                    translateXval = parseInt(xds) - parseInt(itemWidth * s);
                    $(el + ' ' + rightBtn).removeClass("over");

                    if (translateXval <= itemWidth / 2) {
                        translateXval = 0;
                        $(el + ' ' + leftBtn).addClass("over");
                    }
                } else if (e == 1) {
                    var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                    translateXval = parseInt(xds) + parseInt(itemWidth * s);
                    $(el + ' ' + leftBtn).removeClass("over");

                    if (translateXval >= itemsCondition - itemWidth / 2) {
                        translateXval = itemsCondition;
                        $(el + ' ' + rightBtn).addClass("over");
                    }
                }
                $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
            }

            //It is used to get some elements from btn
            function click(ell, ee) {
                var Parent = "#" + $(ee).parent().attr("id");
                var slide = $(Parent).attr("data-slide");
                ResCarousel(ell, Parent, slide);
            }

            // ! ให้มันทำงานสักครั้งนะ
            $.ajax({
                type: "POST",
                url: "cycleController.php",
                data: {
                    date: $(".MultiCarousel-inner a.active").attr("id"),
                    mov_id: <?= $_GET["id"] ?>,
                    click: "date"
                },
                success: function(response) {
                    $(".cycleTime").html(response);
                }

            })

            $(".MultiCarousel-inner a").click(function() {
                $(this).addClass("active");
                $(".MultiCarousel-inner a").not($(this)).removeClass("active");
                $.ajax({
                    type: "POST",
                    url: "cycleController.php",
                    data: {
                        date: $(this).attr("id"),
                        mov_id: <?= $_GET["id"] ?>,
                        click: "date"
                    },
                    success: function(response) {
                        $(".cycleTime").html(response);
                    }

                })
            })
        });
    </script>
</body>

</html>