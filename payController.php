<?php
session_start();
include_once("connectDB.php");

$sql = "INSERT INTO ticket VALUES (NULL, " . $_SESSION["cyc_id"] . ", '" . $_SESSION["seat"] . "', '" . $_SESSION["time"] . "', " . $_SESSION["price"] . ", '1')";
$query = $conn->query($sql);
$sqlTic = "SELECT * FROM ticket WHERE cyc_id = " . $_SESSION["cyc_id"] . " AND seat = '" . $_SESSION["seat"] . "' AND tic_price = " . $_SESSION["price"];
$queryTic = $conn->query($sqlTic);
$resultTic = mysqli_fetch_assoc($queryTic);
$sql = "INSERT INTO sale VALUES(NULL, " . $_COOKIE["mem_id"] . ", " . $resultTic["tic_id"] . ", NOW(), '1')";
$query = $conn->query($sql);
if ($query) {
    require_once 'omise-php/lib/Omise.php';
    define('OMISE_PUBLIC_KEY', 'pkey_test_5ov3mhunrq4l0nnmtp0');
    define('OMISE_SECRET_KEY', 'skey_test_5b5w1ogjc6ow3b12y3f');
    define('OMISE_API_VERSION', '2015-11-17');
    $data = OmiseCharge::create(array(
        "amount" => $_SESSION["price"] . "00",
        "currency" => "thb",
        "card" => $_POST["omiseToken"]
    ));
    if ($data["status"] == "successful") {
        echo "<script>alert('จ่ายเงินเรียบร้อย'); window.location = 'donePay.php'</script>";
    }
} else {
    echo "<script>alert('จ่ายเงินผิดพลาด'); window.history.back();</script>";
}
