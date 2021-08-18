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
                    <span class="h3" id="text-title">หมวดหมู่</span>
                </li>
            </ul>
        </nav>
        <div class="content pt-3" id="content">
            <div class="container">
                <div class="row py-2">
                    <div class="col text-end">
                        <a class="btn btn-dark btn-sm" href="movieTypeAdd.php"><i class='bx bx-plus align-middle'></i>
                            เพิ่มหมวดหมู่</a>
                    </div>
                </div>
                <table class="pt-2 cell-border compact stripe dataTable" id="dataTable">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $.ajax({
            url: "movieTypeDataTable.php",
            success: function(response) {
                $("table > tbody").html(response);
            }
        })
    </script>
    <script src="../js/js.js"></script>
</body>

</html>