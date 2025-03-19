<?php
// Kết nối cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "iottest");

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Truy vấn dữ liệu từ bảng
$query = "SELECT * FROM cambien ORDER BY id DESC limit 1;";
$result = $mysqli->query($query);

$data = [];

// Lấy kết quả và đưa vào mảng
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($data);

$mysqli->close();
?>
