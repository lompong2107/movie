<?php
header("Content-Type: application/json");
include_once("../connectDB.php");
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "movTypeAdd") {
        $sql = "INSERT INTO movie_type VALUES (NULL, '" . $_POST['mov_type_name'] . "')";
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "movTypeEdit") {
        $sql = "UPDATE movie_type SET mov_type_name = '" . $_POST['mov_type_name'] . "' WHERE mov_type_id = " . $_POST['mov_type_id'];
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "movTypeDelete") {
        $sql = "DELETE FROM movie_type WHERE mov_type_id = " . $_POST['id'];
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
