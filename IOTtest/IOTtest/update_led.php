
<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "iottest");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu JSON từ yêu cầu
$data = json_decode(file_get_contents("php://input"), true);
$led_id = $data['led_id'];
$status = $data['status'];

// Cập nhật trạng thái LED
$sql = "UPDATE led_status SET status = ? WHERE led_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $status, $led_id);

if ($stmt->execute()) {
    echo "STATE UPDATED SUCCESSFULLY";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>