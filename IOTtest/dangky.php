<?php
include('config.php');
session_start();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];

    // Kiểm tra tài khoản đã tồn tại
    $check_sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $check_query = mysqli_query($connection, $check_sql);
    $exists = mysqli_num_rows($check_query);

    if ($exists > 0) {
        $error = "Tên đăng nhập đã tồn tại!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, password, fullname) VALUES ('$username', '$hashed_password', '$fullname')";
        $query = mysqli_query($connection, $sql);

        if ($query) {
            $success = "Đăng ký thành công! Bạn có thể đăng nhập.";
        } else {
            $error = "Đăng ký thất bại. Vui lòng thử lại.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background: #0056b3;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Đăng Ký</h1>
        <?php if (isset($error)) echo "<p class='message'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='message success'>$success</p>"; ?>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Tên Đăng Nhập</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mật Khẩu</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="fullname">Họ và Tên</label>
                <input type="text" name="fullname" id="fullname" required>
            </div>
            <div class="form-group">
                <button type="submit" name="register">Đăng Ký</button>
            </div>
        </form>
    </div>
</body>
</html>
