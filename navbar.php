<!-- // ! Navbar -->
<div class="bg-black">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/movie"><img src="image/fav-icon.jpg" alt="Logo" width="40px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto text-nowrap">
                        <li class="nav-item">
                            <a class="nav-link" href="/movie" id="index">หน้าแรก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="movie.php" id="movie">ภาพยนต์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cinema.php" id="cinema">โรงภาพยนต์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="promotion.php" id="promotion">โปรโมชั่น</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="news.php" id="news">ข่าวและกิจกรรม</a>
                        </li>
                    </ul>
                    <div class="navbar-nav">
                        <?php if (isset($_COOKIE["name"])) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $_COOKIE["name"]; ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="member.php?call=ticket">ตั๋ว/ประวัติ</a></li>
                                    <li><a class="dropdown-item" href="member.php?call=member">ข้อมูลส่วนตัว</a></li>
                                    <li>
                                        <hr class="dropdown-divider" style="background-color: #dee2e6;">
                                    </li>
                                    <li><a class="dropdown-item" href="#" id="logout">ออกจากระบบ</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <a class="nav-link px-0 me-0 btnForm" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">เข้าสู่ระบบ/สมัครสมาชิก</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- // ! Form Login -->
<div class="modal" tabindex="-1" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 id="modalHeader" class="modal-title w-100">สมาชิก</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <form id="loginForm" method="POST">
                    <div class="my-3 input-group">
                        <input type="email" class="form-control border-end-0" name="email" aria-describedby="addon-email" placeholder="อีเมล" required>
                        <span class="input-group-text bg-white" id="addon-email"><i class="fi-rr-envelope"></i></span>
                    </div>
                    <div class="mb-3 input-group">
                        <input type="password" class="form-control border-end-0" name="password" aria-describedby="addon-password" placeholder="รหัสผ่าน" minlength="8" pattern="[A-Za-z0-9]+" required>
                        <span class="input-group-text bg-white" id="addon-password"><i class="fi-rr-lock"></i></span>
                    </div>
                    <div class="mb-3 text-end">
                        <a href="#" class="text-muted" id="btnForgetPassword" data-bs-toggle="modal" data-bs-target="#forgetPasswordModal" data-bs-dismiss="modal">ลืมรหัสผ่าน</a>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-dark w-100">เข้าสู่ระบบ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-5 my-3">
                <div class="row" id="register">
                    <div class="col-6 my-auto">
                        <span>ต้องการสมัครสมาชิก</span>
                    </div>
                    <div class="col-6">
                        <button id="btnRegister" class="btn btn-dark w-100 h-100" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">สมัครสมาชิก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- // ! Forget Password -->
<div class="modal" tabindex="-1" id="forgetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 id="modalHeader" class="modal-title w-100">ลืมรหัสผ่าน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <form id="forgetPasswordForm" method="POST">
                    <div class="my-3 input-group">
                        <input type="email" class="form-control border-end-0" name="email" id="email" aria-describedby="addon-email" placeholder="อีเมล" required>
                        <span class="input-group-text bg-white" id="addon-email"><i class="fi-rr-envelope"></i></span>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-dark w-100">ส่งลิ้งก์ปลี่ยนรหัสผ่าน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-5 my-3">
                <div class="row" id="login">
                    <div class="col-6 my-auto">
                        <span>เป็นสมาชิกอยู่แล้ว</span>
                    </div>
                    <div class="col-6">
                        <button id="btnLogin" class="btn btn-dark w-100 h-100" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">เข้าสู่ระบบ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- // ! Form Register -->
<div class="modal" tabindex="-1" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 id="modalHeader" class="modal-title w-100">สมาชิก</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <form id="registerForm" method="POST">
                    <div class="my-3 input-group">
                        <input type="email" class="form-control border-end-0" name="email" aria-describedby="addon-email" placeholder="อีเมล" required>
                        <span class="input-group-text bg-white" id="addon-email"><i class="fi-rr-envelope"></i></span>
                    </div>
                    <div class="mb-3 input-group">
                        <input type="password" class="form-control border-end-0" name="password" aria-describedby="addon-password" placeholder="รหัสผ่าน" pattern="[A-Za-z0-9]+" minlength="8" required>
                        <span class="input-group-text bg-white" id="addon-password"><i class="fi-rr-lock"></i></span>
                    </div>
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control border-end-0" name="firstname" aria-describedby="addon-firstname" placeholder="ชื่อ" required>
                        <span class="input-group-text bg-white" id="addon-password"><i class="fi-rr-user"></i></span>
                    </div>
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control border-end-0" name="lastname" aria-describedby="addon-lastname" placeholder="นามสกุล" required>
                        <span class="input-group-text bg-white" id="addon-password"><i class="fi-rr-user"></i></span>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-dark w-100">สมัครสมาชิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-5 my-3">
                <div class="row" id="register">
                    <div class="col-6 my-auto">
                        <span>เป็นสมาชิกอยู่แล้ว</span>
                    </div>
                    <div class="col-6">
                        <button id="btnLogin" class="btn btn-dark w-100 h-100" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">เข้าสู่ระบบ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //  ! ฟอร์มเข้าสู่ระบบ
        $("#loginForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "memberController.php",
                data: $(this).serialize() + "&submit=login",
                success: function(response) {
                    if (response.status == 1) {
                        $.confirm({
                            title: 'สำเร็จ!',
                            content: 'เข้าสู่ระบบสำเร็จ!',
                            buttons: {
                                confirm: {
                                    text: 'ตกลง',
                                    action: function() {
                                        location.reload();
                                    }
                                }
                            }
                        })
                    } else {
                        $.alert({
                            title: 'ล้มเหลว!',
                            content: 'เข้าสู่ระบบไม่สำเร็จ!',
                            text: 'ตกลง'
                        })
                    }
                }
            })
        })

        // ! สมัครสมาชิก
        $("#registerForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "memberController.php",
                data: $(this).serialize() + "&submit=register",
                success: function(response) {
                    if (response.status == 1) {
                        $.confirm({
                            title: 'สำเร็จ!',
                            content: 'สมัครสมาชิกสำเร็จ!',
                            buttons: {
                                confirm: {
                                    text: 'ตกลง',
                                    action: function() {
                                        location.reload();
                                    }
                                }
                            }
                        })
                    } else if (response.status == 2) {
                        $.alert({
                            title: 'ล้มเหลว!',
                            content: 'มีอีเมลนี้อยู่แล้ว!',
                            text: 'ตกลง'
                        })
                    } else {
                        $.alert({
                            title: 'ล้มเหลว!',
                            content: 'เข้าสู่ระบบไม่สำเร็จ!',
                            text: 'ตกลง'
                        })
                    }
                }
            })
        })

        // ! ออกจากระบบ
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
                                                        location.reload();
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

        // ! ลืมรหัสผ่านซะแล้ว ส่งผ่านไปที่อีเมลเลยดีกว่างั้น
        $("#forgetPasswordForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "memberController.php",
                data: $(this).serialize() + "&submit=forget",
                success: function(response) {
                    if (response.status == 1) {
                        $.confirm({
                            title: 'สำเร็จ!',
                            content: 'ส่งรหัสผ่านของคุณไปยังอีเมล: ' + $("#forgetPasswordForm #email").val() + " สำเร็จ!",
                            buttons: {
                                confirm: {
                                    text: 'ตกลง',
                                    action: function() {
                                        window.location = "/movie";
                                    }
                                }
                            }
                        })
                    } else if (response.status == 2) {
                        $.alert({
                            title: 'ล้มเหลว!',
                            content: 'ส่งอีเมลไม่สำเร็จ!',
                            text: 'ตกลง'
                        })
                    } else {
                        $.alert({
                            title: 'ล้มเหลว!',
                            content: 'ไม่พบอีเมลนี้!',
                            text: 'ตกลง'
                        })
                    }
                }
            })
        })
    })
</script>