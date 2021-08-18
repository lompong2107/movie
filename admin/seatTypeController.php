<?php
header("Content-Type: application/json");
include_once("../connectDB.php");
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "seatTypeAdd") {
        $sql = "INSERT INTO seat_type VALUES (NULL, '" . $_POST['seat_type_name'] . "', '" . $_POST["seat_type_price"] . "')";
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "seatTypeEdit") {
        $sql = "UPDATE seat_type SET seat_type_name = '" . $_POST['seat_type_name'] . "', seat_type_price = '" . $_POST["seat_type_price"] . "' WHERE seat_type_id = " . $_POST["seat_type_id"];
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "seatTypeDelete") {
        $sql = "DELETE FROM seat_type WHERE seat_type_id = " . $_POST['id'];
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
