<?php
session_start();
include './db.php'; // ไฟล์เชื่อมต่อฐานข้อมูล

header('Content-Type: application/json'); // กำหนด response เป็น JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Email and password are required!"]);
        exit();
    }


    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]);
        exit();
    }

    // ตรวจสอบข้อมูลจากตาราง account
    $stmt = $conn->prepare("SELECT id, pass_word ,name FROM account WHERE email = ?");
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database query failed: " . $conn->error]);
        exit();
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password_db, $name);
        $stmt->fetch();
        
        if (password_verify($password, $password_db)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            echo json_encode(["status" => "success", "message" => "Login successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "รหัสผ่านไม่ถูกต้อง"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "อีเมล์ไม่ถูกต้อง"]);
    }

    $stmt->close();
    $conn->close();
}
?>