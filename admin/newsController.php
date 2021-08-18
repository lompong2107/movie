<?php
header("Content-Type: application/json");
include_once("../connectDB.php");
date_default_timezone_set('Asia/Bangkok');
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "newAdd") {
        $image = $_FILES["new_image"]["name"];
        $image_type = strrchr($image, ".");
        $image_name = date("YmdHis");
        // ดึงข้อมูลมาเช็คว่าชื่อรูปซ้ำกันหรือไม่ ถ้าซ้ำให้ +1
        $sqlChk = "SELECT MAX(new_id), new_image FROM news";
        $queryChk = $conn->query($sqlChk);
        $resultChk = mysqli_fetch_assoc($queryChk);
        if (isset($resultChk["new_id"])) {
            while ($resultChk["new_image"] == $image_name) {
                $image_name += 1;
            }
        }
        $image_fullname = $image_name . $image_type;
        if ($image_type == ".jpg" || $image_type == ".jpeg" || $image_type == ".png") {
            $sql = "INSERT INTO news VALUES (NULL, '" . $_POST['new_title'] . "', '" . $_POST['new_detail'] . "'";
            $sql .= ",'$image_fullname', '" . $_POST["new_date"] . "')";
            $query = $conn->query($sql);
            if ($query) {
                $status = array("status" => "1");
                move_uploaded_file($_FILES["new_image"]["tmp_name"], "../image/news/" . $image_fullname);
            } else {
                $status = array("status" => "0");
            }
            echo json_encode($status);
        }
    }

    if ($_POST["submit"] == "newEdit") {
        if ($_FILES["new_image"]["tmp_name"] != "") {
            $sqlSelect = "SELECT new_image FROM news WHERE new_id = " . $_POST["new_id"];
            $querySelect = $conn->query($sqlSelect);
            $resultSelect = mysqli_fetch_assoc($querySelect);
            unlink("../image/news/" . $resultSelect["new_image"]);
            $image = $_FILES["new_image"]["name"];
            $image_type = strrchr($image, ".");
            $image_name = date("YmdHis");
            // ดึงข้อมูลมาเช็คว่าชื่อรูปซ้ำกันหรือไม่ ถ้าซ้ำให้ +1
            $sqlChk = "SELECT MAX(new_id), new_image FROM news";
            $queryChk = $conn->query($sqlChk);
            $resultChk = mysqli_fetch_assoc($queryChk);
            if (isset($resultChk["new_id"])) {
                while ($resultChk["new_image"] == $image_name) {
                    $image_name += 1;
                }
            }
            $image_fullname = $image_name . $image_type;
            $sql = "UPDATE news SET new_title = '" . $_POST['new_title'] . "', new_detail = '" . $_POST["new_detail"] . "'";
            $sql .= ", new_image = '$image_fullname', new_date = '" . $_POST["new_date"] . "' WHERE new_id = " . $_POST['new_id'];
            move_uploaded_file($_FILES["new_image"]["tmp_name"], "../image/news/" . $image_fullname);
        } else {
            $sql = "UPDATE news SET new_title = '" . $_POST['new_title'] . "', new_detail = '" . $_POST["new_detail"] . "'";
            $sql .= ", new_date = '" . $_POST["new_date"] . "' WHERE new_id = " . $_POST['new_id'];
        }
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "newDelete") {
        $sqlSelect = "SELECT new_image FROM news WHERE new_id = " . $_POST["id"];
        $querySelect = $conn->query($sqlSelect);
        $resultSelect = mysqli_fetch_assoc($querySelect);
        unlink("../image/news/" . $resultSelect["new_image"]);
        $sql = "DELETE FROM news WHERE new_id = " . $_POST['id'];
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
