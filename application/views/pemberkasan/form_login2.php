<!DOCTYPE html>
<html lang="en">
<head>
	<title>PEMBERKASAN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="<?=base_url('assets/login_page/images/icons/Box.jpg');?>"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/login_page/vendor/bootstrap/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/login_page/fonts/font-awesome-4.7.0/css/font-awesome.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/login_page/fonts/Linearicons-Free-v1.0.0/icon-font.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/login_page/vendor/animate/animate.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/login_page/vendor/css-hamburgers/hamburgers.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/login_page/vendor/select2/select2.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/login_page/css/util.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/login_page/css/main.css');?>">
	
	<style>
	#kopirait{
		bottom : 10px;
		left : 10px;
		
	}
	</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url(<?=base_url('assets/login_page/images/tumpukan_berkas.jpeg');?>)">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" action="<?=base_url();?>index.php/auth/cek_login" method="post">
					<div class="login100-form-avatar">
						<img id="gambar_depe"/>
					</div>

					<span class="login100-form-title p-t-20 p-b-45"></span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="nama" id="nama" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="kunci" id="kunci" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="kopirait">
		<span>Login page by colorlib.com</span>
	</div>
	
	<script src="<?=base_url('assets/login_page/vendor/jquery/jquery-3.2.1.min.js');?>"></script>
	<script src="<?=base_url('assets/login_page/vendor/bootstrap/js/popper.js');?>"></script>
	<script src="<?=base_url('assets/login_page/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
	<script src="<?=base_url('assets/login_page/vendor/select2/select2.min.js');?>"></script>
	<script src="<?=base_url('assets/login_page/js/main.js');?>"></script>
	

</body>
</html>