<?php
header("Content-Type: application/json");
include_once("../connectDB.php");
date_default_timezone_set('Asia/Bangkok');
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "proAdd") {
        $image = $_FILES["pro_image"]["name"];
        $image_type = strrchr($image, ".");
        $image_name = date("YmdHis");
        // ดึงข้อมูลมาเช็คว่าชื่อรูปซ้ำกันหรือไม่ ถ้าซ้ำให้ +1
        $sqlChk = "SELECT MAX(pro_id), pro_image FROM promotion";
        $queryChk = $conn->query($sqlChk);
        $resultChk = mysqli_fetch_assoc($queryChk);
        if (isset($resultChk["pro_id"])) {
            while ($resultChk["pro_image"] == $image_name) {
                $image_name += 1;
            }
        }
        $image_fullname = $image_name . $image_type;
        if ($image_type == ".jpg" || $image_type == ".jpeg" || $image_type == ".png") {
            $sql = "INSERT INTO promotion VALUES (NULL, '" . $_POST['pro_title'] . "', '" . $_POST['pro_detail'] . "'";
            $sql .= ",'$image_fullname', '" . $_POST["pro_date_start"] . "','" . $_POST['pro_date_end'] . "')";
            $query = $conn->query($sql);
            if ($query) {
                $status = array("status" => "1");
                move_uploaded_file($_FILES["pro_image"]["tmp_name"], "../image/promotion/" . $image_fullname);
            } else {
                $status = array("status" => "0");
            }
            echo json_encode($status);
        }
    }

    if ($_POST["submit"] == "proEdit") {
        if ($_FILES["pro_image"]["tmp_name"] != "") {
            $sqlSelect = "SELECT pro_image FROM promotion WHERE pro_id = " . $_POST["pro_id"];
            $querySelect = $conn->query($sqlSelect);
            $resultSelect = mysqli_fetch_assoc($querySelect);
            unlink("../image/promotion/" . $resultSelect["pro_image"]);
            $image = $_FILES["pro_image"]["name"];
            $image_type = strrchr($image, ".");
            $image_name = date("YmdHis");
            // ดึงข้อมูลมาเช็คว่าชื่อรูปซ้ำกันหรือไม่ ถ้าซ้ำให้ +1
            $sqlChk = "SELECT MAX(pro_id), pro_image FROM promotion";
            $queryChk = $conn->query($sqlChk);
            $resultChk = mysqli_fetch_assoc($queryChk);
            if (isset($resultChk["pro_id"])) {
                while ($resultChk["pro_image"] == $image_name) {
                    $image_name += 1;
                }
            }
            $image_fullname = $image_name . $image_type;
            $sql = "UPDATE promotion SET pro_title = '" . $_POST['pro_title'] . "', pro_detail = '" . $_POST["pro_detail"] . "'";
            $sql .= ", pro_image = '$image_fullname', pro_date_start = '" . $_POST["pro_date_start"] . "'";
            $sql .= ", pro_date_end = '" . $_POST["pro_date_end"] . "' WHERE pro_id = " . $_POST['pro_id'];
            move_uploaded_file($_FILES["pro_image"]["tmp_name"], "../image/promotion/" . $image_fullname);
        } else {
            $sql = "UPDATE promotion SET pro_title = '" . $_POST['pro_title'] . "', pro_detail = '" . $_POST["pro_detail"] . "'";
            $sql .= ", pro_date_start = '" . $_POST["pro_date_start"] . "', pro_date_end = '" . $_POST["pro_date_end"] . "' WHERE pro_id = " . $_POST['pro_id'];
        }
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "proDelete") {
        $sqlSelect = "SELECT pro_image FROM promotion WHERE pro_id = " . $_POST["id"];
        $querySelect = $conn->query($sqlSelect);
        $resultSelect = mysqli_fetch_assoc($querySelect);
        unlink("../image/promotion/" . $resultSelect["pro_image"]);
        $sql = "DELETE FROM promotion WHERE pro_id = " . $_POST['id'];
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }
}
$conn->close();
