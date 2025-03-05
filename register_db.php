<?php
include './db.php'; // ไฟล์เชื่อมต่อฐานข้อมูล

header('Content-Type: application/json'); // กำหนด response เป็น JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    if (empty($email) || empty($password) || empty($confirm_password)) {
        echo json_encode(["status" => "error", "message" => "Full Name, Email, password and confirm password are required!"]);
        exit();
    }

    // ตรวจสอบให้รหัสผ่านตรงกัน
    if ($password !== $confirm_password) {
        echo json_encode(["status" => "error", "message" => "รหัสผ่านไม่ตรงกัน"]);
        exit();
    }

    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]);
        exit();
    }

    // ตรวจสอบว่าอีเมลมีอยู่ในฐานข้อมูลหรือไม่
    $stmt = $conn->prepare("SELECT id FROM account WHERE email = ?");
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database query failed: " . $conn->error]);
        exit();
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "อีเมล์นี้ถูกใช้งานแล้ว"]);
        $stmt->close();
        exit();
    }

    // หากไม่มีอีเมลซ้ำให้ทำการสมัครสมาชิกใหม่
    // เข้ารหัสรหัสผ่าน
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO account (email, pass_word , name) VALUES (?, ?, ?)");
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database query failed: " . $conn->error]);
        exit();
    }
    $stmt->bind_param("sss", $email, $hashed_password, $name);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "สมัครสมาชิกสำเร็จ!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาดในการสมัครสมาชิก"]);
    }

    $stmt->close();
    $conn->close();
}
?>
