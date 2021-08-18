<?php
define("hostname","localhost");
define("username","root");
define("password","");
define("database","movie");
$conn = new mysqli(hostname, username, password, database);
if($conn->connect_errno) {
    die($conn->connect_error);
}
?>