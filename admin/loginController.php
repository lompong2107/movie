<?php
header("Content-Type: application/json");
session_start();
include_once("../connectDB.php");
if (isset($_POST["username"])) {
    $sql = "SELECT * FROM user WHERE user_user = '" . $_POST["username"] . "' AND user_pass = '" . $_POST["password"] . "'";
    $query = $conn->query($sql);
    $num = $query->num_rows;
    if ($num > 0) {
        $result = mysqli_fetch_assoc($query);
        $_SESSION["username"] = $result["user_user"];
        $_SESSION["name"] = $result["user_name"];
        $_SESSION["branch_id"] = $result["branch_id"];
        $_SESSION["status"] = $result["user_status"];
        $status = array("status" => 1);
    } else {
        $status = array("status" => 0);
    }
    echo json_encode($status);
}

if (isset($_POST["logout"])) {
    if (session_destroy()) {
        $status = array("status" => 1);
    } else {
        $status = array("status" => 0);
    }
    echo json_encode($status);
}
