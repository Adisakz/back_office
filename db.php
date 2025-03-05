<?php
$host = "100.81.84.27";
$user = "root"; // เปลี่ยนตาม MySQL ของคุณ
$pass = "adminpcn"; // ถ้ามีรหัสผ่านให้ใส่
$dbname = "backoffice";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
