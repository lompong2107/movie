<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie | Admin</title>
    <?php include_once("head.php"); ?>
</head>

<body>
    <?php include_once("sidebar.php"); ?>

    <div class="home-section">
        <nav class="navbar navbar-dark bg-dark home-content w-100 text-white">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <i class='bx bx-menu'></i>
                </li>
                <li class="nav-item">
                    <span class="h3" id="text-title">ภาพยนตร์</span>
                </li>
            </ul>
        </nav>
        <div class="content py-3" id="content">
            <div class="container">
                <div class="row py-2">
                    <div class="col text-end">
                        <a href="movieAdd.php" class="btn btn-dark btn-sm"><i class='bx bx-plus align-middle'></i>
                            เพิ่มภาพยนตร์</a>
                    </div>
                </div>
                <table class="pt-2 cell-border compact stripe dataTable" id="dataTable">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>รูป</th>
                            <th>หมวดหมู่</th>
                            <th>สถานะของหนัง</th>
                            <th>วันที่เข้าโรง</th>
                            <th>วันที่ออกโรง</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">รูปปก</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="" id="imagepreview" style="width: 200px;">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $.ajax({
            type: "POST",
            url: "movieDataTable.php",
            success: function(response) {
                $("table > tbody").html(response);
            }
        })
    </script>
    <script src="../js/js.js"></script>
</body>

</html>