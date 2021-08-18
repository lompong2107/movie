<?php
include_once("connectDB.php");
$sqlReg = "SELECT * FROM region";
$queryReg = $conn->query($sqlReg);
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
    <div id="branch" class="container mt-5">
        <div class="text-center">
            <h3>สาขา</h3>
            <hr style="background-color: #dee2e6;">
        </div>
        <div class="accordion" id="accordionBranch">
            <?php while ($rowReg = mysqli_fetch_assoc($queryReg)) { ?>
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#branch_<?= $rowReg["reg_name"]; ?>" aria-expanded="true" aria-controls="collapseOne">
                            <?= $rowReg["reg_name"]; ?>
                        </button>
                    </h2>
                    <div id="branch_<?= $rowReg["reg_name"]; ?>" class="accordion-collapse collapse mb-3" data-bs-parent="#accordionBranch">
                        <div class="accordion-body">
                            <div class="row text-center">
                                <?php
                                $sql = "SELECT * FROM branch WHERE reg_id = " . $rowReg["reg_id"];
                                $query = $conn->query($sql);
                                while ($rowBranch = mysqli_fetch_assoc($query)) {
                                ?>
                                    <div class="col-6 col-md-4 col-lg-3 mb-5">
                                        <a href="#" class="text-decoration-none text-title"><?= $rowBranch["branch_name"]; ?></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>