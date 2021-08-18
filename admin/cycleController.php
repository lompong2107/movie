<?php
header("Content-Type: application/json");
include_once("../connectDB.php");
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "cycAdd") {
        $dataTime = explode(",", $_POST["cycTime"]);
        $sqlCycDetail = "INSERT INTO cycle_detail VALUES (NULL, " . $_POST["mov_id"] . ", " . $_POST["cin_id"] . ", '" . $_POST["cyc_date"] . "')";
        $queryCycDetail = $conn->query($sqlCycDetail);
        if ($queryCycDetail) {
            $sqlSelect = "SELECT cyc_id FROM cycle_detail WHERE mov_id = " . $_POST["mov_id"] . " AND cin_id = " . $_POST["cin_id"] . " AND cyc_date = '" . $_POST["cyc_date"] . "' ORDER By cyc_id DESC LIMIT 1";
            $querySelect = $conn->query($sqlSelect);
            $result = mysqli_fetch_assoc($querySelect);
            for ($i = 0; $i < count($dataTime); $i++) {
                $sqlCyc = "INSERT INTO cycle VALUES (" . $result["cyc_id"] . ", '" . $dataTime[$i] . "')";
                $queryCyc = $conn->query($sqlCyc);
            }
            if ($queryCyc === $queryCycDetail) {
                $status = array("status" => 1);
            }
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "cycEdit") {
        $dataTime = explode(",", $_POST["cycTime"]);
        $sqlCycDetail = "UPDATE cycle_detail SET mov_id = " . $_POST["mov_id"] . ", cin_id = " . $_POST["cin_id"] . ", cyc_date = '" . $_POST["cyc_date"] . "' WHERE cyc_id = " . $_POST["cyc_id"];
        $queryCycDetail = $conn->query($sqlCycDetail);
        if ($queryCycDetail) {
            $sqlDelete = "DELETE FROM cycle WHERE cyc_id = " . $_POST["cyc_id"];
            $queryDelete = $conn->query($sqlDelete);
            for ($i = 0; $i < count($dataTime); $i++) {
                $sqlCyc = "INSERT INTO cycle VALUES (" . $_POST["cyc_id"] . ", '" . $dataTime[$i] . "')";
                $queryCyc = $conn->query($sqlCyc);
            }
            if ($queryCyc === $queryCycDetail) {
                $status = array("status" => 1);
            }
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "cycDelete") {
        $sqlCycDetail = "DELETE FROM cycle_detail WHERE cyc_id = " . $_POST["id"];
        $queryCycDetail = $conn->query($sqlCycDetail);
        $sqlCyc = "DELETE FROM cycle WHERE cyc_id = " . $_POST["id"];
        $queryCyc = $conn->query($sqlCyc);
        if ($queryCycDetail === $queryCyc) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }
}
