<?php
session_start();
// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
    header("Location: index"); // เปลี่ยนเส้นทางไปยังหน้า index.html
    exit();
}

$name = $_SESSION['name'];

?>


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCNONE Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #e8f4fc;
        }

        .navbar {
            background-color: #2196F3;
            /* ฟ้าสด */
        }

        .navbar-brand {
            color: white;
        }

        .navbar-brand-logout:hover {
            background-color: #f0f8ff;
            border: 1px solid red;
        }

        .dashboard-item {
            background-color: #ffffff;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
            height: 150px;
            width: 10dvw;
            /* กำหนดขนาดให้พอดี */
            text-decoration: none;
            cursor: pointer;       
        }

        .dashboard-item:hover {
            background-color: #f0f8ff;
            /* ฟ้าอ่อนเมื่อเลื่อนเมาส์ */
        }

        .dashboard-item .icon {
            font-size: 45px;
            margin-bottom: 10px;
            color: #2196F3;
            /* สีฟ้าสำหรับไอคอน */
        }

        .footer {
            background-color: #2196F3;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .container {
            margin-top: 20px;
            max-width: 100%;
            /* ขยายขนาด container */
            padding: 0% 5%;
            /* เพิ่ม padding เพื่อให้มีพื้นที่มากขึ้น */
        }

        /* ปรับขนาดของกริดให้มี 8 ช่อง */
        .row-cols-md-8 {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            /* 8 คอลัมน์ */
            gap: 15px;
        }

        @media (max-width: 768px) {
            .row-cols-md-8 {
                grid-template-columns: repeat(4, 1fr);
                /* 4 คอลัมน์สำหรับหน้าจอเล็ก */
            }
        }
    </style>
</head>

<body>

    <?php include './components/nav.php' ?>

    <div class="container mt-4">
    <div class="row g-4 d-flex justify-content-center"> <!-- ทำให้ 2 ไอเทมอยู่ตรงกลาง -->
        <div class="col-auto"> <!-- col-auto จะช่วยให้ขนาดคอลัมน์พอดีกับเนื้อหา -->
            <a class="dashboard-item d-flex flex-column justify-content-center align-items-center" href="#">
                <i class="icon fa-solid fa-calculator" style="font-size: 45px; color: #2196F3;"></i>
                <h5>คำนวณการจ้าง</h5>
            </a>
        </div>
       
    </div>
</div>

    <?php include './components/footer.php' ?>


    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>