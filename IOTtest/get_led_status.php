
<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "iottest");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$led_id = "ESP8266_TogLED_01"; // ID của LED
$sql = "SELECT status FROM led_status WHERE led_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $led_id);
$stmt->execute();
$stmt->bind_result($status);
$stmt->fetch();

echo $status;

$stmt->close();
$conn->close();
?>
