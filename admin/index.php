<?php
session_start();
include_once("../connectDB.php");
$sql = "SELECT * FROM user LEFT JOIN branch ON user.branch_id = branch.branch_id WHERE user.branch_id = " . $_SESSION["branch_id"];
$query = $conn->query($sql);
$result = mysqli_fetch_assoc($query);
?>
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
                    <span class="h3" id="text-title">หน้าแรก</span>
                </li>
            </ul>
        </nav>
        <div class="content pt-5" id="content">
            <h1 class="text-center"><?= $result["branch_name"]; ?></h1>
        </div>
    </div>
    <script src="../js/js.js"></script>
</body>

</html>