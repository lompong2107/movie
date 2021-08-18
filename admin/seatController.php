<?php
header("Content-Type: application/json");
include_once("../connectDB.php");
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "seatAdd") {
        $sql = "INSERT INTO seat VALUES (NULL, " . $_POST["cin_id"] . ", " . $_POST["seat_type_id"] . ", '" . $_POST["seat_row"] . "', '" . $_POST["seat_amount"] . "')";
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "seatEdit") {
        $sql = "UPDATE seat SET cin_id = " . $_POST["cin_id"] . ", seat_type_id = " . $_POST['seat_type_id'] . ", seat_row = '" . $_POST["seat_row"] . "', seat_amount = '" . $_POST["seat_amount"] . "' WHERE seat_id = " . $_POST["seat_id"];
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "seatDelete") {
        $sql = "DELETE FROM seat WHERE seat_id = " . $_POST['id'];
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
