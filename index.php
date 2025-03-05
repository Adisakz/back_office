<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- WordPress Default Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            margin: 0;
            overflow: hidden;
            font-family: 'Open Sans', sans-serif;
            /* ฟอนต์ของ WordPress */
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 102, 204, 0.5);
            /* สีฟ้าทับวิดีโอ */
            z-index: -1;
        }

        .login-container {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.8);
            /* เพิ่มความขาวขึ้น */
            backdrop-filter: blur(10px);
            /* ทำให้เบลอเล็กน้อย */
            border-radius: 10px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.8);
            /* เพิ่มความขาวให้ input */
            border: none;
            box-shadow: none;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 5px rgba(0, 102, 204, 0.5);
        }

        a.fw-bold {
            cursor: pointer;
            /* ทำให้แสดงมือชี้ */
        }
    </style>
</head>

<body>
    <video class="video-background" autoplay muted loop playsinline>
        <source src="https://pcnone.com/wp-content/uploads/2024/12/1085656-uhd_3840_2160_25fps.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="overlay"></div>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg login-container" style="width: 350px;" id="loginForm">
            <h3 class="text-center mb-3">Login</h3>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                <div class="text-end mt-1">
                    <a href="#">Forgot password?</a>
                </div>
            </div>

            <a type="submit" class="btn btn-primary w-100" onclick="btnLogin()">Login</a>
            <div class="text-center mt-3">
                <span class="text-color-white">Don't have an account?</span> <a class="fw-bold" onclick="showRegister()">Resister here</a>
            </div>
        </div>


        <div class="card p-4 shadow-lg login-container" style="width: 350px;display:none" id="registerForm">
            <div class="mb-3">
                <label for="email" class="form-label">Full Name</label>
                <input type="email" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailRegister" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordRegister" name="password" placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            <a class="btn btn-primary w-100" onclick="btnRegister()">Register</a>
            <div class="text-center mt-3">
                <span class="text-color-white">Already have an account?</span> <a class="fw-bold" onclick="showLogin()">Login here</a>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    function btnLogin() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        fetch('./check_login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = 'dashboard'; // เปลี่ยนเส้นทางไปยังหน้า Dashboard
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: data.message,
                        confirmButtonText: 'Try Again'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!',
                    confirmButtonText: 'OK'
                });
                console.error('Error:', error);
            });
    }

    function showRegister() {
        document.getElementById("registerForm").style.display = "";
        document.getElementById("loginForm").style.display = "none";
    }

    function showLogin() {
        document.getElementById("registerForm").style.display = "none";
        document.getElementById("loginForm").style.display = "";
    }

    function btnRegister() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('emailRegister').value;
        const password = document.getElementById('passwordRegister').value;
        const confirm_password = document.getElementById('confirm_password').value;

        console.log(email);
        console.log(password);
        console.log(confirm_password);
        fetch('./register_db', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&confirm_password=${encodeURIComponent(confirm_password)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(); // รีโหลดหน้าหลังจากกด "ตกลง"
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: data.message,
                        confirmButtonText: 'Try Again'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!',
                    confirmButtonText: 'OK'
                });
                console.error('Error:', error);
            });
    }
</script>