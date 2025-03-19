<title>Login</title>
<?php
      include('config.php');    
	  session_start();	  
	  if ($_SESSION){
        header('location:home.php');
	  }
	  if(isset($_POST['login'])){
		  // Lấy giá trị từ form
		  $username = $_POST['username'];
		  $password = $_POST['password'];

		  // Tạo câu truy vấn
		  $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1";
		  
		  // Thực thi câu truy vấn bằng MySQLi
		  $query = mysqli_query($connection, $sql);
		  
		  // Kiểm tra số lượng kết quả trả về
		  $nums = mysqli_num_rows($query);
		  
		  if($nums > 0){
			  // Lấy dữ liệu từ kết quả
			  $row = mysqli_fetch_array($query);
			  
			  // Lưu thông tin vào session
			  $_SESSION['dangnhap'] = $row['username'];
			  $_SESSION['quyen_truy_cap'] = $row['quyen_truy_cap'];	
			  $_SESSION['hoten'] = $row['hoten'];	
			  $_SESSION['id'] = $row['id_user'];  
			  
			  // Điều hướng đến trang index
			  header('location:home.php');
			// echo 'OK';
		  } else {
		      echo "<script> alert('Sai thông tin đăng nhập!')</script>";
		  }		  
	  }
?>
<!DOCTYPE html>
<html lang="vn">
<head>
<title>Coloring Login Form Responsive Widget Template :: w3layouts</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Coloring Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="web/css/c.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="web/css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<!-- web-fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
<!-- //web-fonts -->
</head>
<body data-vide-bg="web/video/beca1.mp4">
<div style="background-image: url(/web/images/image.png)">
	<div class="center-container">
		<!--header-->
		<div class="header-w3l montserrat-text">
			<h1>LOGIN</h1>
		</div>
		<!--//header-->
		<!--main-->
		<div class="main-content-agile">
			<div class="/images/image.png">
				<h2></h2>
			</div>
			<div class="sub-main-w3">	
				<form action="#" method="post">
					<input placeholder="Username" name="username" type="text" required>
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
					<input  placeholder="Password" name="password" type="password" required>
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
					 <input type="submit" name="login" id="button" value="Login" style="margin-top:4rem;">
					 <div class="rem-w3">
						<!-- <span class="check-w3"><input type="checkbox" />Remember Me</span> -->
						<a href="registration.php">Register new account</a>
					</div>
				</form>
			</div>
		</div>
		<!--//main-->
		<!--footer-->
		<div style="padding-top: 10rem; padding-bottom: 6rem;">
			<p style="font-size: 1.5rem; color:#fff;">Nhóm 16 - IOT & Ứng dụng</p>
		</div>
		<!--//footer-->
	</div>
</div>
<!-- js -->
<script type="text/javascript" src="web/js/jquery-2.1.4.min.js"></script>
<script src="web/js/jquery.vide.min.js"></script>
<!-- //js -->
</body>
</html>
