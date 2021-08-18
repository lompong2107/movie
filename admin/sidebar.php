<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);
if ($_SESSION["status"] == "") {
    echo "<script>alert('กรุณาเข้าสู่ระบบ!');window.location = 'login.php';</script>";
}
?>
<div class="sidebar">
    <div class="logo-details">
        <i class='bx bx-movie-play'></i>
        <span class="logo_name">Movie</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="index.php">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">หน้าแรก</span>
            </a>
        </li>
        <li>
            <div class="icon-link">
                <a href="movie.php" id="movie">
                    <i class='bx bx-camera-movie'></i>
                    <span class="link_name">ภาพยนตร์</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="movie.php">ภาพยนตร์</a></li>
                <li><a href="movieType.php">หมวดหมู่</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="cinema.php">
                    <i class='bx bx-building'></i>
                    <span class="link_name">โรงภาพยนตร์</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="cinema.php">โรงภาพยนตร์</a></li>
                <li><a href="cycle.php">รอบฉาย</a></li>
                <li><a href="seat.php">ที่นั่ง</a></li>
                <li><a href="seatType.php">ประเภทที่นั่ง</a></li>
            </ul>
        </li>
        <li>
            <a href="promotion.php" id="promotion">
                <i class='bx bxs-megaphone'></i>
                <span class="link_name">โปรโมชั่น</span>
            </a>
        </li>
        <li>
            <a href="news.php" id="news">
                <i class='bx bx-news'></i>
                <span class="link_name">ข่าวและกิจกรรม</span>
            </a>
        </li>
        <li>
            <a href="member.php" id="user">
                <i class='bx bx-user'></i>
                <span class="link_name">สมาชิก</span>
            </a>
        </li>
        <li>
            <div class="profile-details">
                <div class="name w-100">
                    <div class="profile_name"><?= $_SESSION["name"]; ?></div>
                </div>
                <a href="#" id="logout"><i class='bx bx-log-out'></i></a>
            </div>
        </li>
    </ul>
</div>
<script>
    $(document).ready(function() {
        // ! ปุ่มออกจากระบบ
        $("#logout").click(function() {
            $.confirm({
                title: "ออกจากระบบ!",
                content: "ดำเนินการต่อ...",
                buttons: {
                    confirm: {
                        text: "ตกลง",
                        action: function() {
                            $.ajax({
                                type: "POST",
                                url: "loginController.php",
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
                                                        window.location = "login.php";
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