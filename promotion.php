<?php
include_once("connectDB.php");
$sql = "SELECT * FROM promotion WHERE pro_date_start <= NOW() AND pro_date_end > NOW() ORDER BY pro_date_start DESC";
$query = $conn->query($sql);
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
    <div id="promotion" class="container mt-5">
        <div class="text-center">
            <h3>โปรโมชั่น</h3>
            <hr style="background-color: #dee2e6;">
        </div>
        <div class="row mx-0">
            <?php
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-6 col-md-3 px-1 px-md-2 px-lg-3 mb-3">
                    <a href="promotionDetail.php?id=<?= $row["pro_id"]; ?>">
                        <div class="card p-0 p-sm-3 shadow-sm rounded">
                            <img src="image/promotion/<?= $row["pro_image"]; ?>" class="card-img-top shadow-sm">
                            <div class="card-body px-1 py-1 py-sm-3">
                                <p class="mb-1 fw-bold text-title text-truncate"><?= $row["pro_title"]; ?></p>
                                <p class="m-0 fw-bold text-black-50 fontDetail text-truncate"><?= $row["pro_detail"]; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>