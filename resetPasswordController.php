<?php
header("Content-Type: application/json");
include_once("connectDB.php");
$sql = "UPDATE member SET mem_pass = '" . $_POST["resetPassword"] . "' WHERE mem_email = '" . $_POST["email"] . "'";
$query = $conn->query($sql);
if ($query) {
    $status = array("status" => 1);
} else {
    $status = array("status" => 0);
}
echo json_encode($status);
$conn->close();
