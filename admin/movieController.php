<?php
header("Content-Type: application/json");
session_start();
include_once("../connectDB.php");
date_default_timezone_set('Asia/Bangkok');
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "movAdd") {
        $image = $_FILES["mov_picture"]["name"];
        $image_type = strrchr($image, ".");
        $image_name = date("YmdHis");
        // ดึงข้อมูลมาเช็คว่าชื่อรูปซ้ำกันหรือไม่ ถ้าซ้ำให้ +1
        $sqlChk = "SELECT MAX(mov_id), mov_picture FROM movies";
        $queryChk = $conn->query($sqlChk);
        $resultChk = mysqli_fetch_assoc($queryChk);
        if (isset($resultChk["mov_id"])) {
            while ($resultChk["mov_picture"] == $image_name) {
                $image_name += 1;
            }
        }
        $image_fullname = $image_name . $image_type;
        if ($image_type == ".jpg" || $image_type == ".jpeg" || $image_type == ".png") {
            $sql = "INSERT INTO movies VALUES (NULL, " . $_POST['mov_type_id'] . ",'" . $_POST['mov_name'] . "'";
            $sql .= ",'" . $_POST['mov_actor'] . "','" . $_POST['mov_superintendent'] . "','" . $_POST['mov_details'] . "'";
            $sql .= ",'" . $_POST['mov_time'] . "','" . $_POST["mov_date_start"] . "','" . $_POST['mov_date_end'] . "'";
            $sql .= ",'$image_fullname','0')";
            $query = $conn->query($sql);
            if ($query) {
                $status = array("status" => "1");
                move_uploaded_file($_FILES["mov_picture"]["tmp_name"], "../image/movie/" . $image_fullname);
            } else {
                $status = array("status" => "0");
            }
            echo json_encode($status);
        }
    }

    if ($_POST["submit"] == "movEdit") {
        if ($_FILES["mov_picture"]["tmp_name"] != "") {
            $sqlSelect = "SELECT mov_picture FROM movies WHERE mov_id = " . $_POST["mov_id"];
            $querySelect = $conn->query($sqlSelect);
            $resultSelect = mysqli_fetch_assoc($querySelect);
            unlink("../image/movie/" . $resultSelect["mov_picture"]);
            $image = $_FILES["mov_picture"]["name"];
            $image_type = strrchr($image, ".");
            $image_name = date("YmdHis");
            // ดึงข้อมูลมาเช็คว่าชื่อรูปซ้ำกันหรือไม่ ถ้าซ้ำให้ +1
            $sqlChk = "SELECT MAX(mov_id), mov_picture FROM movies";
            $queryChk = $conn->query($sqlChk);
            $resultChk = mysqli_fetch_assoc($queryChk);
            if (isset($resultChk["mov_id"])) {
                while ($resultChk["mov_picture"] == $image_name) {
                    $image_name += 1;
                }
            }
            $image_fullname = $image_name . $image_type;
            $sql = "UPDATE movies SET mov_type_id = " . $_POST['mov_type_id'] . ", mov_name = '" . $_POST['mov_name'] . "'";
            $sql .= ", mov_actor = '" . $_POST["mov_actor"] . "', mov_superintendent = '" . $_POST["mov_superintendent"] . "'";
            $sql .= ", mov_details = '" . $_POST["mov_details"] . "', mov_time = '" . $_POST["mov_time"] . "'";
            $sql .= ", mov_date_start = '" . $_POST["mov_date_start"] . "', mov_date_end = '" . $_POST["mov_date_end"] . "'";
            $sql .= ", mov_picture = '$image_fullname' WHERE mov_id = " . $_POST['mov_id'];
            move_uploaded_file($_FILES["mov_picture"]["tmp_name"], "../image/movie/" . $image_fullname);
        } else {
            $sql = "UPDATE movies SET mov_type_id = " . $_POST['mov_type_id'] . ", mov_name = '" . $_POST['mov_name'] . "'";
            $sql .= ", mov_actor = '" . $_POST["mov_actor"] . "', mov_superintendent = '" . $_POST["mov_superintendent"] . "'";
            $sql .= ", mov_details = '" . $_POST["mov_details"] . "', mov_time = '" . $_POST["mov_time"] . "'";
            $sql .= ", mov_date_start = '" . $_POST["mov_date_start"] . "', mov_date_end = '" . $_POST["mov_date_end"] . "'";
            $sql .= " WHERE mov_id = " . $_POST['mov_id'];
        }
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "movDelete") {
        $sqlSelect = "SELECT mov_picture FROM movies WHERE mov_id = " . $_POST["id"];
        $querySelect = $conn->query($sqlSelect);
        $resultSelect = mysqli_fetch_assoc($querySelect);
        unlink("../image/movie/" . $resultSelect["mov_picture"]);
        $sql = "DELETE FROM movies WHERE mov_id = " . $_POST['id'];
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "updateStatusMovie") {
        $sqlSelect = "SELECT mov_status FROM movies WHERE mov_id = " . $_POST["id"];
        $querySelect = $conn->query($sqlSelect);
        $resultSelect = mysqli_fetch_assoc($querySelect);
        if ($resultSelect["mov_status"] == "0") {
            $data = 1;
        } else {
            $data = 0;
        }
        $sql = "UPDATE movies SET mov_status = '$data' WHERE mov_id = " . $_POST["id"];
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => "1");
        } else {
            $status = array("status" => "0");
        }
        echo json_encode($status);
    }
}
$conn->close();
