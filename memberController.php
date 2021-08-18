<?php
header("Content-Type: application/json");
include_once("connectDB.php");
require_once('PHPMailer/PHPMailerAutoload.php');
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "login") {
        $sql = "SELECT * FROM member WHERE mem_email = '" . $_POST["email"] . "' AND mem_pass = '" . $_POST["password"] . "'";
        $query = $conn->query($sql);
        $num = $query->num_rows;
        if ($num > 0) {
            $result = mysqli_fetch_assoc($query);
            setcookie("mem_id", $result["mem_id"], time() + (86400 * 1), "/"); // 86400 = 1 day
            setcookie("name", $result["mem_name"], time() + (86400 * 1), "/"); // 86400 = 1 day
            setcookie("email", $result["mem_email"], time() + (86400 * 1), "/"); // 86400 = 1 day
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "register") {
        $sql = "SELECT * FROM member WHERE mem_email = '" . $_POST["email"] . "'";
        $query = $conn->query($sql);
        $count = $query->num_rows;
        if ($count == 0) {
            $sql = "INSERT INTO member VALUES (NULL, '" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "', '" . $_POST["email"] . "', '" . $_POST["password"] . "')";
            $query = $conn->query($sql);
            if ($query) {
                $status = array("status" => 1);
            } else {
                $status = array("status" => 0);
            }
        } else {
            $status = array("status" => 2);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "edit") {
        $sql = "UPDATE member SET mem_name = '" . $_POST["firstname"] . "', mem_surname = '" . $_POST["lastname"] . "' WHERE mem_email = '" . $_POST["email"] . "'";
        $query = $conn->query($sql);
        if ($query) {
            $status = array("status" => 1);
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }

    if ($_POST["submit"] == "forget") {
        $sql = "SELECT * FROM member WHERE mem_email = '" . $_POST["email"] . "'";
        $query = $conn->query($sql);
        $count = $query->num_rows;
        if ($count > 0) {
            $mailto = $_POST["email"];
            $mailSub = "เปลี่ยนรหัสผ่าน!";
            $mailMsg = "คลิกลิ้งก์เพื่อเปลี่ยนรหัสผ่าน!<br /><a href='" . $_SERVER['SERVER_NAME'] . "/movie/resetPassword.php?email=" . $_POST["email"] . "'>" . $_SERVER['SERVER_NAME'] . "/movie/resetPassword.php?email=" . $_POST["email"] . "</a>";
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Host = "smtp.live.com";
            $mail->Port = 587;
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";
            $mail->ContentType = "text/html";
            $mail->Username = "keawatbun194@hotmail.com"; //username gmail accound
            $mail->Password = "Lompong194"; //password gmail accound
            $mail->SetFrom("keawatbun194@hotmail.com", "Movie");
            $mail->Subject = $mailSub;
            $mail->Body = $mailMsg;
            $mail->AddAddress($mailto);
            if ($mail->Send()) {
                $status = array("status" => 1);
            } else {
                $status = array("status" => 2);
            }
        } else {
            $status = array("status" => 0);
        }
        echo json_encode($status);
    }
}

if (isset($_POST["logout"])) {
    // setcookie("name", "", time() - 3600, '/');
    // setcookie("email", "", time() - 3600, '/');
    if (setcookie("name", "", time() - 3600, '/') && setcookie("email", "", time() - 3600, '/')) {
        $status = array("status" => 1);
    } else {
        $status = array("status" => 0);
    }
    echo json_encode($status);
}
$conn->close();
