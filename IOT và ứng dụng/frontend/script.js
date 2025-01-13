const apiUrl = 'http://<ESP8266_IP_ADDRESS>'; // Thay <ESP8266_IP_ADDRESS> bằng địa chỉ IP của ESP8266EX

// Lấy dữ liệu từ ESP8266EX
function fetchSensorData() {
  fetch(`${apiUrl}/api/tank-status`)
    .then(response => response.json())
    .then(data => {
      document.getElementById('temperature').innerText = data.temperature;
      document.getElementById('humidity').innerText = data.humidity;
      document.getElementById('water-level').innerText = data.waterLevel;
    })
    .catch(error => console.error('Lỗi khi lấy dữ liệu:', error));
}

// Gửi yêu cầu cho cá ăn
function feedFish() {
  fetch(`${apiUrl}/api/feed-fish`, {
    method: 'POST'
  })
    .then(response => response.text())
    .then(message => {
      const feedMessage = document.getElementById('feed-message');
      feedMessage.innerText = message;

      // Xóa thông báo sau 3 giây
      setTimeout(() => {
        feedMessage.innerText = '';
      }, 3000);
    })
    .catch(error => console.error('Lỗi khi cho cá ăn:', error));
}

// Gắn sự kiện khi nhấn nút cho cá ăn
document.getElementById('feed-button').addEventListener('click', feedFish);

// Lấy dữ liệu cảm biến khi trang tải
fetchSensorData();

// Cập nhật dữ liệu cảm biến mỗi 10 giây
setInterval(fetchSensorData, 10000);
