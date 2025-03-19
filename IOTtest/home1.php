<?php
  session_start();
  if (!$_SESSION['id']){
    header('location:login.php');
  }
  require 'database.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    //........................................ keep track post values
    $id = $_POST['id'];
    $lednum = $_POST['lednum'];
    $ledstate = $_POST['ledstate'];
    //........................................ 
    
    //........................................ 
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // replace_with_your_table_name, on this project I use the table name 'ESP8266_table_dht11_leds_update'.
    // This table is used to store DHT11 sensor data updated by ESP8266. 
    // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // To store data, this table is operated with the "UPDATE" command, so this table contains only one row.
    $sql = "UPDATE replace_with_your_table_name SET " . $lednum . " = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($ledstate,$id));
    Database::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>ESP8266 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">
    
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    <style>
      html {font-family: Arial; display: inline-block; text-align: center;}
      p {font-size: 1.2rem;}
      h4 {font-size: 0.8rem;}
      body {margin: 0;}
      .topnav {overflow: hidden; background-color: #0c6980; color: white; font-size: 1.2rem;}
      .content {padding: 5px; }
      .card {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #0c6980; border-radius: 15px;}
      .card.header {background-color: #0c6980; color: white; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 12px; border-top-left-radius: 12px;}
      .cards {max-width: 700px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));}
      .reading {font-size: 1.3rem;}
      .packet {color: #bebebe;}
      .temperatureColor {color: #fd7e14;}
      .humidityColor {color: #1b78e2;}
      .statusreadColor {color: #702963; font-size:12px;}
      .LEDColor {color: #183153;}
      
      /* ----------------------------------- Toggle Switch */
      .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
      }

      .switch input {display:none;}

      .sliderTS {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #D3D3D3;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
      }

      .sliderTS:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: #f7f7f7;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
      }

      input:checked + .sliderTS {
        background-color: #00878F;
      }

      input:focus + .sliderTS {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .sliderTS:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      .sliderTS:after {
        content:'OFF';
        color: white;
        display: block;
        position: absolute;
        transform: translate(-50%,-50%);
        top: 50%;
        left: 70%;
        font-size: 10px;
        font-family: Verdana, sans-serif;
      }

      input:checked + .sliderTS:after {  
        left: 25%;
        content:'ON';
      }

      input:disabled + .sliderTS {  
        opacity: 0.3;
        cursor: not-allowed;
        pointer-events: none;
      }
      /* ----------------------------------- */
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  </head>
  
  <body>
    <!-- <div class="topnav">
      <h3>ESP8266 WITH MYSQL DATABASE</h3>
    </div> -->
    <header>
            <nav class="navbar navbar-expand-lg text-light" style="background-color:#0c6980">
              <div class="container-lg ">
                <a href="/index.html">
                  <img src="img/logo-01.png" alt="" height="50px"
                    class="rounded-circle ms-4 me-4 nav-logo" id="mainLogo">
                  <span class="fw-bold text-light mt-3 ms-2 mt-3 display-6" id="mainLogo">
                    IOT FISH TANK
                  </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo"
                  aria-controls="demo" aria-expanded="false" aria-label="Nav-toggler">
                  <span class="navbar-toggler-icon"></span>
                </button>
              </div>
              <div class="collapse navbar-collapse justify-content-end align-center me-3 position-relative fixed-top" id="hiddenNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <!-- <p class="fw-bold">Trang chủ</a> -->
                     
                    <h2>Welcome <?php echo $_SESSION['hoten'] ?>!</h2>
                  </li>
                  <!-- <li class="nav-item dropdown text-light text-end">
                    <a class="nav-link dropdown  text-nowrap" href="/menu.html" aria-expanded="false">Thông số</a>
                  </li>
                  <li class="nav-item text-light text-end text-nowrap">
                    <a class="nav-link" href="#">Điều khiển</a>
                  </li>
      
                  <li class="nav-item text-light text-end text-nowrap">
                    <a class="nav-link" href="about.html">Giới thiệu</a>
                  </li> -->
                  <li class="nav-item text-light text-end text-nowrap">
                    <a type="button" class="btn btn-light rounded-pill ms-3 "href="logout.php">Đăng xuất</a>
                  </li>
                </ul>
              </div>
              <div class="collapse" id="search-form">
      
              </div>
            </nav>
          </header>
    <br>
    
    <!-- __ DISPLAYS MONITORING AND CONTROLLING ____________________________________________________________________________________________ -->
    <div class="content">
      <div class="cards">
        
        <!-- == MONITORING ======================================================================================== -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">MONITORING</h3>
          </div>
          
          <!-- Displays the humidity and temperature values received from ESP8266. *** -->
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURE</h4>
          <p class="temperatureColor"><span class="reading"><span id="ESP8266_Temp"></span> &deg;C</span></p>
          <h4 class="humidityColor"><i class="fas fa-tint"></i> WATER TDS</h4>
          <p class="humidityColor"><span class="reading"><span id="ESP8266_TDS"></span> PPM</span></p>
          <h4 class="humidityColor"><i class="fas fa-tint"></i> WATER LEVEL</h4>
          <p class="humidityColor"><span class="reading"><span id="ESP8266_LEVEL"></span> CM</span></p>
          <!-- *********************************************************************** -->
          
        </div>
        <!-- ======================================================================================================= -->
        
        <!-- == CONTROLLING ======================================================================================== -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">CONTROLLING</h3>
          </div>
          
          <!-- Buttons for controlling the LEDs on Slave 2. ************************** -->
          <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> WARMING DEVICE</h4>
          <label class="switch">
            <input type="checkbox" id="ESP8266_TogLED_01" onclick="GetTogBtnLEDState('ESP8266_TogLED_01')">
            <div class="sliderTS"></div>
          </label> 
          <!-- <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 2</h4>
          <label class="switch">
            <input type="checkbox" id="ESP8266_TogLED_02" onclick="GetTogBtnLEDState('ESP8266_TogLED_02')">
            <div class="sliderTS"></div>
          </label> -->

          <!-- điều khiển led trực tiếp qua esp8266 -->
          <!-- <div class="col-6">
              <button type="button" class="btn btn-primary" onclick="toggleDevice('light1')">Bật đèn sưởi</button>
          </div>
          <div class="col-6">
              <button type="button" class="btn btn-primary" onclick="toggleDevice('light1')">Tắt đèn sưởi</button>
          </div> -->

          <!-- ngọn lửa đang cháy -->
          <div>
            <img src="fire-10130_256.gif" width="200" height="100" alt="Fireplace Animation">
          </div>
          <!-- *********************************************************************** -->
        </div>  
        
        <!-- ======================================================================================================= -->
        <canvas id="dataChart" width="400" height="200"></canvas>

      </div>
    </div>
    <br>

    
    
    
    <div class="content">
      <div class="cards">
        <div class="card header" style="border-radius: 15px;">
            <h3 style="font-size: 1rem;">LAST UPDATED DATA [ <span id="ESP8266_LTRD"></span> ]</h3>
            <button onclick="window.open('dbtable.php', '_blank');" style="background-color: #ddd; color: #0c6980; border-radius: 20px; height: 3rem;
            font-size: 1rem;">Open Record Table</button>
            <h3 style="font-size: 0.7rem;"></h3>
        </div>
        <!-- <br> -->
        
        <!-- chart
        -->
      </div>
    </div>
    <!-- ___________________________________________________________________________________________________________________________________ -->
    
    <script>
      //------------------------------------------------------------
      document.getElementById("ESP8266_Temp").innerHTML = "NN"; 
      document.getElementById("ESP8266_TDS").innerHTML = "NN";
      document.getElementById("ESP8266_Status_Read_DHT11").innerHTML = "NN";
      document.getElementById("ESP8266_LTRD").innerHTML = "NN";
      //------------------------------------------------------------
      
      // Get_Data("ESP8266_01");
      
      // setInterval(myTimer, 5000);
      
      //------------------------------------------------------------
      function myTimer() {
        Get_Data("ESP8266_01");
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function fetchData() {
          $.ajax({
              url: 'get_data.php',
              type: 'GET',
              dataType: 'json',
              success: function(data) {
                  // let html = '<table border="1"><tr><th>ID</th><th>Name</th><th>Value</th><th>Updated At</th></tr>';
                  data.forEach(function(item) {
                    document.getElementById("ESP8266_Temp").innerHTML = item.temp;
                    document.getElementById("ESP8266_TDS").innerHTML = item.tds;
                    document.getElementById("ESP8266_LEVEL").innerHTML = item.level;
                    document.getElementById("ESP8266_LTRD").innerHTML = item.reading_time;
                  });

                  let chartData = [];
                  let labels = [];
                  data.slice(0, 10).forEach(function(item, index) {
                      labels.push(item.updated_at); // Thời gian cập nhật
                      chartData.push(item.value);  // Giá trị
                  });

                  // Vẽ biểu đồ
                  drawChart(labels, chartData);



                  // html += '</table>';

                  // $('#data-display').html(html);
                  console.log("success");
                  console.log("Data:", data);
                  console.log("Labels:", labels);
                  console.log("Chart Data:", chartData);

              }
          });
      }

      let myChart;
      function drawChart(labels, data) {
          const ctx = document.getElementById('myChart').getContext('2d');
          if (myChart) {
              myChart.data.labels = labels;
              myChart.data.datasets[0].data = data;
              myChart.update();
          } else {
              myChart = new Chart(ctx, {
                  type: 'line',
                  data: {
                      labels: labels,
                      datasets: [{
                          label: 'Sensor Data',
                          data: data,
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 2,
                          fill: false
                      }]
                  },
                  options: {
                      responsive: true,
                      plugins: {
                          legend: { display: true }
                      },
                      scales: {
                          x: { title: { display: true, text: 'Thời gian' } },
                          y: { title: { display: true, text: 'Giá trị' } }
                      }
                  }
              });
          }
      }


        // Gọi hàm fetchData mỗi 5 giây để cập nhật dữ liệu
      setInterval(fetchData, 5000);
      // Gọi hàm lần đầu để hiển thị dữ liệu ngay khi tải trang
      fetchData();
      function Get_Data(id) {
				// if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
        const  xmlhttp = new XMLHttpRequest();
        // } else {
        //   // code for IE6, IE5
        //   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        // }
        xmlhttp.onreadystatechange = () => {
          if (this.readyState ==4 && this.status==200) {
            const myObj = JSON.parse(this.responseText);
            // if (myObj.id == "ESP8266_01") {
            console.log(myObj.temp);
            console.log(myObj.tds);
              document.getElementById("ESP8266_Temp").innerHTML = myObj.temp;
              document.getElementById("ESP8266_TDS").innerHTML = myObj.tds;
              /*document.getElementById("ESP8266_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;
              document.getElementById("ESP8266_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
              if (myObj.LED_01 == "ON") {
                document.getElementById("ESP8266_TogLED_01").checked = true;
              } else if (myObj.LED_01 == "OFF") {
                document.getElementById("ESP8266_TogLED_01").checked = false;
              }
              if (myObj.LED_02 == "ON") {
                document.getElementById("ESP8266_TogLED_02").checked = true;
              } else if (myObj.LED_02 == "OFF") {
                document.getElementById("ESP8266_TogLED_02").checked = false;
              }
            // }*/
          }
          else{
            console.log("cant get data")
          }
        };
        xmlhttp.open("GET","getdata.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //xmlhttp.send("id="+id);
	}
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function GetTogBtnLEDState(togbtnid) {
        if (togbtnid == "ESP8266_TogLED_01") {
          var togbtnchecked = document.getElementById(togbtnid).checked;
          var togbtncheckedsend = "";
          if (togbtnchecked == true) togbtncheckedsend = "ON";
          if (togbtnchecked == false) togbtncheckedsend = "OFF";
          Update_LEDs("ESP8266_01","LED_01",togbtncheckedsend);
        }
        if (togbtnid == "ESP8266_TogLED_02") {
          var togbtnchecked = document.getElementById(togbtnid).checked;
          var togbtncheckedsend = "";
          if (togbtnchecked == true) togbtncheckedsend = "ON";
          if (togbtnchecked == false) togbtncheckedsend = "OFF";
          Update_LEDs("ESP8266_01","LED_02",togbtncheckedsend);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function Update_LEDs(id,lednum,ledstate) {
				if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("demo").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("POST","updateLEDs.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id+"&lednum="+lednum+"&ledstate="+ledstate);
			}
      //------------------------------------------------------------
    </script>
  </body>
</html>