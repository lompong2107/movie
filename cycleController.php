<?php
session_start();
include_once("connectDB.php");
date_default_timezone_set('Asia/Bangkok');
$monthTH = [null, 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
function thai_date_fullmonth($time)
{
    global $monthTH;
    $thai_date_return = date("j", $time);
    $thai_date_return .= " " . $monthTH[date("n", $time)];
    $thai_date_return .= " " . (date("Y", $time) + 543);
    return $thai_date_return;
}
if (isset($_POST["click"])) {
    if ($_POST["click"] == "date") {
        if ($_POST["date"] == "") {
            $sqlCyc = "SELECT cycle_detail.cyc_id FROM cycle_detail WHERE cycle_detail.mov_id = " . $_POST["mov_id"] . " AND cycle_detail.cyc_date = CURDATE()";
            $sqlReg = "SELECT region.reg_id, region.reg_name, branch.branch_id, COUNT(cycle.cyc_time) as countTime FROM cycle_detail LEFT JOIN cycle ON cycle_detail.cyc_id = cycle.cyc_id LEFT JOIN cinema ON cycle_detail.cin_id = cinema.cin_id LEFT JOIN branch ON cinema.branch_id = branch.branch_id LEFT JOIN region ON branch.reg_id = region.reg_id WHERE cycle_detail.mov_id = " . $_POST["mov_id"] . " AND cycle_detail.cyc_date = CURDATE() GROUP BY reg_name";
        } else {
            $sqlCyc = "SELECT cycle_detail.cyc_id FROM cycle_detail WHERE cycle_detail.mov_id = " . $_POST["mov_id"] . " AND cycle_detail.cyc_date = '" . $_POST["date"] . "'";
            $sqlReg = "SELECT region.reg_id, region.reg_name, branch.branch_id, COUNT(cycle.cyc_time) as countTime FROM cycle_detail LEFT JOIN cycle ON cycle_detail.cyc_id = cycle.cyc_id LEFT JOIN cinema ON cycle_detail.cin_id = cinema.cin_id LEFT JOIN branch ON cinema.branch_id = branch.branch_id LEFT JOIN region ON branch.reg_id = region.reg_id WHERE cycle_detail.mov_id = " . $_POST["mov_id"] . " AND cycle_detail.cyc_date = '" . $_POST["date"] . "' GROUP BY reg_name";
        }
        $queryCyc = $conn->query($sqlCyc);
        if ($queryCyc) {
            $count = $queryCyc->num_rows;
            if ($count > 0) {
                $queryReg = $conn->query($sqlReg);
                $resultCyc = mysqli_fetch_assoc($queryCyc);
?>
                <?php
                while ($rowReg = mysqli_fetch_assoc($queryReg)) {
                    if ($rowReg["countTime"] > 0) {
                ?>
                        <div class="accordion mt-3" id="accordionBranch<?= $rowReg["reg_id"]; ?>">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#reg_<?= $rowReg["reg_id"]; ?>" aria-expanded="true">
                                        <?= $rowReg["reg_name"]; ?>
                                    </button>
                                </h2>
                                <div id="reg_<?= $rowReg["reg_id"]; ?>" class="accordion-collapse collapse show" data-bs-parent="#accordionBranch<?= $rowReg["reg_id"]; ?>">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <?php
                                            $sql = "SELECT * FROM branch WHERE reg_id = " . $rowReg["reg_id"] . " AND branch_id = " . $rowReg["branch_id"];
                                            $query = $conn->query($sql);
                                            while ($rowBranch = mysqli_fetch_assoc($query)) {
                                            ?>
                                                <div class="col-12">
                                                    <span class="text-title"><?= $rowBranch["branch_name"]; ?></span>
                                                    <hr style="background-color: #dee2e6;">
                                                </div>
                                                <div class="d-flex flex-wrap selectTime">
                                                    <?php
                                                    if ($_POST["date"] == "") {
                                                        $sqlCyc = "SELECT cycle_detail.cyc_id, cycle_detail.cyc_date, cycle.cyc_time FROM cycle_detail LEFT JOIN cycle ON cycle_detail.cyc_id= cycle.cyc_id LEFT JOIN cinema ON cycle_detail.cin_id = cinema.cin_id LEFT JOIN branch ON cinema.branch_id = branch.branch_id LEFT JOIN region ON branch.reg_id = region.reg_id WHERE cycle_detail.mov_id = " . $_POST["mov_id"] . " AND cycle_detail.cyc_date = CURDATE() AND region.reg_id = " . $rowReg["reg_id"] . " ORDER BY cycle.cyc_time";
                                                    } else {
                                                        $sqlCyc = "SELECT cycle_detail.cyc_id, cycle_detail.cyc_date, cycle.cyc_time FROM cycle_detail LEFT JOIN cycle ON cycle_detail.cyc_id= cycle.cyc_id LEFT JOIN cinema ON cycle_detail.cin_id = cinema.cin_id LEFT JOIN branch ON cinema.branch_id = branch.branch_id LEFT JOIN region ON branch.reg_id = region.reg_id WHERE cycle_detail.mov_id = " . $_POST["mov_id"] . " AND cycle_detail.cyc_date = '" . $_POST["date"] . "' AND region.reg_id = " . $rowReg["reg_id"] . " ORDER BY cycle.cyc_time";
                                                    }
                                                    $queryCyc = $conn->query($sqlCyc);
                                                    while ($rowCyc = mysqli_fetch_assoc($queryCyc)) { ?>
                                                        <a href="seat.php?id=<?= $rowCyc["cyc_id"]; ?>&time=<?= $rowCyc["cyc_time"]; ?>" class="btn me-2 mb-2 text-decoration-none text-center rounded <?php if (date("H:i") >= $rowCyc["cyc_time"] && date("Y-m-d") == $rowCyc["cyc_date"]) {
                                                                                                                                                                                                            echo "disabled";
                                                                                                                                                                                                        } ?>" style="background: #e7f1ff; color: #0c63e4; width: 70px;">
                                                            <span class="align-middle"><?= $rowCyc["cyc_time"]; ?></span>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
            } else { ?>
                <div class="my-5 text-center">
                    <span class="h1" style="color: gray;">ไม่มีรอบฉาย</span>
                </div>
<?php
            }
        }
    } else if ($_POST["click"] == "session") {
        $_SESSION["cyc_id"] = $_POST["id"];
        $_SESSION["seat"] = $_POST["seat"];
        $_SESSION["price"] = $_POST["price"];
        $_SESSION["time"] = $_POST["time"];
    }
}
$conn->close();
?>