<?php
$host = "localhost";
$user = "root"; // เปลี่ยนตาม MySQL ของคุณ
$pass = ""; // ถ้ามีรหัสผ่านให้ใส่
$dbname = "back_office_pcn";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
