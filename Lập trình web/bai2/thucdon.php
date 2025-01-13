<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thực đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<!-- header -->
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img src="resource/VuongNguyen (1).png" alt="Logo" width="100" height="100">
        <!-- <span class="fs-4">Tận hưỡng bữa ăn của bạn</span> -->
    </a>

    <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="nav-link" aria-current="page">Trang chủ</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Thực đơn</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Khuyến mãi</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Hệ thống cửa hàng</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Về chúng tôi</a></li>
    </ul>
    </header>   
</div>


<!-- menu -->
<div class="container text-center">
    <div class="row">
        <?php
        // Kết nối đến cơ sở dữ liệu 
        $servername = "localhost";
        $username = "root"; // Thay đổi thành tên đăng nhập của bạn
        $password = ""; // Thay đổi thành mật khẩu của bạn
        $dbname = "food_menu"; // Thay đổi thành tên cơ sở dữ liệu của bạn

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Lấy dữ liệu từ bảng menu
        $sql = "SELECT `tên`, `mô tả`, `giá`, `loại` FROM `foods`"; // Đảm bảo tên cột khớp với bảng
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col">';
                echo '<div class="card" style="width: 18rem;">';
                // echo '<img src="' . htmlspecialchars($row["image_url"]) . '" class="card-img-top" alt="' . htmlspecialchars($row["tên"]) . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row["tên"]) . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($row["mô tả"]) . '</p>';
                echo '<p class="card-text">' . number_format($row["giá"], 2) . ' VNĐ</p>';
                echo '<a href="#" class="btn btn-primary">Đặt hàng</a>';
                echo '</div></div></div>';
            }
        } else {
            echo '<p>No items found.</p>';
        }

        $conn->close();
        ?>
    </div>
</div>

    <!-- footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">&copy; 2024 Company, Inc</p>
    
            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="resource/VuongNguyen (1).png" alt="Logo" width="100" height="100">
            </a>
    
            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Trang chủ</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Thực đơn</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Khuyến mãi</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Hệ thống cửa hàng</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Về chúng tôi</a></li>
            </ul>
        </footer>
        </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>