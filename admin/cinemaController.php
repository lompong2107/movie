<?php
header("Content-Type: application/json");
session_start();
include_once("../connectDB.php");
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "cinAdd") {
        $sql = "INSERT INTO cinema VALUES (NULL, " . $_SESSION["branch_id"] . ", '" . $_POST["cin_name"] . "', '0')";
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "cinEdit") {
        $sql = "UPDATE cinema SET cin_name = '" . $_POST['cin_name'] . "' WHERE cin_id = " . $_POST['cin_id'];
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "cinDelete") {
        $sql = "DELETE FROM cinema WHERE cin_id = " . $_POST["id"];
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "updateStatusCinema") {
        $sqlSelect = "SELECT cin_status FROM cinema WHERE cin_id = " . $_POST["id"];
        $querySelect = $conn->query($sqlSelect);
        $resultSelect = mysqli_fetch_assoc($querySelect);
        if ($resultSelect["cin_status"] == "0") {
            $data = 1;
        } else {
            $data = 0;
        }
        $sql = "UPDATE cinema SET cin_status = '$data' WHERE cin_id = " . $_POST["id"];
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => "1");
        } else {
            $status = array("status" => "0");
        }
        echo json_encode($status);
    }
}
